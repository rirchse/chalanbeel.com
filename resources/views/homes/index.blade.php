@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('home')
@section('title', 'Welcome')
@section('content')

<style type="text/css">
    .hero-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 40px;
        position: relative;
        overflow: hidden;
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

    .hero-subtitle {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.95);
        line-height: 1.6;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .hero-actions {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 10px;
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
        position: fixed;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        transform: translateX(-50%) translateY(-50%);
        z-index: -2;
    }

    .video-background iframe {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100vw;
        height: 100vh;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    @media (min-aspect-ratio: 16/9) {
        .video-background iframe {
            height: 56.25vw;
        }
    }

    @media (max-aspect-ratio: 16/9) {
        .video-background iframe {
            width: 177.78vh;
        }
    }

    /* Dark overlay for better text visibility - Only for Hero */
    .video-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 70vh;
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

    .material-input-group {
        position: relative;
        margin-bottom: 30px;
    }

    .material-input-group .form-control {
        background: #f5f5f5;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 18px 20px 18px 50px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: none;
    }

    .material-input-group .form-control:focus {
        background: #fff;
        border-color: #000;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
    }

    .material-input-group .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .material-input-group .form-control:focus ~ .input-icon {
        color: #000;
    }

    .submit-btn {
        background: #000;
        border: none;
        border-radius: 12px;
        padding: 16px 0;
        width: 100%;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
        background: #333;
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

<!-- Hero Section -->
<div class="hero-section">
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
                <a href="/package" class="hero-btn hero-btn-outline">
                    <i class="material-icons">view_list</i>
                    {{ __('messages.hero.view_packages') }}
                </a>
                <a href="/view-user-on-map" class="hero-btn hero-btn-outline">
                    <i class="material-icons">map</i>
                    {{ __('messages.hero.view_map') }}
                </a>
            </div>
        </div>

        <!-- Right Side: Search Form -->
        <div class="hero-right">
            <h3 class="search-card-title">{{ __('messages.search.title') }}</h3>
            <p class="search-card-subtitle">{{ __('messages.search.subtitle') }}</p>
            <form class="search-form" action="{{route('account.check.post')}}" method="GET">
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
                    <i class="material-icons input-icon">phone</i>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="material-icons" style="vertical-align: middle; margin-right: 5px;">search</i>
                    {{ __('messages.search.button') }}
                </button>
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
        
        @if(isset($user) && $user != [])
        <div class="modal-content">
            <div class="result-card {{ $user->status == 'Expire' ? 'expired' : 'active' }}">
                <div style="text-align: center;">
                    <span class="status-badge {{ $user->status == 'Expire' ? 'expired' : 'active' }}">
                        @if($user->status == 'Expire')
                            <i class="material-icons" style="vertical-align: middle; font-size: 20px;">error</i>
                            {{ __('messages.modal.expired') }}
                        @else
                            <i class="material-icons" style="vertical-align: middle; font-size: 20px;">check_circle</i>
                            {{$user->status}}
                        @endif
                    </span>
                </div>

                <div style="margin-top: 20px;">
                    <div class="info-row">
                        <span class="info-label">
                            <i class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 5px;">person</i>
                            {{ __('messages.modal.customer_name') }}
                        </span>
                        <span class="info-value">{{$user->name}}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">
                            <i class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 5px;">calendar_today</i>
                            {{ __('messages.modal.payment_date') }}
                        </span>
                        <span class="info-value">{{$source->dtformat($user->payment_date)}}</span>
                    </div>
                </div>

                @if($user->status == 'Expire')
                <div class="payment-info">
                    <h3>
                        <i class="material-icons" style="vertical-align: middle; font-size: 24px;">payment</i>
                        {{ __('messages.modal.bkash_send_money') }}
                    </h3>
                    <div class="number">017 03 58 79 11</div>
                </div>
                @endif

                <div class="contact-info">
                    <p>
                        <i class="material-icons" style="vertical-align: middle; font-size: 18px;">headset_mic</i>
                        {{ __('messages.modal.contact_us') }}
                    </p>
                    <p class="phone">017 78 57 33 96 • 017 03 58 79 11</p>
                </div>

                <p style="display: none" id="bengali-text">
                    @if($user->status == 'Active')
                    {{ __('messages.modal.active_message') }} - {{$user->payment_date}}। {{ __('messages.modal.thank_you') }}
                    @elseif($user->status == 'Expire')
                    {{$user->name}}{{ __('messages.modal.expired_message') }}
                    @else
                    {{$user->name}}{{ __('messages.modal.other_status_message') }} {{$user->status}}। {{ __('messages.modal.reactivate') }} 
                    {{ __('messages.modal.thank_you') }}
                    @endif
                </p>
            </div>
        </div>
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
                    @foreach($packages as $package)
                    <div class="package-card">
                        <div class="package-header">
                            <h3>{{ $package->service ?? __('messages.packages.internet') }}</h3>
                            <div class="package-speed">{{ $package->speed ?? 'N/A' }}</div>
                        </div>
                        <div class="package-body">
                            <div class="package-details">
                                <div class="detail-item">
                                    <i class="material-icons">speed</i>
                                    <span>{{ __('messages.packages.speed') }}: {{ $package->speed ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="material-icons">schedule</i>
                                    <span>{{ __('messages.packages.time') }}: {{ $package->time_limit ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="material-icons">router</i>
                                    <span>{{ __('messages.packages.connection') }}: {{ $package->connection ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="package-price">
                                <span class="price-amount">৳{{ number_format($package->price ?? 0) }}</span>
                                @if(isset($package->discount) && $package->discount > 0)
                                <span class="price-discount">৳{{ number_format($package->price + $package->discount) }}</span>
                                @endif
                            </div>
                            <a href="/register/create/{{ $package->id }}" class="package-btn">{{ __('messages.packages.buy_now') }}</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="package-card">
                        <div class="package-header">
                            <h3>{{ __('messages.packages.standard') }}</h3>
                            <div class="package-speed">10 Mbps</div>
                        </div>
                        <div class="package-body">
                            <div class="package-details">
                                <div class="detail-item">
                                    <i class="material-icons">speed</i>
                                    <span>{{ __('messages.packages.speed') }}: 10 Mbps</span>
                                </div>
                                <div class="detail-item">
                                    <i class="material-icons">schedule</i>
                                    <span>{{ __('messages.packages.time') }}: 30 {{ __('messages.packages.days') }}</span>
                                </div>
                            </div>
                            <div class="package-price">
                                <span class="price-amount">৳500</span>
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
                        <i class="material-icons">speed</i>
                    </div>
                    <h3>{{ __('messages.services.high_speed') }}</h3>
                    <p>{{ __('messages.services.high_speed_desc') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">support_agent</i>
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
    }

    .isp-section {
        padding: 80px 20px;
        max-width: 1400px;
        margin: 0 auto;
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
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .package-card {
        background: #fff;
        border: 2px solid #000;
        border-radius: 16px;
        padding: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    .package-header {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 2px solid #000;
        margin-bottom: 20px;
    }

    .package-header h3 {
        font-size: 24px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }

    .package-speed {
        font-size: 32px;
        font-weight: 700;
        color: #000;
    }

    .package-details {
        margin-bottom: 25px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item i {
        color: #000;
        font-size: 20px;
    }

    .detail-item span {
        color: #333;
        font-size: 15px;
    }

    .package-price {
        text-align: center;
        margin-bottom: 20px;
    }

    .price-amount {
        font-size: 36px;
        font-weight: 700;
        color: #000;
    }

    .price-discount {
        font-size: 20px;
        color: #999;
        text-decoration: line-through;
        margin-left: 10px;
    }

    .package-btn {
        display: block;
        width: 100%;
        padding: 14px;
        background: #000;
        color: #fff;
        text-align: center;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .package-btn:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
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
        }

        .hero-right {
            padding: 30px 25px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            min-height: 80vh;
            padding: 80px 15px 30px;
        }

        .hero-title {
            font-size: 36px;
        }

        .hero-subtitle {
            font-size: 16px;
        }

        .hero-actions {
            flex-direction: column;
        }

        .hero-btn {
            width: 100%;
            justify-content: center;
        }

        .hero-right {
            padding: 25px 20px;
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

    // Show modal if user data exists
    @if(isset($user) && $user != [])
    window.addEventListener('load', function() {
        accountModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        speakBengali();
    });
    @endif

    // Close modal functions
    function closeModal() {
        accountModal.classList.remove('active');
        document.body.style.overflow = '';
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
</script>

@endsection
