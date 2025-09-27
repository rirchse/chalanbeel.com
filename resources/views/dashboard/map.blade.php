@extends('layouts.app')

@section('content')
<div id="map" style="height:80vh; margin-top:0"></div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<script>
const apiUrl = "{{ route('api.customers.map') }}";

// Initialize map (change center/zoom to your region)
const map = L.map('map').setView([23.8103, 90.4125], 12);

// OSM tiles (replace with Mapbox/Google if you need SLA/scale)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// marker cluster group
const clusterGroup = L.markerClusterGroup();
map.addLayer(clusterGroup);

// store markers by id so we can update/remove
const markers = {};

function colorForStatus(status) {
    if (status === 'online') return '#28a745';
    if (status === 'idle')   return '#ffc107';
    return '#dc3545'; // offline
}

// small colored circle icon using divIcon (avoids default image path issues)
function getIcon(color) {
    return L.divIcon({
        className: 'custom-div-icon',
        html: `<div style="background:${color};width:16px;height:16px;border-radius:50%;border:2px solid white"></div>`,
        iconSize: [16,16],
        iconAnchor: [8,8],
        popupAnchor: [0,-8]
    });
}

// update or create markers from server data
function applyCustomers(data) {
    const seen = new Set();

    data.forEach(c => {
        seen.add(c.id);
        const color = colorForStatus(c.status);

        if (markers[c.id]) {
            // update location + icon + popup
            markers[c.id].setLatLng([c.lat, c.lng]);
            markers[c.id].setIcon( getIcon(color) );
            markers[c.id].getPopup().setContent(`<strong>${c.name}</strong><br>Status: ${c.status}`);
        } else {
            const m = L.marker([c.lat, c.lng], { icon: getIcon(color) })
                        .bindPopup(`<strong>${c.name}</strong><br>Status: ${c.status}`);
            markers[c.id] = m;
            clusterGroup.addLayer(m);
        }
    });

    // remove markers that are no longer returned
    Object.keys(markers).forEach(id => {
        if (!seen.has(parseInt(id))) {
            clusterGroup.removeLayer(markers[id]);
            delete markers[id];
        }
    });
}

// fetch within current viewport to reduce server load (good for large datasets)
async function fetchAndUpdate() {
    try {
        const b = map.getBounds();
        const sw = b.getSouthWest(), ne = b.getNorthEast();
        const url = `${apiUrl}?bounds=${sw.lat},${sw.lng},${ne.lat},${ne.lng}`;
        const res = await fetch(url);
        if (!res.ok) throw new Error('Network error');
        const data = await res.json();
        applyCustomers(data);
    } catch (err) {
        console.error(err);
    }
}

// initial + events
fetchAndUpdate();
map.on('moveend', fetchAndUpdate);
// periodic polling for status changes (tune interval to your needs)
setInterval(fetchAndUpdate, 10000);
</script>
@endpush
