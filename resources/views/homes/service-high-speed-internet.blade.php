@extends('home')
@section('title', 'উচ্চ গতির ইন্টারনেট')
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
            <i class="material-icons">flash_on</i>
        </div>
        <h1 class="service-hero-title">উচ্চ গতির ইন্টারনেট</h1>
        <p class="service-hero-subtitle">
            দ্রুততম ইন্টারনেট সংযোগের জন্য আমাদের উচ্চ গতির ইন্টারনেট সেবা গ্রহণ করুন। 
            আপনার ব্যবসা এবং ব্যক্তিগত প্রয়োজনের জন্য সর্বোচ্চ গতির ইন্টারনেট সেবা।
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            চলনবিল টেকনলজি আপনাকে প্রদান করে সর্বোচ্চ মানের উচ্চ গতির ইন্টারনেট সেবা। 
            আমাদের আধুনিক নেটওয়ার্ক ইনফ্রাস্ট্রাকচার এবং ফাইবার অপটিক্স প্রযুক্তি ব্যবহার করে 
            আমরা নিশ্চিত করি যে আপনি সর্বোচ্চ গতির ইন্টারনেট সংযোগ পাবেন।
        </p>

        <h2 class="section-title">আমাদের উচ্চ গতির ইন্টারনেটের বৈশিষ্ট্য</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">speed</i>
                </div>
                <h3 class="feature-title">অত্যাধিক গতি</h3>
                <p class="feature-description">
                    ১০ Mbps থেকে ১০০ Mbps পর্যন্ত বিভিন্ন গতির প্যাকেজ উপলব্ধ। 
                    আপনার প্রয়োজন অনুযায়ী সেরা গতি নির্বাচন করুন।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">fiber_optics</i>
                </div>
                <h3 class="feature-title">ফাইবার অপটিক্স</h3>
                <p class="feature-description">
                    আধুনিক ফাইবার অপটিক্স প্রযুক্তি ব্যবহার করে স্থিতিশীল এবং দ্রুত সংযোগ প্রদান করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">cloud_download</i>
                </div>
                <h3 class="feature-title">দ্রুত ডাউনলোড</h3>
                <p class="feature-description">
                    বড় ফাইল, ভিডিও, গেমস এবং সফটওয়্যার দ্রুততম সময়ে ডাউনলোড করুন।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">videocam</i>
                </div>
                <h3 class="feature-title">HD/4K স্ট্রিমিং</h3>
                <p class="feature-description">
                    বাধাহীন HD এবং 4K ভিডিও স্ট্রিমিংয়ের জন্য পর্যাপ্ত ব্যান্ডউইথ।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">games</i>
                </div>
                <h3 class="feature-title">কম লেটেন্সি</h3>
                <p class="feature-description">
                    অনলাইন গেমিং এবং ভিডিও কনফারেন্সিংয়ের জন্য কম লেটেন্সি প্রদান করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">devices</i>
                </div>
                <h3 class="feature-title">মাল্টি ডিভাইস</h3>
                <p class="feature-description">
                    একই সংযোগে একাধিক ডিভাইস ব্যবহার করুন বিনা গতি হারিয়ে।
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">আমাদের প্যাকেজ দেখুন</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">উচ্চ গতির ইন্টারনেট প্যাকেজ দেখতে এবং এখনই সাবস্ক্রাইব করতে</p>
        <a href="/package" class="cta-button">প্যাকেজ দেখুন</a>
    </div>
</div>

@endsection

