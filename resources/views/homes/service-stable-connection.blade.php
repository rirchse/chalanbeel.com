@extends('home')
@section('title', 'স্থিতিশীল সংযোগ')
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
        <h1 class="service-hero-title">স্থিতিশীল সংযোগ</h1>
        <p class="service-hero-subtitle">
            বিরতিহীন এবং স্থিতিশীল ইন্টারনেট সংযোগের জন্য আমাদের সেবা গ্রহণ করুন। 
            আপনার কাজে বাধা না দিয়ে নিশ্ছিদ্র ইন্টারনেট সংযোগ উপভোগ করুন।
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            চলনবিল টেকনলজি আপনাকে প্রদান করে সর্বোচ্চ নির্ভরযোগ্য এবং স্থিতিশীল ইন্টারনেট সংযোগ। 
            আমাদের উন্নত নেটওয়ার্ক অবকাঠামো এবং ২৪/৭ মনিটরিং সিস্টেমের মাধ্যমে আমরা নিশ্চিত করি 
            যে আপনার ইন্টারনেট সংযোগ সর্বদা সক্রিয় এবং স্থিতিশীল থাকবে।
        </p>

        <h2 class="section-title">স্থিতিশীল সংযোগের সুবিধা</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">signal_wifi_4_bar</i>
                </div>
                <h3 class="feature-title">৯৯.৯% আপটাইম</h3>
                <p class="feature-description">
                    আমাদের নেটওয়ার্ক ৯৯.৯% আপটাইম গ্যারান্টি প্রদান করে, 
                    যার অর্থ আপনার সংযোগ সর্বদা সক্রিয় থাকবে।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">network_check</i>
                </div>
                <h3 class="feature-title">নিরবচ্ছিন্ন সংযোগ</h3>
                <p class="feature-description">
                    বৃষ্টি, ঝড় বা যেকোনো আবহাওয়ায়ও আপনার ইন্টারনেট সংযোগ স্থিতিশীল থাকবে।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">monitoring</i>
                </div>
                <h3 class="feature-title">২৪/৭ মনিটরিং</h3>
                <p class="feature-description">
                    আমাদের নেটওয়ার্ক ২৪/৭ মনিটরিং করা হয় যাতে কোনো সমস্যা হলে তাৎক্ষণিক সমাধান করা যায়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">backup</i>
                </div>
                <h3 class="feature-title">ব্যাকআপ সিস্টেম</h3>
                <p class="feature-description">
                    আমাদের নেটওয়ার্কে ব্যাকআপ সিস্টেম রয়েছে যা মূল সংযোগে সমস্যা হলে স্বয়ংক্রিয়ভাবে সক্রিয় হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">speed</i>
                </div>
                <h3 class="feature-title">স্থির গতি</h3>
                <p class="feature-description">
                    আপনার প্যাকেজ অনুযায়ী সর্বদা স্থির গতি পাবেন, কোনো সময় গতি কমবে না।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">settings_backup_restore</i>
                </div>
                <h3 class="feature-title">দ্রুত পুনরুদ্ধার</h3>
                <p class="feature-description">
                    কোনো সমস্যা হলে আমাদের দল তাৎক্ষণিকভাবে সমাধান করে আপনার সংযোগ পুনরুদ্ধার করে।
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">স্থিতিশীল সংযোগের জন্য এখনই যোগ দিন</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">আমাদের প্যাকেজ দেখুন এবং সাবস্ক্রাইব করুন</p>
        <a href="/package" class="cta-button">প্যাকেজ দেখুন</a>
    </div>
</div>

@endsection

