@extends('home')
@section('title', 'প্যাকেজ')
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
        border-bottom: 3px solid #000;
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
        background: #000;
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
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 40px;
        margin-top: 50px;
    }

    .package-card {
        background: #fff;
        border: 3px solid #000;
        border-radius: 24px;
        padding: 40px 30px;
        transition: all 0.4s ease;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .package-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #000 0%, #333 50%, #000 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        border-color: #333;
    }

    .package-card:hover::before {
        transform: scaleX(1);
    }

    .package-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #000;
        color: #fff;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .package-header {
        text-align: center;
        padding-bottom: 25px;
        border-bottom: 2px solid #000;
        margin-bottom: 30px;
        position: relative;
    }

    .package-service {
        font-size: 18px;
        font-weight: 600;
        color: #666;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .package-speed {
        font-size: 48px;
        font-weight: 800;
        color: #000;
        line-height: 1;
        margin: 10px 0;
    }

    .package-speed-unit {
        font-size: 20px;
        font-weight: 600;
        color: #666;
        margin-left: 5px;
    }

    .package-body {
        flex: 1;
        margin-bottom: 30px;
    }

    .package-details {
        margin-bottom: 25px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item:hover {
        background: rgba(0, 0, 0, 0.02);
        margin: 0 -10px;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 8px;
    }

    .detail-label {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #666;
        font-size: 15px;
    }

    .detail-label i {
        color: #000;
        font-size: 20px;
    }

    .detail-value {
        font-size: 16px;
        font-weight: 700;
        color: #000;
        text-align: right;
    }

    .package-price-section {
        text-align: center;
        padding: 25px 0;
        border-top: 2px solid #000;
        border-bottom: 2px solid #000;
        margin: 25px 0;
    }

    .price-label {
        font-size: 14px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .price-amount {
        font-size: 42px;
        font-weight: 800;
        color: #000;
        line-height: 1;
        margin: 0;
    }

    .price-discount {
        font-size: 18px;
        color: #999;
        text-decoration: line-through;
        margin-top: 5px;
    }

    .package-btn {
        display: block;
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        border: 3px solid #000;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        margin-top: auto;
    }

    .package-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .package-btn:hover::before {
        left: 100%;
    }

    .package-btn:hover {
        background: linear-gradient(135deg, #1a1a1a 0%, #000 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    .package-btn i {
        margin-right: 8px;
        font-size: 20px;
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
            font-size: 36px;
        }

        .price-amount {
            font-size: 36px;
        }
    }
</style>

<div class="packages-page">
    <div class="packages-container">
        <div class="packages-header">
            <h1 class="packages-title">ইন্টারনেট প্যাকেজ</h1>
            <p class="packages-subtitle">
                আমাদের সাশ্রয়ী মূল্যের ইন্টারনেট প্যাকেজসমূহ দেখুন। 
                আপনার প্রয়োজন অনুযায়ী সঠিক প্যাকেজ নির্বাচন করুন এবং এখনই নিবন্ধন করুন।
            </p>
        </div>

        @if(isset($packages) && count($packages) > 0)
        <div class="packages-grid">
            @foreach($packages as $package)
            <div class="package-card">
                @if(isset($package->discount) && $package->discount > 0)
                <div class="package-badge">ছাড়</div>
                @endif

                <div class="package-header">
                    <div class="package-service">{{ $package->service ?? 'ইন্টারনেট' }}</div>
                    <div class="package-speed">
                        {{ $package->speed ?? 'N/A' }}
                        <span class="package-speed-unit">Mbps</span>
                    </div>
                </div>

                <div class="package-body">
                    <div class="package-details">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="material-icons">speed</i>
                                <span>গতি</span>
                            </div>
                            <div class="detail-value">{{ $package->speed ?? 'N/A' }} Mbps</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="material-icons">schedule</i>
                                <span>সময় সীমা</span>
                            </div>
                            <div class="detail-value">{{ $package->time_limit ?? 'N/A' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="material-icons">router</i>
                                <span>সংযোগ</span>
                            </div>
                            <div class="detail-value">{{ $package->connection ?? 'N/A' }}</div>
                        </div>
                        @if(isset($package->service_mode))
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="material-icons">settings</i>
                                <span>সেবা মোড</span>
                            </div>
                            <div class="detail-value">{{ $package->service_mode }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="package-price-section">
                        <div class="price-label">মাসিক মূল্য</div>
                        <div class="price-amount">৳{{ number_format($package->price ?? 0) }}</div>
                        @if(isset($package->discount) && $package->discount > 0)
                        <div class="price-discount">৳{{ number_format($package->price + $package->discount) }}</div>
                        @endif
                    </div>
                </div>

                <a href="/register/create/{{ $package->id }}" class="package-btn">
                    <i class="material-icons">shopping_cart</i>
                    এখনই কিনুন
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-packages">
            <div class="no-packages-icon">
                <i class="material-icons">inbox</i>
            </div>
            <h3>কোনো প্যাকেজ পাওয়া যায়নি</h3>
            <p>বর্তমানে কোনো সক্রিয় প্যাকেজ নেই। অনুগ্রহ করে পরে আবার চেষ্টা করুন।</p>
        </div>
        @endif
    </div>
</div>

@endsection
