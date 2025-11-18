@extends('home')
@section('title', '২৪/৭ সাপোর্ট')
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
        <h1 class="service-hero-title">২৪/৭ সাপোর্ট</h1>
        <p class="service-hero-subtitle">
            যেকোনো সময়, যেকোনো সমস্যায় আমরা আপনার পাশে আছি। 
            আমাদের অভিজ্ঞ সাপোর্ট টিম ২৪/৭ আপনার সেবায় প্রস্তুত।
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            চলনবিল টেকনলজি আপনাকে প্রদান করে বিশ্বস্ত ২৪/৭ কাস্টমার সাপোর্ট সেবা। 
            আমাদের অভিজ্ঞ এবং বন্ধুত্বপূর্ণ সাপোর্ট টিম যেকোনো সময় আপনার সাহায্যে প্রস্তুত। 
            ফোন, ইমেইল বা সরাসরি পরিদর্শনের মাধ্যমে আমরা আপনার সব সমস্যার সমাধান করি।
        </p>
    </div>

    <div class="support-services-section">
        <div class="support-services-container">
            <h2 class="section-title">আমাদের সাপোর্ট সেবা</h2>

            <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">phone</i>
                </div>
                <h3 class="feature-title">ফোন সাপোর্ট</h3>
                <p class="feature-description">
                    যেকোনো সময় ফোন করে আমাদের সাথে যোগাযোগ করুন। 
                    আমাদের সাপোর্ট টিম আপনার সমস্যা শুনবে এবং তাৎক্ষণিক সমাধান করবে।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">email</i>
                </div>
                <h3 class="feature-title">ইমেইল সাপোর্ট</h3>
                <p class="feature-description">
                    ইমেইলের মাধ্যমে আপনার সমস্যা জানান, আমরা ২৪ ঘন্টার মধ্যে উত্তর দেব।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">home</i>
                </div>
                <h3 class="feature-title">বাড়িতে পরিদর্শন</h3>
                <p class="feature-description">
                    প্রয়োজনে আমাদের টেকনিশিয়ান আপনার বাড়িতে এসে সমস্যা সমাধান করবে।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">schedule</i>
                </div>
                <h3 class="feature-title">দ্রুত প্রতিক্রিয়া</h3>
                <p class="feature-description">
                    আমরা যেকোনো সমস্যায় দ্রুত প্রতিক্রিয়া প্রদান করি এবং তাৎক্ষণিক সমাধান করি।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">translate</i>
                </div>
                <h3 class="feature-title">বাংলা ও ইংরেজি</h3>
                <p class="feature-description">
                    বাংলা এবং ইংরেজি উভয় ভাষায় সাপোর্ট প্রদান করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">verified_user</i>
                </div>
                <h3 class="feature-title">অভিজ্ঞ টিম</h3>
                <p class="feature-description">
                    আমাদের অভিজ্ঞ এবং প্রশিক্ষিত সাপোর্ট টিম যেকোনো সমস্যার সমাধান করতে সক্ষম।
                </p>
            </div>
        </div>
    </div>

    <div class="service-content-section">
        <div class="contact-info">
            <h3 style="font-size: 28px; margin-bottom: 30px; color: #000;">যোগাযোগ করুন</h3>
            <div class="contact-item">
                <strong>ফোন:</strong>
                <span>017 78 57 33 96</span><br>
                <span>017 03 58 79 11</span>
            </div>
            <div class="contact-item">
                <strong>ইমেইল:</strong>
                <span>info@chalanbeel.com</span><br>
                <span>support@chalanbeel.com</span>
            </div>
            <div class="contact-item">
                <strong>সময়:</strong>
                <span>সকাল ৯টা - রাত ১০টা, সপ্তাহে ৭ দিন</span>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">আমাদের সাথে যোগাযোগ করুন</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">যেকোনো প্রশ্ন বা সমস্যায় আমাদের সাথে যোগাযোগ করুন</p>
        <a href="/register/create" class="cta-button">এখনই নিবন্ধন করুন</a>
    </div>
</div>

@endsection

