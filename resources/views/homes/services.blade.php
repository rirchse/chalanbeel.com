@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('home')
@section('title', __('messages.titles.services'))
@section('content')

<style type="text/css">
    .services-page {
        min-height: calc(100vh - 200px);
        padding: 77px 0 0;
        background: #fff;
    }

    .services-header {
        text-align: center;
        padding: 60px 20px;
        background: #000;
        color: #fff;
        margin-bottom: 0;
    }

    .services-title {
        font-size: 56px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 20px 0;
        letter-spacing: 1px;
    }

    .services-subtitle {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .service-section {
        padding: 100px 20px;
        position: relative;
        overflow: hidden;
    }

    .service-section:nth-child(even) {
        background: #f8f8f8;
    }

    .service-section:nth-child(odd) {
        background: #fff;
    }

    .service-container {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .service-section:nth-child(even) .service-container {
        direction: rtl;
    }

    .service-section:nth-child(even) .service-content,
    .service-section:nth-child(even) .service-visual {
        direction: ltr;
    }

    .service-visual {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-icon-wrapper {
        width: 200px;
        height: 200px;
        background: #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .service-section:hover .service-icon-wrapper {
        transform: scale(1.05);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
    }

    .service-icon-wrapper i {
        font-size: 100px;
        color: #fff;
    }

    .service-content {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .service-number {
        font-size: 18px;
        font-weight: 600;
        color: #666;
        letter-spacing: 1px;
        margin: 0;
    }

    .service-name {
        font-size: 42px;
        font-weight: 700;
        color: #000;
        margin: 0;
        letter-spacing: 0.5px;
        line-height: 1.3;
    }

    .service-description {
        font-size: 18px;
        color: #555;
        line-height: 1.8;
        margin: 0;
    }

    .service-features {
        list-style: none;
        padding: 0;
        margin: 20px 0 0 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .service-features li {
        font-size: 16px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .service-features li::before {
        content: '✓';
        width: 24px;
        height: 24px;
        background: #000;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        flex-shrink: 0;
    }

    .service-divider {
        height: 2px;
        background: linear-gradient(to right, transparent, #1501ab, transparent);
        margin: 0;
        border: none;
    }

    @media (max-width: 968px) {
        .service-container {
            grid-template-columns: 1fr;
            gap: 50px;
        }

        .service-section:nth-child(even) .service-container {
            direction: ltr;
        }

        .service-visual {
            order: -1;
        }

        .service-icon-wrapper {
            width: 150px;
            height: 150px;
        }

        .service-icon-wrapper i {
            font-size: 80px;
        }

        .service-name {
            font-size: 32px;
            text-align: center;
        }

        .service-description {
            text-align: center;
        }
    }

    @media (max-width: 768px) {
        .services-header {
            padding: 40px 20px;
        }

        .services-title {
            font-size: 36px;
        }

        .services-subtitle {
            font-size: 16px;
        }

        .service-section {
            padding: 60px 20px;
        }

        .service-name {
            font-size: 28px;
        }

        .service-description {
            font-size: 16px;
        }
    }
</style>

<div class="services-page">
    <!-- Header Section -->
    <div class="services-header">
        <h1 class="services-title">{{ __('messages.services.page_title') }}</h1>
        <p class="services-subtitle">
            {{ __('messages.services.page_subtitle') }}
        </p>
    </div>

    <!-- Service 1: Fiber Optics Internet -->
    <section class="service-section">
        <div class="service-container">
            <div class="service-visual">
                <div class="service-icon-wrapper">
                    <i class="material-icons">fiber_manual_record</i>
                </div>
            </div>
            <div class="service-content">
                <p class="service-number">{{ __('messages.services.service_number') }} ০১</p>
                <h2 class="service-name">{{ __('messages.services.fiber_title') }}</h2>
                <p class="service-description">
                    {{ __('messages.services.fiber_desc') }}
                </p>
                <ul class="service-features">
                    <li>{{ __('messages.services.fiber_feature1') }}</li>
                    <li>{{ __('messages.services.fiber_feature2') }}</li>
                    <li>{{ __('messages.services.fiber_feature3') }}</li>
                    <li>{{ __('messages.services.fiber_feature4') }}</li>
                    <li>{{ __('messages.services.fiber_feature5') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <hr class="service-divider">

    <!-- Service 2: Wireless Internet -->
    <section class="service-section">
        <div class="service-container">
            <div class="service-visual">
                <div class="service-icon-wrapper">
                    <i class="material-icons">router</i>
                </div>
            </div>
            <div class="service-content">
                <p class="service-number">{{ __('messages.services.service_number') }} ০২</p>
                <h2 class="service-name">{{ __('messages.services.wireless_title') }}</h2>
                <p class="service-description">
                    {{ __('messages.services.wireless_desc') }}
                </p>
                <ul class="service-features">
                    <li>{{ __('messages.services.wireless_feature1') }}</li>
                    <li>{{ __('messages.services.wireless_feature2') }}</li>
                    <li>{{ __('messages.services.wireless_feature3') }}</li>
                    <li>{{ __('messages.services.wireless_feature4') }}</li>
                    <li>{{ __('messages.services.wireless_feature5') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <hr class="service-divider">

    <!-- Service 3: Software Development -->
    <section class="service-section">
        <div class="service-container">
            <div class="service-visual">
                <div class="service-icon-wrapper">
                    <i class="material-icons">code</i>
                </div>
            </div>
            <div class="service-content">
                <p class="service-number">{{ __('messages.services.service_number') }} ০৩</p>
                <h2 class="service-name">{{ __('messages.services.software_title') }}</h2>
                <p class="service-description">
                    {{ __('messages.services.software_desc') }}
                </p>
                <ul class="service-features">
                    <li>{{ __('messages.services.software_feature1') }}</li>
                    <li>{{ __('messages.services.software_feature2') }}</li>
                    <li>{{ __('messages.services.software_feature3') }}</li>
                    <li>{{ __('messages.services.software_feature4') }}</li>
                    <li>{{ __('messages.services.software_feature5') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <hr class="service-divider">

    <!-- Service 4: Inventory Management -->
    <section class="service-section">
        <div class="service-container">
            <div class="service-visual">
                <div class="service-icon-wrapper">
                    <i class="material-icons">inventory</i>
                </div>
            </div>
            <div class="service-content">
                <p class="service-number">{{ __('messages.services.service_number') }} ০৪</p>
                <h2 class="service-name">{{ __('messages.services.inventory_title') }}</h2>
                <p class="service-description">
                    {{ __('messages.services.inventory_desc') }}
                </p>
                <ul class="service-features">
                    <li>{{ __('messages.services.inventory_feature1') }}</li>
                    <li>{{ __('messages.services.inventory_feature2') }}</li>
                    <li>{{ __('messages.services.inventory_feature3') }}</li>
                    <li>{{ __('messages.services.inventory_feature4') }}</li>
                    <li>{{ __('messages.services.inventory_feature5') }}</li>
                </ul>
            </div>
        </div>
    </section>
</div>

@endsection
