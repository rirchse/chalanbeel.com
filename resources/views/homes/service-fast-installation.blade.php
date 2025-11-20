@extends('home')
@section('title', __('messages.titles.service_fast_installation'))
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

    .process-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .process-step {
        text-align: center;
        position: relative;
    }

    .step-number {
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
        margin: 0 auto 20px;
    }

    .step-title {
        font-size: 20px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }

    .step-description {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
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
        .service-features, .process-steps {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="service-page">
    <div class="service-hero">
        <div class="service-hero-icon">
            <i class="material-icons">build</i>
        </div>
        <h1 class="service-hero-title">{{ __('messages.service_fast_install.hero_title') }}</h1>
        <p class="service-hero-subtitle">
            {{ __('messages.service_fast_install.hero_subtitle') }}
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            {{ __('messages.service_fast_install.description') }}
        </p>

        <h2 class="section-title">{{ __('messages.service_fast_install.process_title') }}</h2>

        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">১</div>
                <h3 class="step-title">{{ __('messages.service_fast_install.step1_title') }}</h3>
                <p class="step-description">
                    {{ __('messages.service_fast_install.step1_desc') }}
                </p>
            </div>

            <div class="process-step">
                <div class="step-number">২</div>
                <h3 class="step-title">{{ __('messages.service_fast_install.step2_title') }}</h3>
                <p class="step-description">
                    {{ __('messages.service_fast_install.step2_desc') }}
                </p>
            </div>

            <div class="process-step">
                <div class="step-number">৩</div>
                <h3 class="step-title">{{ __('messages.service_fast_install.step3_title') }}</h3>
                <p class="step-description">
                    {{ __('messages.service_fast_install.step3_desc') }}
                </p>
            </div>

            <div class="process-step">
                <div class="step-number">৪</div>
                <h3 class="step-title">{{ __('messages.service_fast_install.step4_title') }}</h3>
                <p class="step-description">
                    {{ __('messages.service_fast_install.step4_desc') }}
                </p>
            </div>
        </div>

        <h2 class="section-title" style="margin-top: 60px;">{{ __('messages.service_fast_install.benefits_title') }}</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">schedule</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_fast_install.feature_fast_service_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_fast_install.feature_fast_service_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">engineering</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_fast_install.feature_experienced_tech_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_fast_install.feature_experienced_tech_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">tools</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_fast_install.feature_modern_tools_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_fast_install.feature_modern_tools_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">check_circle</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_fast_install.feature_guarantee_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_fast_install.feature_guarantee_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">home</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_fast_install.feature_free_visit_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_fast_install.feature_free_visit_desc') }}
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">support_agent</i>
                </div>
                <h3 class="feature-title">{{ __('messages.service_fast_install.feature_support_title') }}</h3>
                <p class="feature-description">
                    {{ __('messages.service_fast_install.feature_support_desc') }}
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">{{ __('messages.service_fast_install.cta_title') }}</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">{{ __('messages.service_fast_install.cta_subtitle') }}</p>
        <a href="/register/create" class="cta-button">{{ __('messages.service_fast_install.cta_button') }}</a>
    </div>
</div>

@endsection

