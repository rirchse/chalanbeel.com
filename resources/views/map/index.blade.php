@extends('admin')

@section('content')
<div id="map" style="height: 80vh;"></div>
@endsection

@section('stylesheets')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([24.436197194755337, 89.21380393019595], 12); // center on Dhaka

    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     maxZoom: 19,
    // }).addTo(map);

//     L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
//     attribution: 'Tiles © Esri'
// }).addTo(map);

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
        if (status === 'Active') return '#28a745';
        if (status === 'Deactive') return '#ff0000';
        if (status === 'Expire') return '#ffc107';
        return '#dc3545';
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
        }).bindPopup(`<strong>${c.name}</strong><br>Status: ${c.status}`);
        marker.addTo(map);
    });
</script>
@endsection
