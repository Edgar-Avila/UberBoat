const map = new L.map('map');
const searchBtn = document.getElementById('search-btn');

// *****************************************************************************
// Map functions
// *****************************************************************************
const addLocateControl = () => {
  const locateControl = L.control.locate({
    strings: {
      title: "Mostrar mi ubicación actual",
      metersUnit: "metros",
      popup: "Estás en un radio de {distance} {unit} desde este punto",
      outsideMapBoundsMsg: "Parece que estás fuera de los límites del mapa",
    },
    locateOptions: {
      enableHighAccuracy: true,
      watch: true,
    }
  });

  locateControl.addTo(map);
}

const zoomTitikaka = () => {
  const titikakaTopLeft = new L.LatLng(-15.08546348135599, -70.15326353777095);
  const titikakaBottomRight = new L.LatLng(-16.63383369834872, -68.49964616712293);
  const bounds = new L.LatLngBounds(titikakaTopLeft, titikakaBottomRight);
  map.fitBounds(bounds);
}

// *****************************************************************************
// Events
// *****************************************************************************
const handleSearch = async () => {
  const result = await Swal.fire({
    title: 'Buscar',
    text: 'Desea buscar una lancha cercana?',
    confirmButtonText: 'Buscar',
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    reverseButtons: true,
  });
  if(result.isConfirmed) {
    // TODO: Buscar lancha cercana
    console.log('buscar');
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
  zoomTitikaka();
  addLocateControl();
}

const initEvents = () => {
  searchBtn.addEventListener('click', () => handleSearch());
}

window.addEventListener('DOMContentLoaded', () => {
  initMap();
  initEvents();
});