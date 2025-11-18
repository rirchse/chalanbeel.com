@extends('home')
@section('title', 'দ্রুত ইনস্টলেশন')
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
        <h1 class="service-hero-title">দ্রুত ইনস্টলেশন</h1>
        <p class="service-hero-subtitle">
            অর্ডার দেওয়ার পর দ্রুততম সময়ে আপনার ইন্টারনেট সংযোগ সম্পন্ন করুন। 
            আমাদের অভিজ্ঞ টেকনিশিয়ান দল আপনার বাড়িতে এসে দ্রুত ইনস্টলেশন সম্পন্ন করবে।
        </p>
    </div>

    <div class="service-content-section">
        <p class="service-description">
            চলনবিল টেকনলজি আপনাকে প্রদান করে দ্রুততম ইনস্টলেশন সেবা। 
            অর্ডার দেওয়ার পর ২৪-৪৮ ঘন্টার মধ্যে আমাদের টেকনিশিয়ান আপনার বাড়িতে এসে 
            ইন্টারনেট সংযোগ ইনস্টল করে দেবে। আমাদের অভিজ্ঞ দল যেকোনো জটিলতা দ্রুত সমাধান করতে সক্ষম।
        </p>

        <h2 class="section-title">ইনস্টলেশন প্রক্রিয়া</h2>

        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">১</div>
                <h3 class="step-title">অর্ডার দিন</h3>
                <p class="step-description">
                    আমাদের ওয়েবসাইট থেকে বা ফোনে কল করে আপনার পছন্দের প্যাকেজ অর্ডার করুন।
                </p>
            </div>

            <div class="process-step">
                <div class="step-number">২</div>
                <h3 class="step-title">সময় নির্ধারণ</h3>
                <p class="step-description">
                    আমাদের সাপোর্ট টিম আপনার সাথে যোগাযোগ করে ইনস্টলেশনের সময় নির্ধারণ করবে।
                </p>
            </div>

            <div class="process-step">
                <div class="step-number">৩</div>
                <h3 class="step-title">ইনস্টলেশন</h3>
                <p class="step-description">
                    আমাদের টেকনিশিয়ান নির্ধারিত সময়ে আপনার বাড়িতে এসে ইনস্টলেশন সম্পন্ন করবে।
                </p>
            </div>

            <div class="process-step">
                <div class="step-number">৪</div>
                <h3 class="step-title">পরীক্ষা</h3>
                <p class="step-description">
                    ইনস্টলেশনের পর সংযোগ পরীক্ষা করা হবে এবং আপনি ইন্টারনেট ব্যবহার শুরু করতে পারবেন।
                </p>
            </div>
        </div>

        <h2 class="section-title" style="margin-top: 60px;">ইনস্টলেশন সুবিধা</h2>

        <div class="service-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">schedule</i>
                </div>
                <h3 class="feature-title">দ্রুত সেবা</h3>
                <p class="feature-description">
                    ২৪-৪৮ ঘন্টার মধ্যে ইনস্টলেশন সম্পন্ন করা হয়, কোনো বিলম্ব নেই।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">engineering</i>
                </div>
                <h3 class="feature-title">অভিজ্ঞ টেকনিশিয়ান</h3>
                <p class="feature-description">
                    আমাদের প্রশিক্ষিত এবং অভিজ্ঞ টেকনিশিয়ান দল যেকোনো সমস্যা সমাধান করতে সক্ষম।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">tools</i>
                </div>
                <h3 class="feature-title">আধুনিক সরঞ্জাম</h3>
                <p class="feature-description">
                    আধুনিক সরঞ্জাম ব্যবহার করে দ্রুত এবং দক্ষতার সাথে ইনস্টলেশন করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">check_circle</i>
                </div>
                <h3 class="feature-title">গ্যারান্টি</h3>
                <p class="feature-description">
                    আমাদের ইনস্টলেশন সেবার উপর সম্পূর্ণ গ্যারান্টি প্রদান করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">home</i>
                </div>
                <h3 class="feature-title">বিনামূল্যে পরিদর্শন</h3>
                <p class="feature-description">
                    ইনস্টলেশনের আগে বিনামূল্যে সাইট পরিদর্শন করা হয়।
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="material-icons">support_agent</i>
                </div>
                <h3 class="feature-title">২৪/৭ সহায়তা</h3>
                <p class="feature-description">
                    ইনস্টলেশনের পর যেকোনো সমস্যায় আমাদের সাপোর্ট টিম সহায়তা করবে।
                </p>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2 style="font-size: 32px; margin-bottom: 15px;">এখনই ইন্টারনেট সংযোগ নিন</h2>
        <p style="font-size: 18px; margin-bottom: 30px;">দ্রুত ইনস্টলেশনের জন্য এখনই অর্ডার করুন</p>
        <a href="/register/create" class="cta-button">এখনই নিবন্ধন করুন</a>
    </div>
</div>

@endsection

