@extends('admin')

@section('content')

<div id="map" style="height: 80vh; margin-top:0"></div>
@endsection

@section('stylesheets')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([24.408425968764224, 89.23363527502185], 12); // center on Dhaka

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
      if (status === 'New') return '#f5c007';
      if (status === 'Expire') return '#d0d5d1';
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

    const points = @json($points);

    points.forEach(c => {
        const marker = L.marker([c.lat, c.lng], {
            icon: getIcon(colorForStatus(c.status)),
            title: c.full_name
        }).bindPopup(`
        <strong>${c.address}</strong>
        <br>
        Status: ${c.status}
        <br>
        <a target="_blank" href="https://www.google.com/maps/place/${c.lat}, ${c.lng}">Go on location</a>
        `);
        marker.addTo(map);
    });
</script>
@endsection