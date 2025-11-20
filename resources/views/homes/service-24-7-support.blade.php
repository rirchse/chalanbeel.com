@extends('home')
@section('title', __('messages.titles.service_247_support'))
@section('content')

<style type="text/css">
    .service-page {
        min-height: calc(100vh - 200px);
        padding: 44px 0 0;
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

    .support-services-section {
        background: #f8f9fa;
        width: 100%;
        padding: 80px 0;
    }

    .support-services-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
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

    .contact-info {
        background: #f8f9fa;
        padding: 40px;
        border-radius: 12px;
        margin-top: 40px;
        text-align: center;
    }

    .contact-item {
        margin: 20px 0;
        font-size: 18px;
    }

    .contact-item strong {
        color: #000;
        display: block;
        margin-bottom: 5px;
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
            <i class="material-icons">headset_mic</i>
        </div>
        <h1 class="service-hero-title">{{ __('messages.service_247.hero_title') }}</h1>
        <p class="service-hero-subtitle">
            {{ __('messages.service_247.hero_subtitle') }}
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            {{ __('messages.service_247.description') }}
        </p>
    </div>

    <div class="support-services-section">
        <div class="support-services-container">
            <h2 class="section-title">{{ __('messages.service_247.support_services_title') }}</h2>

            <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">phone</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_247.feature_phone_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_247.feature_phone_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">email</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_247.feature_email_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_247.feature_email_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">home</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_247.feature_home_visit_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_247.feature_home_visit_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">schedule</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_247.feature_fast_response_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_247.feature_fast_response_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">translate</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_247.feature_multilingual_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_247.feature_multilingual_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">verified_user</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_247.feature_experienced_team_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_247.feature_experienced_team_desc') }}
                </p>
            </div>
        </div>
    </div>

    <div class="service-content-section">
        <div class="contact-info">
            <h3 style="font-size: 28px; margin-bottom: 30px; color: #000;">{{ __('messages.service_247.contact_title') }}</h3>
            <div class="contact-item">
                <strong>{{ __('messages.service_247.contact_phone') }}:</strong>
                <span>017 78 57 33 96</span><br>
                <span>017 03 58 79 11</span>
            </div>
            <div class="contact-item">
                <strong>{{ __('messages.service_247.contact_email') }}:</strong>
                <span>info@chalanbeel.com</span><br>
                <span>support@chalanbeel.com</span>
            </div>
            <div class="contact-item">
                <strong>{{ __('messages.service_247.contact_time') }}:</strong>
                <span>{{ __('messages.service_247.contact_hours') }}</span>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">{{ __('messages.service_247.cta_title') }}</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">{{ __('messages.service_247.cta_subtitle') }}</p>
        <a href="/register/create" class="cta-button">{{ __('messages.service_247.cta_button') }}</a>
    </div>
</div>

@endsection

