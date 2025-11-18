@extends('home')
@section('title', 'বিশ্বস্ত সেবা')
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

    .stats-section {
        background: #f8f9fa;
        padding: 60px 20px;
        margin-top: 40px;
        border-radius: 12px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 18px;
        color: #666;
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
        .service-features, .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="service-page">
    <div class="service-hero">
        <div class="service-hero-icon">
            <i class="material-icons">verified_user</i>
        </div>
        <h1 class="service-hero-title">বিশ্বস্ত সেবা</h1>
        <p class="service-hero-subtitle">
            বছরের পর বছর বিশ্বস্ত সেবা প্রদান করে আসছি। 
            আমাদের সাথে হাজার হাজার সন্তুষ্ট গ্রাহক রয়েছে যারা আমাদের বিশ্বস্ত সেবার উপর আস্থা রাখেন।
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            চলনবিল টেকনলজি একটি বিশ্বস্ত এবং নির্ভরযোগ্য ইন্টারনেট সেবা প্রদানকারী প্রতিষ্ঠান। 
            আমরা বছরের পর বছর ধরে আমাদের গ্রাহকদেরকে সর্বোচ্চ মানের সেবা প্রদান করে আসছি। 
            আমাদের সততা, নির্ভরযোগ্যতা এবং গ্রাহক সন্তুষ্টিই আমাদের সাফল্যের মূল কারণ।
        </p>

        <div class="stats-section">
            <h2 class="section-title" style="color: #000; margin-bottom: 40px;">আমাদের অর্জন</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">১০০০+</div>
                    <div class="stat-label">সন্তুষ্ট গ্রাহক</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">১০+</div>
                    <div class="stat-label">বছরের অভিজ্ঞতা</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">৯৯.৯%</div>
                    <div class="stat-label">আপটাইম</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">২৪/৭</div>
                    <div class="stat-label">সাপোর্ট</div>
                </div>
            </div>
        </div>

        <h2 class="section-title">কেন আমাদের বিশ্বাস করবেন?</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">history</i>
                </div>
                <h3 class="feature-title">দীর্ঘমেয়াদি সেবা</h3>
                <p class="feature-description">
                    আমরা দীর্ঘদিন ধরে এই এলাকায় সেবা প্রদান করে আসছি এবং গ্রাহকদের বিশ্বাস অর্জন করেছি।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">star</i>
                </div>
                <h3 class="feature-title">উচ্চ মানের সেবা</h3>
                <p class="feature-description">
                    আমরা সর্বদা উচ্চ মানের সেবা প্রদান করি এবং গ্রাহক সন্তুষ্টির উপর গুরুত্ব দিই।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">handshake</i>
                </div>
                <h3 class="feature-title">সৎ ব্যবসা</h3>
                <p class="feature-description">
                    আমরা সৎ এবং স্বচ্ছ ব্যবসা পরিচালনা করি, কোনো লুকানো খরচ নেই।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">groups</i>
                </div>
                <h3 class="feature-title">স্থানীয় প্রতিষ্ঠান</h3>
                <p class="feature-description">
                    আমরা একটি স্থানীয় প্রতিষ্ঠান, তাই আমরা আমাদের গ্রাহকদের সাথে সরাসরি যোগাযোগ রাখি।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">thumb_up</i>
                </div>
                <h3 class="feature-title">গ্রাহক সন্তুষ্টি</h3>
                <p class="feature-description">
                    আমাদের গ্রাহকদের সন্তুষ্টিই আমাদের প্রধান লক্ষ্য এবং আমরা সর্বদা তা অর্জন করি।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">award</i>
                </div>
                <h3 class="feature-title">স্বীকৃত সেবা</h3>
                <p class="feature-description">
                    আমাদের সেবা স্থানীয়ভাবে স্বীকৃত এবং আমরা বিভিন্ন পুরস্কার পেয়েছি।
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">আমাদের বিশ্বস্ত সেবার অংশ হন</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">হাজার হাজার সন্তুষ্ট গ্রাহকের সাথে যোগ দিন</p>
        <a href="/register/create" class="cta-button">এখনই নিবন্ধন করুন</a>
    </div>
</div>

@endsection

