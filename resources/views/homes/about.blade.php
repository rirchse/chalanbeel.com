@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('home')
@section('title', __('messages.titles.about'))
@section('content')

<style type="text/css">
    .about-page {
        min-height: calc(100vh - 200px);
        padding: 77px 0 0;
        background: #fff;
    }

    .about-hero {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        background-image: url('{{ asset("images/chalabeel.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        color: #fff;
        padding: 100px 20px 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 500px;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
        animation: pulse 20s ease-in-out infinite;
        z-index: 1;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .about-hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
    }

    .about-hero-title {
        font-size: 64px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 25px 0;
        letter-spacing: 3px;
    }

    .about-hero-subtitle {
        font-size: 22px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.8;
        margin: 0;
    }

    .about-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 80px 20px;
    }

    .about-section {
        margin-bottom: 80px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 50px;
        padding-bottom: 20px;
        border-bottom: 3px solid #000;
        position: relative;
    }

    .section-header::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: #000;
    }

    .section-title {
        font-size: 42px;
        font-weight: 800;
        color: #000;
        margin: 0 0 15px 0;
        letter-spacing: 2px;
    }

    .section-subtitle {
        font-size: 18px;
        color: #666;
        margin: 0;
        line-height: 1.8;
    }

    .about-content {
        font-size: 18px;
        color: #555;
        line-height: 2;
        text-align: center;
        margin: 0 auto;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin-top: 50px;
    }

    .feature-card {
        background: #fff;
        border: 2px solid #000;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #000;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
        background: #333;
    }

    .feature-icon i {
        font-size: 40px;
        color: #fff;
    }

    .feature-title {
        font-size: 24px;
        font-weight: 700;
        color: #000;
        margin: 0 0 15px 0;
    }

    .feature-description {
        font-size: 16px;
        color: #666;
        line-height: 1.8;
        margin: 0;
    }

    .stats-section {
        background: linear-gradient(135deg, #f8f8f8 0%, #ffffff 100%);
        padding: 80px 20px;
        margin: 60px 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 56px;
        font-weight: 800;
        color: #000;
        margin: 0 0 10px 0;
        line-height: 1;
    }

    .stat-label {
        font-size: 18px;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .mission-vision {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        margin-top: 50px;
    }

    .mission-card, .vision-card {
        background: #fff;
        border: 2px solid #000;
        border-radius: 20px;
        padding: 40px;
        position: relative;
    }

    /* .mission-card::before, .vision-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #000;
    } */

    .mission-title, .vision-title {
        font-size: 32px;
        font-weight: 800;
        color: #000;
        margin: 0 0 20px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mission-title i, .vision-title i {
        font-size: 36px;
    }

    .mission-text, .vision-text {
        font-size: 17px;
        color: #555;
        line-height: 1.9;
        margin: 0;
    }

    @media (max-width: 968px) {
        .about-hero-title {
            font-size: 48px;
        }

        .about-hero-subtitle {
            font-size: 18px;
        }

        .section-title {
            font-size: 36px;
        }

        .features-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .mission-vision {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .about-hero {
            padding: 60px 20px 50px;
            background-attachment: scroll;
            min-height: 400px;
        }

        .about-hero-title {
            font-size: 36px;
            letter-spacing: 1px;
        }

        .about-container {
            padding: 50px 15px;
        }

        .section-title {
            font-size: 28px;
        }

        .about-content {
            font-size: 16px;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .stat-number {
            font-size: 42px;
        }
    }
</style>

<div class="about-page">
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="about-hero-content">
            <h1 class="about-hero-title">{{ __('messages.about.hero_title') }}</h1>
            <p class="about-hero-subtitle">
                {{ __('messages.about.hero_subtitle') }}
            </p>
        </div>
    </div>

    <div class="about-container">
        <!-- About Us Section -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.about.story_title') }}</h2>
                <p class="section-subtitle">{{ __('messages.about.story_subtitle') }}</p>
            </div>
            <div class="about-content">
                <p style="font-size: 19px; line-height: 2.2; text-align: justify; margin-bottom: 30px;">
                    {!! __('messages.about.story_paragraph1') !!}
                </p>
                
                <p style="font-size: 19px; line-height: 2.2; text-align: justify; margin-bottom: 30px;">
                    {!! __('messages.about.story_paragraph2') !!}
                </p>
                
                <p style="font-size: 19px; line-height: 2.2; text-align: justify; margin-bottom: 30px;">
                    {!! __('messages.about.story_paragraph3') !!}
                </p>
                
                <p style="font-size: 19px; line-height: 2.2; text-align: justify; margin-bottom: 30px;">
                    {!! __('messages.about.story_paragraph4') !!}
                </p>
                
                <p style="font-size: 19px; line-height: 2.2; text-align: justify; margin-bottom: 30px;">
                    {!! __('messages.about.story_paragraph5') !!}
                </p>
                
                <p style="font-size: 19px; line-height: 2.2; text-align: justify; margin-top: 40px; padding-top: 30px; border-top: 2px solid #eee; font-style: italic; color: #555;">
                    {!! __('messages.about.story_paragraph6') !!}
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.about.mission_vision_title') }}</h2>
                <p class="section-subtitle">{{ __('messages.about.mission_vision_subtitle') }}</p>
            </div>
            <div class="mission-vision">
                <div class="mission-card">
                    <h3 class="mission-title">
                        <i class="material-icons">flag</i>
                        {{ __('messages.about.mission_title') }}
                    </h3>
                    <p class="mission-text">
                        {{ __('messages.about.mission_text') }}
                    </p>
                </div>
                <div class="vision-card">
                    <h3 class="vision-title">
                        <i class="material-icons">visibility</i>
                        {{ __('messages.about.vision_title') }}
                    </h3>
                    <p class="vision-text">
                        {{ __('messages.about.vision_text') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.about.why_choose_title') }}</h2>
                <p class="section-subtitle">{{ __('messages.about.why_choose_subtitle') }}</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">speed</i>
                    </div>
                    <h3 class="feature-title">{{ __('messages.about.feature_high_speed') }}</h3>
                    <p class="feature-description">
                        {{ __('messages.about.feature_high_speed_desc') }}
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">security</i>
                    </div>
                    <h3 class="feature-title">{{ __('messages.about.feature_security') }}</h3>
                    <p class="feature-description">
                        {{ __('messages.about.feature_security_desc') }}
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">support_agent</i>
                    </div>
                    <h3 class="feature-title">{{ __('messages.about.feature_support') }}</h3>
                    <p class="feature-description">
                        {{ __('messages.about.feature_support_desc') }}
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">payments</i>
                    </div>
                    <h3 class="feature-title">{{ __('messages.about.feature_affordable') }}</h3>
                    <p class="feature-description">
                        {{ __('messages.about.feature_affordable_desc') }}
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">build</i>
                    </div>
                    <h3 class="feature-title">{{ __('messages.about.feature_fast_installation') }}</h3>
                    <p class="feature-description">
                        {{ __('messages.about.feature_fast_installation_desc') }}
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">verified_user</i>
                    </div>
                    <h3 class="feature-title">{{ __('messages.about.feature_trusted') }}</h3>
                    <p class="feature-description">
                        {{ __('messages.about.feature_trusted_desc') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">১০০০+</div>
                    <div class="stat-label">{{ __('messages.about.stats_satisfied_customers') }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">৯৯.৯%</div>
                    <div class="stat-label">{{ __('messages.about.stats_uptime') }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">২৪/৭</div>
                    <div class="stat-label">{{ __('messages.about.stats_support') }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">১০+</div>
                    <div class="stat-label">{{ __('messages.about.stats_experience') }}</div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">{{ __('messages.about.contact_title') }}</h2>
                <p class="section-subtitle">{{ __('messages.about.contact_subtitle') }}</p>
            </div>
            <div class="about-content">
                <p>
                    {{ __('messages.about.contact_text') }}
                </p>
                <p style="margin-top: 25px; font-weight: 600; color: #000;">
                    <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">phone</i>
                    {{ __('messages.about.contact_phone') }}: 017 78 57 33 96, 017 03 58 79 11
                </p>
                <p style="margin-top: 15px; font-weight: 600; color: #000;">
                    <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">schedule</i>
                    {{ __('messages.about.contact_time') }}: {{ __('messages.about.contact_hours') }}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

