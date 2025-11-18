@extends('home')
@section('title', 'নিরাপদ নেটওয়ার্ক')
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
            <i class="material-icons">security</i>
        </div>
        <h1 class="service-hero-title">নিরাপদ নেটওয়ার্ক</h1>
        <p class="service-hero-subtitle">
            আপনার ডেটা এবং অনলাইন কার্যক্রমের নিরাপত্তার জন্য আমাদের সুরক্ষিত নেটওয়ার্ক সেবা গ্রহণ করুন। 
            সর্বোচ্চ মানের নিরাপত্তা ব্যবস্থা দিয়ে আপনার তথ্য সুরক্ষিত রাখুন।
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            চলনবিল টেকনলজি আপনাকে প্রদান করে সর্বোচ্চ নিরাপত্তা সমৃদ্ধ নেটওয়ার্ক সেবা। 
            আমাদের আধুনিক ফায়ারওয়াল, এনক্রিপশন প্রযুক্তি এবং নিরাপত্তা প্রোটোকল ব্যবহার করে 
            আমরা নিশ্চিত করি যে আপনার ডেটা এবং অনলাইন কার্যক্রম সম্পূর্ণভাবে সুরক্ষিত।
        </p>

        <h2 class="section-title">নিরাপত্তা বৈশিষ্ট্য</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">vpn_lock</i>
                </div>
                <h3 class="feature-title">এনক্রিপশন</h3>
                <p class="feature-description">
                    সর্বোচ্চ মানের এনক্রিপশন প্রযুক্তি ব্যবহার করে আপনার ডেটা সুরক্ষিত রাখা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">firewall</i>
                </div>
                <h3 class="feature-title">ফায়ারওয়াল</h3>
                <p class="feature-description">
                    আধুনিক ফায়ারওয়াল সিস্টেম দিয়ে আপনার নেটওয়ার্ককে ক্ষতিকর হুমকি থেকে রক্ষা করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">shield</i>
                </div>
                <h3 class="feature-title">ডিডিওএস সুরক্ষা</h3>
                <p class="feature-description">
                    ডিস্টributed Denial of Service (DDoS) আক্রমণ থেকে নেটওয়ার্ক সুরক্ষিত রাখা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">privacy_tip</i>
                </div>
                <h3 class="feature-title">প্রাইভেসি সুরক্ষা</h3>
                <p class="feature-description">
                    আপনার ব্যক্তিগত তথ্য এবং অনলাইন কার্যক্রম সম্পূর্ণ গোপনীয় রাখা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">security_update</i>
                </div>
                <h3 class="feature-title">নিয়মিত আপডেট</h3>
                <p class="feature-description">
                    নিরাপত্তা সিস্টেম নিয়মিত আপডেট করা হয় যাতে সর্বশেষ হুমকি থেকে সুরক্ষিত থাকা যায়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">verified</i>
                </div>
                <h3 class="feature-title">যাচাইকৃত নিরাপত্তা</h3>
                <p class="feature-description">
                    আমাদের নিরাপত্তা ব্যবস্থা আন্তর্জাতিক মানদণ্ড অনুযায়ী যাচাইকৃত এবং পরীক্ষিত।
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">নিরাপদ নেটওয়ার্কের জন্য এখনই যোগ দিন</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">আমাদের সুরক্ষিত ইন্টারনেট সেবা গ্রহণ করুন</p>
        <a href="/package" class="cta-button">প্যাকেজ দেখুন</a>
    </div>
</div>

@endsection

