<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Active Users On Router</title>
  @include('partials.styles')
  <style>
    .status label{
      padding: 0 10px
    }
  </style>
</head>
<body>

<p class="status">
  <label class="text-success">Active: {{$status['active']}}</label> |
  <label class="text-info">Online: {{$status['online']}}</label> |
  <label class="text-danger">Offline: {{$status['offline']}}</label> |
  <label class="text-warning">Expire: {{$status['expire']}}</label> | 
  <label class="text-default">Deactive: {{$status['deactive']}}</label>
</p>

<div id="map" style="height: 100vh; margin-top:0"></div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([24.408425968764224, 89.23363527502185], 12); // center on Gurdaspur, Natore

    // OpenStreetMap
    const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 50,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Esri Satellite
    const esriSat = L.tileLayer(
      'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
      { attribution: 'Tiles © Esri' }
    );

    // Add layer control
    L.control.layers({
        "OpenStreetMap": osm,
        "Satellite": esriSat
    }).addTo(map);



    function colorForStatus(status) {
      if (status === 'Offline') return '#fa0606';
      if (status === 'Active') return '#28a745';
      if (status === 'Deactive') return '#d0d5d1';
      if (status === 'Expire') return '#f5c007';
      return '#959393';
    }

    function getIcon(color) {
        return L.divIcon({
            className: 'custom-div-icon',
            html: `<div style="background:${color};width:16px;height:16px;border-radius:50%;border:2px solid white"></div>`,
            iconSize: [16,16],
            iconAnchor: [8,8],
            popupAnchor: [0,-8]
        });
    }

    const customers = @json($customers);

    customers.forEach(c => {
        const marker = L.marker([c.lat, c.lng], {
            icon: getIcon(colorForStatus(c.status)),
            title: c.full_name
        }).bindPopup(`
        <strong>${c.name}</strong>
        <br>
        Status: ${c.status} 
        ${c.status == 'Active' ? `<br>IP: ${c.ip}<br>Uptime: ${c.uptime}`:''}
        <br>
        <a target="_blank" href="https://www.google.com/maps/place/${c.lat}, ${c.lng}">Go on location</a>
        `);
        marker.addTo(map);
    });
</script>
{{-- @endsection --}}

  
</body>
</html>