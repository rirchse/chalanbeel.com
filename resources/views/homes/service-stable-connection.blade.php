@extends('home')
@section('title', __('messages.titles.service_stable_connection'))
@section('content')

<style type="text/css">
    .service-page {
        min-height: calc(100vh - 200px);
        padding: 77px 0 0;
        background: #fff;
    }

    .service-hero {
        text-align: center;
        padding: 80px 20px;
        background: #000;
        color: #fff;
        margin-bottom: 0;
    }

    .service-hero-icon {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
    }

    .service-hero-icon i {
        font-size: 60px;
        color: #fff;
    }

    .service-hero-title {
        font-size: 48px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 20px 0;
        letter-spacing: 1px;
    }

    .service-hero-subtitle {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .service-content-section {
        padding: 80px 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .service-content-section:nth-child(even) {
        background: #f8f9fa;
    }

    .service-content-section:nth-child(odd) {
        background: #fff;
    }

    .section-title {
        font-size: 36px;
        font-weight: 700;
        color: #000;
        margin-bottom: 30px;
        text-align: center;
    }

    .service-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .feature-card {
        background: #fff;
        border: 2px solid #000;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
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

    .feature-title {
        font-size: 22px;
        font-weight: 700;
        color: #000;
        margin-bottom: 15px;
    }

    .feature-description {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
    }

    .service-description {
        font-size: 18px;
        color: #333;
        line-height: 1.8;
        text-align: center;
        max-width: 900px;
        margin: 0 auto 50px;
    }

    .cta-section {
        text-align: center;
        padding: 60px 20px;
        background: #000;
        color: #fff;
    }

    .cta-button {
        display: inline-block;
        padding: 16px 40px;
        background: #fff;
        color: #000;
        text-decoration: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .cta-button:hover {
        background: #f0f0f0;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    }

    @media (max-width: 768px) {
        .service-hero-title {
            font-size: 32px;
        }
        .service-features {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="service-page">
    <div class="service-hero">
        <div class="service-hero-icon">
            <i class="material-icons">wifi</i>
        </div>
        <h1 class="service-hero-title">{{ __('messages.service_stable.hero_title') }}</h1>
        <p class="service-hero-subtitle">
            {{ __('messages.service_stable.hero_subtitle') }}
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            {{ __('messages.service_stable.description') }}
        </p>

        <h2 class="section-title">{{ __('messages.service_stable.features_title') }}</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">signal_wifi_4_bar</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_stable.feature_uptime_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_stable.feature_uptime_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">network_check</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_stable.feature_uninterrupted_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_stable.feature_uninterrupted_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">monitoring</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_stable.feature_monitoring_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_stable.feature_monitoring_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">backup</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_stable.feature_backup_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_stable.feature_backup_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">speed</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_stable.feature_consistent_speed_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_stable.feature_consistent_speed_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">settings_backup_restore</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_stable.feature_fast_recovery_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_stable.feature_fast_recovery_desc') }}
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">{{ __('messages.service_stable.cta_title') }}</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">{{ __('messages.service_stable.cta_subtitle') }}</p>
        <a href="/package" class="cta-button">{{ __('messages.service_stable.cta_button') }}</a>
    </div>
</div>

@endsection

