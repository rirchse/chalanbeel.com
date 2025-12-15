@extends('home')
@section('title', __('messages.titles.packages'))
@section('content')

<style type="text/css">
    .packages-page {
        min-height: calc(100vh - 200px);
        padding: 100px 20px 80px;
        background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);
        position: relative;
    }

    .packages-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #000 0%, #333 50%, #000 100%);
    }

    .packages-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .packages-header {
        text-align: center;
        margin-bottom: 60px;
        padding-bottom: 30px;
        border-bottom: 3px solid #3f4cab;
        position: relative;
    }

    .packages-header::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: #03bb7f;
    }

    .packages-title {
        font-size: 56px;
        font-weight: 800;
        color: #000;
        margin: 0 0 20px 0;
        letter-spacing: 3px;
        position: relative;
        display: inline-block;
    }

    .packages-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: #000;
    }

    .packages-subtitle {
        font-size: 20px;
        color: #666;
        margin: 25px 0 0 0;
        line-height: 1.8;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 50px;
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

    .package-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(0, 0, 0, 0.3);
        color: #fff;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        z-index: 2;
    }

    .package-header {
        background: #1E40AF;
        padding: 30px 25px;
        position: relative;
        color: #fff;
        border-radius: 16px 16px 0 0;
    }

    .package-service {
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

    .package-speed-unit {
        font-size: 14px;
        font-weight: 400;
        margin-left: 5px;
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

    .detail-label {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #666;
        font-size: 14px;
        flex: 1;
    }

    .detail-label i {
        color: #000;
        font-size: 18px;
    }

    .detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #333;
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

    .package-btn i {
        margin-right: 8px;
        font-size: 18px;
        vertical-align: middle;
    }

    .no-packages {
        text-align: center;
        padding: 80px 20px;
        background: #fff;
        border: 2px solid #000;
        border-radius: 20px;
    }

    .no-packages-icon {
        font-size: 80px;
        color: #ccc;
        margin-bottom: 20px;
    }

    .no-packages h3 {
        font-size: 28px;
        font-weight: 700;
        color: #000;
        margin: 0 0 15px 0;
    }

    .no-packages p {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    @media (max-width: 968px) {
        .packages-page {
            padding: 80px 15px 60px;
        }

        .packages-title {
            font-size: 42px;
        }

        .packages-subtitle {
            font-size: 18px;
        }

        .packages-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
    }

    @media (max-width: 768px) {
        .packages-page {
            padding: 80px 15px 40px;
        }

        .packages-title {
            font-size: 36px;
            letter-spacing: 1px;
        }

        .packages-subtitle {
            font-size: 16px;
        }

        .packages-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .package-card {
            padding: 30px 20px;
        }

        .package-speed {
            font-size: 16px;
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
    }
</style>

<div class="packages-page">
    <div class="packages-container">
        <div class="packages-header">
            <h1 class="packages-title">{{ __('messages.packages.page_title') }}</h1>
            <p class="packages-subtitle">
                {{ __('messages.packages.page_subtitle') }}
            </p>
        </div>

        @if(isset($packages) && count($packages) > 0)
        <div class="packages-grid">
            @foreach($packages as $index => $package)
            <div class="package-card">
                @if(isset($package->discount) && $package->discount > 0)
                <div class="package-badge">{{ __('messages.packages.discount') }}</div>
                @endif

                <div class="package-header">
                    <div class="package-service">{{ $package->service ?? __('messages.packages.internet') }}</div>
                    <div class="package-price-badge">
                        <div class="price-amount">৳{{ number_format($package->price ?? 0) }}</div>
                        <div class="price-period">{{ __('messages.packages.per_month') }}</div>
                    </div>
                    <div class="package-speed">
                        {{ $package->speed ?? 'N/A' }}
                        <span class="package-speed-unit">{{ __('messages.packages.mbps') }}</span>
                    </div>
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
                                    __('messages.packages.speed_label') . ': ' . ($package->speed ?? 'N/A') . ' ' . __('messages.packages.mbps'),
                                    __('messages.packages.time_label') . ': ' . ($package->time_limit ?? 'N/A'),
                                    __('messages.packages.connection_label') . ': ' . ($package->connection ?? 'N/A'),
                                    __('messages.packages.support_247')
                                ];
                                if(isset($package->service_mode)) {
                                    $listItems[] = __('messages.packages.service_mode') . ': ' . $package->service_mode;
                                }
                            }
                        @endphp
                        @foreach($listItems as $item)
                        <div class="detail-item">
                            <div class="detail-item-icon check">
                                <i class="material-icons" style="font-size: 18px;">check</i>
                            </div>
                            <div class="detail-label">
                                <span>{{ $item }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="{{ route('user.get-package', $package->id) }}" class="package-btn">
                        <i class="material-icons">shopping_cart</i>
                        {{ __('messages.packages.buy_now') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-packages">
            <div class="no-packages-icon">
                <i class="material-icons">inbox</i>
            </div>
            <h3>{{ __('messages.packages.no_packages_title') }}</h3>
            <p>{{ __('messages.packages.no_packages_message') }}</p>
        </div>
        @endif
    </div>
</div>

@endsection
