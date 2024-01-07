const map = new L.map('map');
const currentLocation = { lat: 0, lng: 0 };

const routes = Object.freeze({
  findDrivers: '/api/find-nearby-drivers',
  changeAvailability: '/api/change-availability',
  updateLocation: '/api/update-location',
});

// *****************************************************************************
// DOM elements
// *****************************************************************************
const searchBtn = document.getElementById('search-btn');
const driversModal = document.getElementById('drivers-modal');
const driversModalContent = document.getElementById('drivers-modal-content');

// *****************************************************************************
// Variables
// *****************************************************************************
let locateControl = null;
let locationInitialized = false;
let searchDistance = 5000;

// *****************************************************************************
// Map functions
// *****************************************************************************
const addLocateControl = () => {
  locateControl = L.control.locate({
    strings: {
      title: "Mostrar mi ubicación actual",
      metersUnit: "metros",
      popup: "Estás en un radio de {distance} {unit} desde este punto",
      outsideMapBoundsMsg: "Parece que estás fuera de los límites del mapa",
    },
    locateOptions: {
      enableHighAccuracy: true,
      watch: true,
    },
    markerClass: L.marker,
  });

  locateControl.addTo(map);
  locateControl.start();
}

const addTitikakaControl = () => {
  let titikakaControl = L.easyButton('fa-expand', zoomTitikaka, 'Zoom al Lago Titikaka');
  titikakaControl.addTo(map);
}

const zoomTitikaka = () => {
  const titikakaTopLeft = new L.LatLng(-15.08546348135599, -70.15326353777095);
  const titikakaBottomRight = new L.LatLng(-16.63383369834872, -68.49964616712293);
  const bounds = new L.LatLngBounds(titikakaTopLeft, titikakaBottomRight);
  map.fitBounds(bounds);
}

// *****************************************************************************
// Other functions
// *****************************************************************************
const findNearbyDrivers = async (lat, lng) => {
  if (lat === 0 || lng === 0) return;
  const res = await axios.post(routes.findDrivers, { lat, lng, searchDistance });
  if (res.status !== 200) {
    swal.fire({
      title: 'Error',
      text: 'No se pudo obtener la lista de lanchas cercanas',
      icon: 'error',
      showCancelButton: false,
    });
    return;
  }
  if (!res?.data?.drivers || res.data.drivers.length === 0) {
    Swal.fire({
      title: 'Lo sentimos',
      text: 'No se encontraron lanchas cercanas',
      icon: 'info',
      showCancelButton: false,
    })
  }
  else {
    for(let driver of res.data.drivers) {
      const marker = L.circleMarker([driver.lat, driver.lng]);
      marker.setStyle({ fillColor: 'red', color: '#fa2828' });
      marker.bindPopup(`<h3 class="text-lg font-bold">${driver.name}</h3><p class="${driver.description ? '' : 'hidden'} break-words">${driver.description}</p><b>Correo: </b>${driver.email}<br><b>Celular: </b>${driver.phone}<br><br><a href="https://api.whatsapp.com/send/?phone=%2B51${driver.phone}" rel="noreferrer" target="_blank" class="btn btn-sm border-none bg-green-500 !text-white"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>`);
      marker.addTo(map);
    }
  }
}

const updateLocation = async () => {
  if (!currentLocation.lat || !currentLocation.lng) return;
  axios.put(routes.updateLocation, currentLocation);
}

const changeAvailability = async () => {
  const res = await axios.put(routes.changeAvailability);
  if (res.status === 200) {
    await Swal.fire({
      title: 'Listo',
      text: 'Su disponibilidad ha sido actualizada',
      icon: 'success',
      showCancelButton: false,
    });
    window.location.reload();
  }
}

// *****************************************************************************
// Events
// *****************************************************************************
const handleSearch = async () => {
  let msgOptions = {
    title: 'Buscar',
    text: `Desea buscar una lancha cercana? (Distancia: ${searchDistance}m)`,
    confirmButtonText: 'Buscar',
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    reverseButtons: true,
  }
  if (user.role === 'driver') {
    msgOptions.title = 'Disponibilidad';
    msgOptions.text = 'Desea cambiar su disponibilidad?';
    msgOptions.confirmButtonText = 'Aceptar';
  }
  const result = await Swal.fire(msgOptions);
  if (!result.isConfirmed) return;
  if (user.role === 'passenger') {
    locateControl?.start();
    findNearbyDrivers(currentLocation.lat, currentLocation.lng, searchDistance);
  }
  else if (user.role === 'driver') {
    changeAvailability();
  }
}

const handleLocationError = async () => {
  await Swal.fire({
    title: 'Error',
    text: 'No se pudo obtener su ubicación actual, por favor otorgue los permisos necesarios',
    icon: 'error',
    showCancelButton: false,
  });
}

const handleLocationFound = async (locationEvent) => {
  const { lat, lng } = locationEvent.latlng;
  currentLocation.lat = lat;
  currentLocation.lng = lng;
  if (!locationInitialized) {
    updateLocation();
    locationInitialized = true;
  }
}

// *****************************************************************************
// Initialize
// *****************************************************************************
const initMap = () => {
  map.setView([51.505, -0.09], 13)
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);
  addLocateControl();
  addTitikakaControl();
}

const initEvents = () => {
  searchBtn.addEventListener('click', () => handleSearch());
  map.on('locationerror', () => handleLocationError());
  map.on('locationfound', (locationEvent) => handleLocationFound(locationEvent));
}

window.addEventListener('DOMContentLoaded', () => {
  initMap();
  initEvents();
  setInterval(() => updateLocation(), 60 * 1000);
  // driversModal.showModal();
});