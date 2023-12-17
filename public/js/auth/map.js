const map = new L.map('map');

const init = () => {
    map.setView([51.505, -0.09], 13)
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);
    const titikakaTopLeft = new L.LatLng(-15.08546348135599, -70.15326353777095);
    const titikakaBottomRight = new L.LatLng(-16.63383369834872, -68.49964616712293);
    const bounds = new L.LatLngBounds(titikakaTopLeft, titikakaBottomRight);
    map.fitBounds(bounds);
}

window.addEventListener('DOMContentLoaded', () => {
    init();
});