  let map;
  let marker;
  let latlong = document.getElementById('lat_long');

  function initMap() {
    // Default location (Dhaka for example)
    const defaultLocation = { lat: 24.4322, lng: 89.2091 };

    // Create map
    let mapid = document.getElementById("map");
    map = new google.maps.Map(mapid, {
      center: defaultLocation,
      zoom: 15,
      mapTypeId: "roadmap", // default
      mapTypeControl: true, // enable switcher
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU, // or HORIZONTAL_BAR
        position: google.maps.ControlPosition.TOP_RIGHT,      // position of control
        mapTypeIds: [
          "roadmap",
          "satellite",
          "hybrid",
          "terrain"
        ]
      }
    });

    // Place initial marker
    marker = new google.maps.Marker({
      position: defaultLocation,
      map: map,
      draggable: true,
    });

    // Create the custom button
    const locationButton = document.createElement("button");
    locationButton.setAttribute('type', 'button');
    locationButton.textContent = "📍 My Location";
    locationButton.classList.add("custom-map-control-button");

    let errmsg = document.createElement('p');
    errmsg.setAttribute('style', 'color:red'); 

    // Add button to map (top center)
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

    // When button is clicked
    locationButton.addEventListener("click", () => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };

            marker.setPosition(pos);
            map.setCenter(pos);
            map.setZoom(15);
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

    // Try HTML5 geolocation
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function(position) {
          const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          map.setCenter(userLocation);
          marker.setPosition(userLocation);

          latlong.value = userLocation.lat + ', ' + userLocation.lng;
        },
        function() {
          errmsg.innerHTML = "Geolocation failed. Using default location.";
          mapid.prepend(errmsg);
        }
      );
    } else {
      errmsg.innerHTML = "Your browser doesn’t support geolocation.";
      mapid.prepend(errmsg);
    }

    // Update input fields when dragging marker
    google.maps.event.addListener(marker, "dragend", function (event) {
      latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
    });

    // Update marker & input fields when clicking map
    google.maps.event.addListener(map, "click", function (event) {
      marker.setPosition(event.latLng);
      latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
    });

    // Set default input values
    // latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
  }

  // Load map
  window.onload = initMap;