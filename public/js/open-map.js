let map;
let marker;
let latlong = document.getElementById('lat_long');

function initMap() {
  const defaultLocation = [24.4251, 89.1987];

  // 1. Define Base Layers
  const osmStreet = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  });

  const esriSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19,
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
  });

  // 2. Initialize map with default street layer
  map = L.map('map', {
    center: defaultLocation,
    zoom: 15,
    layers: [osmStreet] // default active layer
  });

  // Force Leaflet to recalculate container size
  setTimeout(function() {
    map.invalidateSize();
  }, 200);

  // 3. Add Layer Control (Map Switcher Widget)
  const baseMaps = {
    "Street Map": osmStreet,
    "Satellite": esriSatellite
  };
  
  L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

  // 4. Add Draggable Marker
  marker = L.marker(defaultLocation, { draggable: true }).addTo(map);

  // Update input on marker drag
  marker.on('dragend', function () {
    const position = marker.getLatLng();
    if (latlong) {
      latlong.value = position.lat.toFixed(6) + ', ' + position.lng.toFixed(6);
    }
  });

  // Update marker and input on map click
  map.on('click', function (event) {
    const clickedLat = event.latlng.lat;
    const clickedLng = event.latlng.lng;

    marker.setLatLng([clickedLat, clickedLng]);

    if (latlong) {
      latlong.value = clickedLat.toFixed(6) + ', ' + clickedLng.toFixed(6);
    }
  });

  // 5. Add "📍 My Location" Button
  const locationButton = L.control({ position: 'topright' });

  locationButton.onAdd = function () {
    const btn = L.DomUtil.create('button', 'custom-map-control-button');
    btn.type = 'button';
    btn.innerHTML = '🔵';
    btn.style.padding = '8px 12px';
    btn.style.cursor = 'pointer';
    btn.style.backgroundColor = '#fff';
    btn.style.border = '2px solid rgba(0,0,0,0.2)';
    btn.style.borderRadius = '4px';

    L.DomEvent.disableClickPropagation(btn);

    btn.addEventListener('click', () => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            map.setView([userLat, userLng], 15);
            marker.setLatLng([userLat, userLng]);

            if (latlong) {
              latlong.value = userLat.toFixed(6) + ', ' + userLng.toFixed(6);
            }
          },
          () => {
            alert("Error: Unable to access your location.");
          }
        );
      } else {
        alert("Your browser doesn't support geolocation.");
      }
    });

    return btn;
  };

  locationButton.addTo(map);
}

window.onload = initMap;