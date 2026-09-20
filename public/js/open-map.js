let map;
let marker;
let latlong = document.getElementById('lat_long');

function initMap() {
  // Default location (e.g., Natore/Dhaka)
  const defaultLocation = { lat: 24.4322, lng: 89.2091 };

  let mapid = document.getElementById("map");
  map = new google.maps.Map(mapid, {
    center: defaultLocation,
    zoom: 15,
    mapTypeId: "roadmap",
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
      position: google.maps.ControlPosition.TOP_RIGHT,
      mapTypeIds: ["roadmap", "satellite", "hybrid", "terrain"]
    }
  });

  // Place initial marker & set initial input field value
  marker = new google.maps.Marker({
    position: defaultLocation,
    map: map,
    draggable: true,
  });
  
  if (latlong) {
    latlong.value = defaultLocation.lat + ', ' + defaultLocation.lng;
  }

  // Create custom button and error messaging elements
  const locationButton = document.createElement("button");
  locationButton.setAttribute('type', 'button');
  locationButton.textContent = "📍 My Location";
  locationButton.classList.add("custom-map-control-button");

  let errmsg = document.createElement('p');
  errmsg.setAttribute('style', 'color:red'); 

  // Add button to map
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

  // Trigger geolocation on "My Location" button click
  locationButton.addEventListener("click", () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          // Update Map, Marker, and Input Field
          marker.setPosition(pos);
          map.setCenter(pos);
          map.setZoom(15);
          if (latlong) {
            latlong.value = pos.lat + ', ' + pos.lng;
          }
        },
        () => {
          errmsg.innerHTML = "Error: Unable to access your location.";
          mapid.prepend(errmsg);
        }
      );
    } else {
      errmsg.innerHTML = "Your browser doesn't support geolocation.";
      mapid.prepend(errmsg);
    }
  });

  // Update input fields when dragging marker
  google.maps.event.addListener(marker, "dragend", function (event) {
    if (latlong) {
      latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
    }
  });

  // Update marker & input fields when clicking map
  google.maps.event.addListener(map, "click", function (event) {
    marker.setPosition(event.latLng);
    if (latlong) {
      latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
    }
  });
}

// Load map
window.onload = initMap;