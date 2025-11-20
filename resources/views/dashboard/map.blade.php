@extends('home')
@section('title', __('messages.titles.map'))
@section('content')

<style>
    .map-page-layout {
        display: flex;
        padding-top: 70px;
        min-height: calc(100vh - 70px);
        position: relative;
    }

    .status-sidebar {
        width: 280px;
        background: #fff;
        padding: 20px;
        position: fixed;
        left: 0;
        top: 70px;
        height: calc(100vh - 70px);
        overflow-y: auto;
        z-index: 100;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .status-sidebar h3 {
        font-size: 20px;
        font-weight: 700;
        color: #000;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-sidebar h3 i {
        font-size: 24px;
    }

    .status {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .status label {
        padding: 12px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .status label:hover {
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .status-label-content {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-count {
        font-size: 18px;
        font-weight: 700;
        min-width: 30px;
        text-align: right;
    }

    .status label.text-warning {
        background: rgba(245, 192, 7, 0.1);
        color: #f5c007;
        border: 2px solid rgba(245, 192, 7, 0.3);
    }

    .status label.text-success {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 2px solid rgba(40, 167, 69, 0.3);
    }

    .status label.text-info {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
        border: 2px solid rgba(23, 162, 184, 0.3);
    }

    .status label.text-danger {
        background: rgba(250, 6, 6, 0.1);
        color: #fa0606;
        border: 2px solid rgba(250, 6, 6, 0.3);
    }

    .status label.text-default {
        background: rgba(208, 213, 209, 0.1);
        color: #666;
        border: 2px solid rgba(208, 213, 209, 0.3);
    }

    .map-content {
        flex: 1;
        margin-left: 280px;
        position: relative;
    }

    #map {
        height: calc(100vh - 70px);
        width: 100%;
        position: relative;
    }

    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 80px;
        left: 10px;
        z-index: 10001;
        background: #000;
        color: #fff;
        border: 2px solid #fff;
        width: 45px;
        height: 45px;
        border-radius: 8px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        background: #333;
        transform: scale(1.05);
    }

    .sidebar-toggle i {
        font-size: 24px;
    }

    @media (max-width: 992px) {
        .status-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .status-sidebar.open {
            transform: translateX(0);
        }

        .map-content {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: flex;
        }
    }

    @media (max-width: 768px) {
        .map-page-layout {
            padding-top: 60px;
        }

        .status-sidebar {
            top: 60px;
            height: calc(100vh - 60px);
            width: 260px;
        }

        #map {
            height: calc(100vh - 60px);
        }

        .sidebar-toggle {
            top: 70px;
        }

        .status label {
            padding: 10px 14px;
            font-size: 13px;
        }

        .status-count {
            font-size: 16px;
        }
    }
</style>

<div class="map-page-layout">
    <!-- Sidebar Toggle Button (Mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="material-icons">menu</i>
    </button>

    <!-- Left Sidebar -->
    <div class="status-sidebar" id="statusSidebar">
        <h3>
            <i class="material-icons">dashboard</i>
            {{ __('messages.map.user_status') }}
        </h3>
        <div class="status">
            <label class="text-warning">
                <span class="status-label-content">
                    <i class="material-icons">fiber_new</i>
                    <span>{{ __('messages.map.status_new') }}</span>
                </span>
                <span class="status-count">{{$status['new']}}</span>
            </label>
            <label class="text-success">
                <span class="status-label-content">
                    <i class="material-icons">check_circle</i>
                    <span>{{ __('messages.map.status_active') }}</span>
                </span>
                <span class="status-count">{{$status['active']}}</span>
            </label>
            <label class="text-info">
                <span class="status-label-content">
                    <i class="material-icons">wifi</i>
                    <span>{{ __('messages.map.status_online') }}</span>
                </span>
                <span class="status-count">{{$status['online']}}</span>
            </label>
            <label class="text-danger">
                <span class="status-label-content">
                    <i class="material-icons">wifi_off</i>
                    <span>{{ __('messages.map.status_offline') }}</span>
                </span>
                <span class="status-count">{{$status['offline']}}</span>
            </label>
            <label class="text-default">
                <span class="status-label-content">
                    <i class="material-icons">schedule</i>
                    <span>{{ __('messages.map.status_expire') }}</span>
                </span>
                <span class="status-count">{{$status['expire']}}</span>
            </label>
        </div>
    </div>

    <!-- Map Content -->
    <div class="map-content">
        <div id="map"></div>
    </div>
</div>

<script>
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const statusSidebar = document.getElementById('statusSidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            statusSidebar.classList.toggle('open');
            const icon = this.querySelector('i');
            if (statusSidebar.classList.contains('open')) {
                icon.textContent = 'close';
            } else {
                icon.textContent = 'menu';
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                if (!statusSidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    statusSidebar.classList.remove('open');
                    sidebarToggle.querySelector('i').textContent = 'menu';
                }
            }
        });
    }
</script>

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

    // Translate status for popup
    const statusTranslations = {
        'New': @json(__('messages.map.status_new')),
        'Active': @json(__('messages.map.status_active')),
        'Online': @json(__('messages.map.status_online')),
        'Offline': @json(__('messages.map.status_offline')),
        'Expire': @json(__('messages.map.status_expire'))
    };
    
    const popupLabels = {
        'status': @json(__('messages.map.popup_status')),
        'ip': @json(__('messages.map.popup_ip')),
        'uptime': @json(__('messages.map.popup_uptime')),
        'view_location': @json(__('messages.map.popup_view_location'))
    };
    
    function translateStatus(status) {
        return statusTranslations[status] || status;
    }

    const customers = @json($customers);

    customers.forEach(c => {
        const marker = L.marker([c.lat, c.lng], {
            icon: getIcon(colorForStatus(c.status)),
            title: c.full_name
        }).bindPopup(`
        <strong>${c.name}</strong>
        <br>
        ${popupLabels.status}: ${translateStatus(c.status)} 
        ${c.status == 'Active' ? `<br>${popupLabels.ip}: ${c.ip}<br>${popupLabels.uptime}: ${c.uptime}`:''}
        <br>
        <a target="_blank" href="https://www.google.com/maps/place/${c.lat}, ${c.lng}">${popupLabels.view_location}</a>
        `);
        marker.addTo(map);
    });
</script>

@endsection