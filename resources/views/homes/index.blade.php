@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('home')
@section('title', __('messages.titles.home'))
@section('content')

<style type="text/css">
    /* Prevent horizontal overflow on mobile */
    body {
        overflow-x: hidden;
        max-width: 100%;
    }
    
    html {
        overflow-x: hidden;
        max-width: 100%;
    }
    
    * {
        box-sizing: border-box;
    }
    
    .hero-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 40px;
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 100%;
    }

    .hero-container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        z-index: 1;
        position: relative;
    }

    .hero-left {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .hero-title {
        font-size: 56px;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        margin: 0;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    /* Apply BenSen Handwriting font for Bangla text in hero section */
    html[lang="bn"] .hero-title,
    html[lang="bn"] .hero-subtitle {
        font-family: 'BenSen Handwriting', 'Bangla', 'Noto Sans Bengali', 'Kalpurush', 'SolaimanLipi', sans-serif;
    }

    /* Keep current font for English text in hero section */
    html[lang="en"] .hero-title,
    html[lang="en"] .hero-subtitle {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .hero-subtitle {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.95);
        line-height: 1.6;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .hero-actions {
        display: flex;
        gap: 15px;
        flex-wrap: nowrap;
        margin-top: 10px;
        align-items: center;
    }

    .hero-btn {
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        border: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero-btn-primary {
        background: #000;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .hero-btn-primary:hover {
        background: #333;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
        color: #fff;
    }

    .hero-btn-outline {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }

    .hero-btn-outline:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-3px);
        color: #fff;
    }

    .hero-right {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .search-card-title {
        font-size: 24px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
        text-align: center;
    }

    .search-card-subtitle {
        font-size: 15px;
        color: #666;
        margin-bottom: 30px;
        text-align: center;
    }

    .modern-page {
        min-height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        position: relative;
        background: #fff;
        z-index: 1;
    }

    .modern-page .main-card {
        max-width: 650px;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        padding: 50px 40px;
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }

    /* YouTube Video Background - Only for Hero Section */
    .video-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-width: 100%;
        min-height: 100%;
        z-index: -2;
        overflow: hidden;
    }

    .video-background iframe {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: 100%;
        height: 100%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    @media (min-aspect-ratio: 16/9) {
        .video-background iframe {
            height: 56.25vw;
            width: 100vw;
        }
    }

    @media (max-aspect-ratio: 16/9) {
        .video-background iframe {
            width: 177.78vh;
            height: 100vh;
        }
    }
    
    @media (max-width: 768px) {
        /* Hide video background on mobile */
        .video-background {
            display: none !important;
        }
    }

    /* Dark overlay for better text visibility - Only for Hero */
    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .main-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        max-width: 650px;
        width: 100%;
        padding: 50px 40px;
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .logo-container {
        text-align: center;
        margin-bottom: 40px;
    }

    .logo-container img {
        max-width: 200px;
        height: auto;
        margin: 0 auto;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .welcome-text {
        text-align: center;
        margin-bottom: 30px;
    }

    .welcome-text h2 {
        color: #333;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .welcome-text p {
        color: #666;
        font-size: 16px;
    }

    .search-form {
        margin-bottom: 30px;
    }

    .google-search-wrapper {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
    }
    .google-search-wrapper .form-group {
        margin: 10px 0 0 0 !important;
    }
    .phone-icon { 
        margin-top: 0px;
    }

    .material-input-group {
        position: relative;
        flex: 1;
        margin: 0;
    }

    .material-input-group .form-control {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        padding: 0 20px 0 55px;
        height: 60px;
        max-height: 60px;
        font-size: 16px;
        color: #000;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
        line-height: 1.5;
    }

    .material-input-group .form-control::placeholder {
        color: #999;
    }

    .material-input-group .form-control:focus,
    .material-input-group .form-control:active {
        outline: none;
        background: transparent !important;
        border-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2), 0 8px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .material-input-group .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 16px;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .material-input-group .form-control:focus ~ .input-icon {
        color: #000;
        transform: translateY(-50%) scale(1.1);
    }

    .search-submit-btn {
        background: #000;
        border: 2px solid transparent;
        border-radius: 5px;
        padding: 0 24px;
        height: 60px;
        max-height: 60px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 60px;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
    }

    .search-submit-btn:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    .search-submit-btn:active {
        background: #1a1a1a;
        transform: translateY(0);
    }

    .search-submit-btn i {
        font-size: 16px;
        color: #fff;
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .result-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        margin-top: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .result-card.expired {
        border: 3px solid #000;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
    }

    .result-card.active {
        border: 3px solid #000;
        background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
    }

    .status-badge {
        display: inline-block;
        padding: 10px 24px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-badge.active {
        background: #000;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .status-badge.expired {
        background: #666;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #666;
        font-size: 15px;
        font-weight: 500;
    }

    .info-value {
        color: #333;
        font-size: 16px;
        font-weight: 600;
        text-align: right;
    }

    .payment-info {
        background: #000;
        color: #fff;
        padding: 25px;
        border-radius: 16px;
        margin: 25px 0;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .payment-info h3 {
        margin: 0 0 15px 0;
        font-size: 20px;
        font-weight: 600;
    }

    .payment-info .number {
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 2px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .contact-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        margin-top: 20px;
    }

    .contact-info p {
        margin: 0;
        color: #666;
        font-size: 15px;
        line-height: 1.8;
    }

    .contact-info .phone {
        color: #000;
        font-weight: 600;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .main-card {
            padding: 30px 25px;
        }

        .welcome-text h2 {
            font-size: 24px;
        }

        .payment-info .number {
            font-size: 26px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .info-value {
            text-align: left;
        }
    }

    /* Remove spinner from number input */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <!-- YouTube Video Background -->
    <div class="video-background">
        <iframe 
            src="https://www.youtube.com/embed/bDQ-PlPJBPY?autoplay=1&mute=1&loop=1&playlist=bDQ-PlPJBPY&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1&playsinline=1&vq=hd1080"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>
    </div>
    <div class="video-overlay"></div>
    <div class="hero-container">
        <!-- Left Side: Title, Subtitle, Action Buttons -->
        <div class="hero-left">
            <h1 class="hero-title">{!! __('messages.hero.title') !!}</h1>
            <p class="hero-subtitle">
                {{ __('messages.hero.subtitle') }}
            </p>
            <div class="hero-actions">
                <a href="/register/create" class="hero-btn hero-btn-primary">
                    <i class="material-icons">person_add</i>
                    {{ __('messages.hero.register') }}
                </a>
                <a href="/view-user-on-map" class="hero-btn hero-btn-outline">
                    <i class="material-icons">map</i>
                    {{ __('messages.hero.view_map') }}
                </a>
                <a href="/speed-test" class="hero-btn hero-btn-outline">
                    <i class="material-icons">flash_on</i>
                    {{ __('messages.hero.speed_test') }}
                </a>
            </div>
        </div>

        <!-- Right Side: Search Form -->
        <div class="hero-right">
            <h3 class="search-card-title">{{ __('messages.search.title') }}</h3>
            <p class="search-card-subtitle">{{ __('messages.search.subtitle') }}</p>
            <form class="search-form" id="accountCheckForm" action="{{route('account.check.post')}}" method="GET">
                <div class="google-search-wrapper">
                    <div class="material-input-group">
                        <input 
                            type="number" 
                            name="contact" 
                            id="search" 
                            class="form-control" 
                            placeholder="{{ __('messages.search.placeholder') }}" 
                            required
                            maxlength="11"
                            pattern="[0-9]{11}"
                        >
                        <i class="material-icons input-icon phone-icon">phone</i>
                    </div>
                    <button type="submit" class="search-submit-btn" id="searchSubmitBtn">
                        <i class="material-icons">search</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Account Result Modal -->
<div class="account-modal" id="accountModal">
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="modal-container">
        <button class="modal-close" id="modalClose">
            <i class="material-icons">close</i>
        </button>
        
        <div class="modal-content" id="modalContent">
            <!-- Content will be populated via AJAX -->
        </div>
        
        @if(isset($user) && $user != [])
        <script>
            // For backward compatibility - show modal if user data exists on page load
            // This will run after all scripts are loaded
            window.addEventListener('load', function() {
                if (typeof populateModal === 'function' && typeof openModal === 'function') {
                    const userData = {
                        name: '{{ $user->name }}',
                        status: '{{ $user->status }}',
                        payment_date: '{{ $source->dtformat($user->payment_date) }}',
                        payment_date_raw: '{{ $user->payment_date }}'
                    };
                    populateModal(userData);
                    openModal();
                }
            });
        </script>
        @endif
    </div>
</div>

<!-- ISP Sections -->
<div class="isp-sections">
    <!-- Services/Packages Section -->
    <section class="isp-section packages-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.packages.title') }}</h2>
                <p class="section-subtitle">{{ __('messages.packages.subtitle') }}</p>
            </div>
            <div class="packages-grid">
                @if(isset($packages) && count($packages) > 0)
                    @foreach($packages as $index => $package)
                    <div class="package-card">
                        <div class="package-header">
                            <h3>{{ $package->service ?? __('messages.packages.internet') }}</h3>
                            <div class="package-price-badge">
                                <div class="price-amount">৳{{ number_format($package->price ?? 0) }}</div>
                                <div class="price-period">PER MONTH</div>
                            </div>
                            <div class="package-speed">{{ $package->speed ?? 'N/A' }} Mbps</div>
                        </div>
                        <div class="package-body">
                            <div class="package-details">
                                @php
                                    $listItems = [];
                                    $locale = app()->getLocale(); // Get current locale (en or bn)
                                    
                                    if (!empty($package->details)) {
                                        $decoded = json_decode($package->details, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                            // Check if it's the new bilingual format
                                            if (isset($decoded[0]) && is_array($decoded[0]) && (isset($decoded[0]['en']) || isset($decoded[0]['bn']))) {
                                                // New format: extract items based on locale
                                                foreach ($decoded as $item) {
                                                    $text = $item[$locale] ?? $item['en'] ?? $item['bn'] ?? '';
                                                    if (!empty($text)) {
                                                        $listItems[] = $text;
                                                    }
                                                }
                                            } else {
                                                // Old format: simple array
                                                $listItems = $decoded;
                                            }
                                        }
                                    }
                                    // If no list items, show default items
                                    if (empty($listItems)) {
                                        $listItems = [
                                            __('messages.packages.speed') . ': ' . ($package->speed ?? 'N/A') . ' Mbps',
                                            __('messages.packages.time') . ': ' . ($package->time_limit ?? 'N/A'),
                                            __('messages.packages.connection') . ': ' . ($package->connection ?? 'N/A'),
                                            '24/7 Support'
                                        ];
                                    }
                                @endphp
                                @foreach($listItems as $item)
                                <div class="detail-item">
                                    <div class="detail-item-icon check">
                                        <i class="material-icons" style="font-size: 18px;">check</i>
                                    </div>
                                    <span>{{ $item }}</span>
                                </div>
                                @endforeach
                            </div>
                            <a href="/register/create/{{ $package->id }}" class="package-btn">{{ __('messages.packages.buy_now') }}</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="package-card">
                        <div class="package-header">
                            <h3>{{ __('messages.packages.standard') }}</h3>
                            <div class="package-price-badge">
                                <div class="price-amount">৳500</div>
                                <div class="price-period">PER MONTH</div>
                            </div>
                            <div class="package-speed">10 Mbps</div>
                        </div>
                        <div class="package-body">
                            <div class="package-details">
                                <div class="detail-item">
                                    <div class="detail-item-icon check">
                                        <i class="material-icons" style="font-size: 18px;">check</i>
                                    </div>
                                    <span>{{ __('messages.packages.speed') }}: 10 Mbps</span>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-item-icon check">
                                        <i class="material-icons" style="font-size: 18px;">check</i>
                                    </div>
                                    <span>{{ __('messages.packages.time') }}: 30 {{ __('messages.packages.days') }}</span>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-item-icon check">
                                        <i class="material-icons" style="font-size: 18px;">check</i>
                                    </div>
                                    <span>24/7 Support</span>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-item-icon check">
                                        <i class="material-icons" style="font-size: 18px;">check</i>
                                    </div>
                                    <span>Free Installation</span>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-item-icon cross">
                                        <i class="material-icons" style="font-size: 18px;">close</i>
                                    </div>
                                    <span>Premium Support</span>
                                </div>
                            </div>
                            <a href="/register/create" class="package-btn">{{ __('messages.packages.take_package') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="isp-section features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.services.title') }}</h2>
                <p class="section-subtitle">{{ __('messages.services.subtitle') }}</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">flash_on</i>
                    </div>
                    <h3>{{ __('messages.services.high_speed') }}</h3>
                    <p>{{ __('messages.services.high_speed_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">headset_mic</i>
                    </div>
                    <h3>{{ __('messages.services.support_247') }}</h3>
                    <p>{{ __('messages.services.support_247_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">security</i>
                    </div>
                    <h3>{{ __('messages.services.secure_network') }}</h3>
                    <p>{{ __('messages.services.secure_network_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">payment</i>
                    </div>
                    <h3>{{ __('messages.services.easy_payment') }}</h3>
                    <p>{{ __('messages.services.easy_payment_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">wifi</i>
                    </div>
                    <h3>{{ __('messages.services.stable_connection') }}</h3>
                    <p>{{ __('messages.services.stable_connection_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">verified_user</i>
                    </div>
                    <h3>{{ __('messages.services.trusted_service') }}</h3>
                    <p>{{ __('messages.services.trusted_service_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">build</i>
                    </div>
                    <h3>{{ __('messages.services.fast_installation') }}</h3>
                    <p>{{ __('messages.services.fast_installation_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">settings</i>
                    </div>
                    <h3>{{ __('messages.services.free_maintenance') }}</h3>
                    <p>{{ __('messages.services.free_maintenance_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="isp-section why-choose-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.why_choose.title') }}</h2>
                <p class="section-subtitle">{{ __('messages.why_choose.subtitle') }}</p>
            </div>
            <div class="why-choose-content">
                <div class="why-item">
                    <div class="why-number">01</div>
                    <div class="why-text">
                        <h3>{{ __('messages.why_choose.fast_installation') }}</h3>
                        <p>{{ __('messages.why_choose.fast_installation_desc') }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-number">02</div>
                    <div class="why-text">
                        <h3>{{ __('messages.why_choose.affordable_price') }}</h3>
                        <p>{{ __('messages.why_choose.affordable_price_desc') }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-number">03</div>
                    <div class="why-text">
                        <h3>{{ __('messages.why_choose.skilled_technicians') }}</h3>
                        <p>{{ __('messages.why_choose.skilled_technicians_desc') }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-number">04</div>
                    <div class="why-text">
                        <h3>{{ __('messages.why_choose.quick_solution') }}</h3>
                        <p>{{ __('messages.why_choose.quick_solution_desc') }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-number">05</div>
                    <div class="why-text">
                        <h3>{{ __('messages.why_choose.quality_equipment') }}</h3>
                        <p>{{ __('messages.why_choose.quality_equipment_desc') }}</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-number">06</div>
                    <div class="why-text">
                        <h3>{{ __('messages.why_choose.local_service') }}</h3>
                        <p>{{ __('messages.why_choose.local_service_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="isp-section contact-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.contact.title') }}</h2>
                <p class="section-subtitle">{{ __('messages.contact.subtitle') }}</p>
            </div>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="material-icons">phone</i>
                    </div>
                    <h3>{{ __('messages.contact.phone') }}</h3>
                    <p>017 78 57 33 96</p>
                    <p>017 03 58 79 11</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="material-icons">email</i>
                    </div>
                    <h3>{{ __('messages.contact.email') }}</h3>
                    <p>info@chalanbeel.com</p>
                    <p>support@chalanbeel.com</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="material-icons">schedule</i>
                    </div>
                    <h3>{{ __('messages.contact.time') }}</h3>
                    <p>{{ __('messages.contact.hours') }}</p>
                    <p>{{ __('messages.contact.days') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .isp-sections {
        position: relative;
        z-index: 2;
        background: #fff;
        padding-top: 0;
        margin-top: 0;
        width: 100%;
        box-sizing: border-box;
    }
    
    /* Ensure packages section maintains layout when modal is open */
    body.modal-open .isp-sections,
    body:has(.account-modal.active) .isp-sections {
        position: relative !important;
        z-index: 2 !important;
        width: 100% !important;
        visibility: visible !important;
        display: block !important;
    }

    .isp-section {
        padding: 80px 20px;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
        box-sizing: border-box;
    }
    
    /* Ensure packages section maintains width when modal is open */
    body.modal-open .packages-section,
    body:has(.account-modal.active) .packages-section {
        width: 100% !important;
        max-width: 1400px !important;
        padding: 80px 20px !important;
    }
    
    /* Ensure container inside packages section maintains width */
    .packages-section .container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }
    
    /* When modal is open, ensure container width is preserved */
    body.modal-open .packages-section .container,
    body:has(.account-modal.active) .packages-section .container {
        width: 100% !important;
        max-width: 1400px !important;
        margin: 0 auto !important;
        padding: 0 20px !important;
        box-sizing: border-box !important;
        min-width: 0 !important;
    }
    
    /* Ensure the grid maintains its columns when container width is preserved */
    body.modal-open .packages-grid,
    body:has(.account-modal.active) .packages-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
    }
    
    /* On larger screens, ensure 3 columns are maintained if there are 3 packages */
    @media (min-width: 920px) {
        body.modal-open .packages-grid,
        body:has(.account-modal.active) .packages-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        }
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title {
        font-size: 36px;
        font-weight: 700;
        color: #000;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .section-subtitle {
        font-size: 18px;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Packages Section */
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 40px;
        width: 100%;
        box-sizing: border-box;
    }
    
    /* Ensure packages are always visible even when modal is open */
    body:has(.account-modal.active) .packages-grid,
    body.modal-open .packages-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        visibility: visible !important;
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
        grid-auto-flow: row !important;
    }
    
    /* Force multiple columns on larger screens when modal is open - JS will override if needed */
    @media (min-width: 920px) {
        body.modal-open .packages-grid[data-forced-columns],
        body:has(.account-modal.active) .packages-grid[data-forced-columns] {
            /* Keep JS-set columns */
        }
        
        /* Fallback: try to maintain 3 columns on wide screens */
        body.modal-open .packages-grid:not([data-forced-columns]),
        body:has(.account-modal.active) .packages-grid:not([data-forced-columns]) {
            grid-template-columns: repeat(3, minmax(280px, 1fr)) !important;
        }
    }
    
    /* Force grid to maintain columns when modal is open - calculate based on container width */
    @media (min-width: 900px) {
        body.modal-open .packages-grid,
        body:has(.account-modal.active) .packages-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        }
    }
    
    @media (min-width: 600px) and (max-width: 899px) {
        body.modal-open .packages-grid,
        body:has(.account-modal.active) .packages-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        }
    }
    
    body:has(.account-modal.active) .package-card,
    body.modal-open .package-card {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        width: 100% !important;
        min-width: 280px !important;
    }
    
    /* Ensure body maintains width when overflow is hidden */
    body.modal-open {
        width: 100% !important;
        overflow-x: hidden !important;
        overflow-y: hidden !important;
    }
    
    /* Ensure packages section isn't affected by body padding compensation */
    body.modal-open .isp-sections {
        width: 100% !important;
        max-width: 100% !important;
        position: relative !important;
    }
    
    /* Prevent width recalculation when modal opens */
    body.modal-open .isp-section,
    body:has(.account-modal.active) .isp-section {
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .package-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    /* Color schemes for different packages */
    .package-card:nth-child(4n+1) .package-header,
    .package-card:nth-child(4n+1) .package-btn {
        background: #1E40AF; /* Dark Blue */
    }

    .package-card:nth-child(4n+2) .package-header,
    .package-card:nth-child(4n+2) .package-btn {
        background: #059669; /* Dark Green */
    }

    .package-card:nth-child(4n+3) .package-header,
    .package-card:nth-child(4n+3) .package-btn {
        background: #4ECDC4; /* Teal */
    }

    .package-card:nth-child(4n+4) .package-header,
    .package-card:nth-child(4n+4) .package-btn {
        background: #7C3AED; /* Dark Purple */
    }

    .package-header {
        background: #1E40AF;
        padding: 30px 25px;
        position: relative;
        color: #fff;
        border-radius: 16px 16px 0 0;
    }

    .package-header h3 {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .package-price-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .package-price-badge .price-amount {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        line-height: 1;
        margin: 0;
    }

    .package-price-badge .price-period {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.9);
        text-transform: uppercase;
        margin-top: 2px;
    }

    .package-speed {
        font-size: 18px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.95);
        margin-top: 10px;
    }

    .package-body {
        padding: 30px 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .package-details {
        margin-bottom: 25px;
        flex: 1;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .detail-item-icon.check {
        color: #4CAF50;
    }

    .detail-item-icon.cross {
        color: #ccc;
    }

    .detail-item span {
        color: #666;
        font-size: 14px;
        line-height: 1.5;
    }

    .package-btn {
        display: block;
        width: 100%;
        padding: 16px;
        background: #1E40AF;
        color: #fff;
        text-align: center;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: auto;
        cursor: pointer;
    }

    .package-btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        color: #fff;
    }

    /* Features Section */
    .features-section {
        background: #f8f9fa;
        max-width: 100% !important;
        margin: 0 !important;
        width: 100%;
    }
    
    .features-section .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .feature-card {
        background: #fff;
        padding: 40px 30px;
        border-radius: 16px;
        text-align: center;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        border-color: #000;
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .feature-icon i {
        font-size: 40px;
        color: #fff;
    }

    .feature-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }

    .feature-card p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
    }

    /* Why Choose Section */
    .why-choose-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin-top: 40px;
    }

    .why-item {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .why-number {
        width: 60px;
        height: 60px;
        background: #000;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .why-text h3 {
        font-size: 22px;
        font-weight: 700;
        color: #000;
        margin-bottom: 8px;
    }

    .why-text p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
    }

    /* Contact Section */
    .contact-section {
        background: #262424;
        color: #fff;
        max-width: 100% !important;
        margin: 0 !important;
        width: 100%;
    }
    
    .contact-section .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .contact-section .section-title,
    .contact-section .section-subtitle {
        color: #fff;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 40px 30px;
        border-radius: 16px;
        text-align: center;
        border: 2px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-5px);
    }

    .contact-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .contact-icon i {
        font-size: 40px;
        color: #fff;
    }

    .contact-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 15px;
    }

    .contact-card p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
        margin: 5px 0;
    }

    @media (max-width: 992px) {
        .hero-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .hero-title {
            font-size: 42px;
        }

        .hero-subtitle {
            font-size: 18px;
        }

        .hero-actions {
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-btn {
            padding: 14px 24px;
            font-size: 14px;
        }

        .hero-right {
            padding: 30px 25px;
        }
    }

    @media (max-width: 768px) {
        body, html {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }
        
        .hero-section {
            min-height: 80vh;
            padding: 80px 15px 30px;
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            background-image: url('{{ asset("images/chalabeel.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: relative;
        }
        
        /* Add dark overlay on top of image background for mobile */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
        
        /* Ensure content is above overlay */
        .hero-section .hero-container {
            position: relative;
            z-index: 1;
        }
        
        .hero-container {
            width: 100%;
            max-width: 100%;
            padding: 0;
        }

        .hero-title {
            font-size: 36px;
        }

        .hero-subtitle {
            font-size: 16px;
        }

        .hero-actions {
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .hero-btn {
            flex: 1;
            min-width: 140px;
            justify-content: center;
            padding: 14px 20px;
            font-size: 13px;
        }

        .hero-right {
            padding: 25px 20px;
            width: 100%;
            max-width: 100%;
        }
        
        /* Ensure all sections span full width on mobile */
        .modern-page,
        .packages-section,
        .features-section,
        .contact-section {
            width: 100%;
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .packages-section .container,
        .features-section .container,
        .contact-section .container {
            width: 100%;
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }

        .google-search-wrapper {
            gap: 8px;
        }

        .material-input-group .form-control {
            padding: 0 15px 0 50px;
            height: 60px;
            max-height: 60px;
            font-size: 15px;
            border-radius: 5px;
        }

        .search-submit-btn {
            padding: 0 20px;
            height: 60px;
            max-height: 60px;
            min-width: 55px;
            border-radius: 5px;
        }

        .search-submit-btn i {
            font-size: 15px;
        }

        .modern-page {
            padding: 40px 15px 20px;
        }

        .isp-section {
            padding: 60px 15px;
        }

        .section-title {
            font-size: 28px;
        }

        .packages-grid,
        .features-grid,
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .package-price-badge {
            width: 70px;
            height: 70px;
        }

        .package-price-badge .price-amount {
            font-size: 18px;
        }

        .package-price-badge .price-period {
            font-size: 9px;
        }

        .why-choose-content {
            grid-template-columns: 1fr;
        }
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Account Result Modal */
    .account-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fadeIn 0.3s ease;
    }

    .account-modal.active {
        display: flex;
    }

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        z-index: 1;
    }

    .modal-container {
        position: relative;
        z-index: 2;
        background: #fff;
        border-radius: 10px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        animation: slideUp 0.4s ease-out;
        position: relative;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        background: #000;
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-close:hover {
        background: #333;
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    .modal-close i {
        font-size: 24px;
    }

    .modal-content {
        padding: 50px 40px 40px;
    }

    .modal-content .result-card {
        margin: 0;
        box-shadow: none;
        border: none;
        padding: 0;
    }

    @media (max-width: 768px) {
        .modal-container {
            max-width: 95%;
            border-radius: 16px;
        }

        .modal-content {
            padding: 40px 25px 30px;
        }

        .modal-close {
            top: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
        }
    }
</style>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=Nv0NmYmz"></script>

<script>
    // Function to speak the Bengali text
    function speakBengali() {
        var bengaliText = document.getElementById('bengali-text');
        if (bengaliText && 'speechSynthesis' in window) {
            const textToSpeak = bengaliText.textContent;
            const utterance = new SpeechSynthesisUtterance(textToSpeak);
            utterance.lang = 'bn-BD';
            window.speechSynthesis.speak(utterance);
        }
    }

    // Modal functionality
    const accountModal = document.getElementById('accountModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalClose = document.getElementById('modalClose');
    const modalContent = document.getElementById('modalContent');
    const accountCheckForm = document.getElementById('accountCheckForm');
    const searchSubmitBtn = document.getElementById('searchSubmitBtn');
    
    // Function to populate modal with user data
    function populateModal(userData) {
        const isExpired = userData.status === 'Expire';
        const statusClass = isExpired ? 'expired' : 'active';
        const statusIcon = isExpired ? 'error' : 'check_circle';
        const statusText = isExpired ? '{{ __('messages.modal.expired') }}' : userData.status;
        
        // Build Bengali text for speech
        let bengaliText = '';
        if (userData.status === 'Active') {
            bengaliText = '{{ __('messages.modal.active_message') }} - ' + userData.payment_date_raw + '। {{ __('messages.modal.thank_you') }}';
        } else if (userData.status === 'Expire') {
            bengaliText = userData.name + '{{ __('messages.modal.expired_message') }}';
        } else {
            bengaliText = userData.name + '{{ __('messages.modal.other_status_message') }} ' + userData.status + '। {{ __('messages.modal.reactivate') }} {{ __('messages.modal.thank_you') }}';
        }
        
        const modalHTML = `
            <div class="result-card ${statusClass}">
                <div style="text-align: center;">
                    <span class="status-badge ${statusClass}">
                        <i class="material-icons" style="vertical-align: middle; font-size: 20px;">${statusIcon}</i>
                        ${statusText}
                    </span>
                </div>

                <div style="margin-top: 20px;">
                    <div class="info-row">
                        <span class="info-label">
                            <i class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 5px;">person</i>
                            {{ __('messages.modal.customer_name') }}
                        </span>
                        <span class="info-value">${userData.name}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">
                            <i class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 5px;">calendar_today</i>
                            {{ __('messages.modal.payment_date') }}
                        </span>
                        <span class="info-value">${userData.payment_date}</span>
                    </div>
                </div>

                ${isExpired ? `
                <div class="payment-info">
                    <h3>
                        <i class="material-icons" style="vertical-align: middle; font-size: 24px;">payment</i>
                        {{ __('messages.modal.bkash_send_money') }}
                    </h3>
                    <div class="number">017 03 58 79 11</div>
                </div>
                ` : ''}

                <div class="contact-info">
                    <p>
                        <i class="material-icons" style="vertical-align: middle; font-size: 18px;">headset_mic</i>
                        {{ __('messages.modal.contact_us') }}
                    </p>
                    <p class="phone">017 78 57 33 96 • 017 03 58 79 11</p>
                </div>

                <p style="display: none" id="bengali-text">${bengaliText}</p>
            </div>
        `;
        
        modalContent.innerHTML = modalHTML;
    }
    
    // Function to open modal
    function openModal() {
        // Maintain grid columns before opening modal
        maintainPackageGridColumns();
        
        // Compensate for scrollbar width
        const scrollbarWidth = getScrollbarWidth();
        if (scrollbarWidth > 0) {
            document.body.style.paddingRight = scrollbarWidth + 'px';
        }
        
        accountModal.classList.add('active');
        document.body.classList.add('modal-open');
        document.body.style.overflow = 'hidden';
        
        // Recalculate grid after modal opens
        setTimeout(function() {
            maintainPackageGridColumns();
        }, 50);
        
        // Speak Bengali text
        speakBengali();
    }
    
    // Handle form submission via AJAX
    if (accountCheckForm) {
        accountCheckForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const contactInput = document.getElementById('search');
            const contact = contactInput.value.trim();
            
            // Validation
            if (!contact || contact.length !== 11) {
                alert('Please enter a valid 11-digit contact number.');
                return;
            }
            
            // Disable submit button and show loading state
            if (searchSubmitBtn) {
                searchSubmitBtn.disabled = true;
                searchSubmitBtn.innerHTML = '<i class="material-icons">hourglass_empty</i>';
            }
            
            // Make AJAX request
            fetch('{{ route("account.check.post") }}?contact=' + encodeURIComponent(contact), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Re-enable submit button
                if (searchSubmitBtn) {
                    searchSubmitBtn.disabled = false;
                    searchSubmitBtn.innerHTML = '<i class="material-icons">search</i>';
                }
                
                if (data.success && data.user) {
                    // Populate and show modal
                    populateModal(data.user);
                    openModal();
                } else {
                    // Show error message
                    alert(data.message || 'No account found with this contact number.');
                }
            })
            .catch(error => {
                // Re-enable submit button
                if (searchSubmitBtn) {
                    searchSubmitBtn.disabled = false;
                    searchSubmitBtn.innerHTML = '<i class="material-icons">search</i>';
                }
                
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    }

    // Function to calculate scrollbar width
    function getScrollbarWidth() {
        const outer = document.createElement('div');
        outer.style.visibility = 'hidden';
        outer.style.overflow = 'scroll';
        outer.style.msOverflowStyle = 'scrollbar';
        document.body.appendChild(outer);
        const inner = document.createElement('div');
        outer.appendChild(inner);
        const scrollbarWidth = outer.offsetWidth - inner.offsetWidth;
        outer.parentNode.removeChild(outer);
        return scrollbarWidth;
    }

    // Function to calculate and set grid columns
    function maintainPackageGridColumns() {
        const packagesGrid = document.querySelector('.packages-grid');
        const packageCards = document.querySelectorAll('.packages-grid .package-card');
        const container = document.querySelector('.packages-section .container');
        
        if (!packagesGrid || !container || packageCards.length === 0) {
            return;
        }
        
        // Get container width - calculate before modal opens to get accurate width
        const containerWidth = container.getBoundingClientRect().width;
        const cardMinWidth = 280;
        const gap = 30;
        const numPackages = packageCards.length;
        
        // Calculate how many columns can fit
        let columns = 1;
        if (containerWidth >= (cardMinWidth * numPackages + gap * (numPackages - 1))) {
            columns = numPackages; // Can fit all packages in a row
        } else if (containerWidth >= (cardMinWidth * 3 + gap * 2)) {
            columns = 3; // Can fit 3 columns
        } else if (containerWidth >= (cardMinWidth * 2 + gap)) {
            columns = 2; // Can fit 2 columns
        }
        
        // Ensure we don't show more columns than packages
        columns = Math.min(columns, numPackages);
        
        // Force grid template to maintain columns BEFORE modal opens
        if (columns > 1) {
            packagesGrid.style.gridTemplateColumns = 'repeat(' + columns + ', minmax(' + cardMinWidth + 'px, 1fr))';
            packagesGrid.setAttribute('data-forced-columns', columns);
        } else {
            packagesGrid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(' + cardMinWidth + 'px, 1fr))';
            packagesGrid.removeAttribute('data-forced-columns');
        }
    }

    // For backward compatibility - if user data exists on page load, show modal
    // This is handled in the modal HTML section above with inline script

    // Close modal functions
    function closeModal() {
        accountModal.classList.remove('active');
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        
        // Remove user parameter from URL
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeModal);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && accountModal.classList.contains('active')) {
            closeModal();
        }
    });

    // Input validation for mobile number
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            var value = e.target.value;
            if (value.length > 11) {
                e.target.value = value.slice(0, 11);
            }
        });
    }
    
    // Maintain grid columns on window resize when modal is open
    let resizeTimer;
    window.addEventListener('resize', function() {
        if (accountModal && accountModal.classList.contains('active')) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                maintainPackageGridColumns();
            }, 100);
        }
    });
    
    // Also maintain columns when modal is opened (for any reason)
    if (accountModal) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (accountModal.classList.contains('active')) {
                        setTimeout(function() {
                            maintainPackageGridColumns();
                        }, 50);
                    }
                }
            });
        });
        observer.observe(accountModal, { attributes: true });
    }
</script>

@endsection
