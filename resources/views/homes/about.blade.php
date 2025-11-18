@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('home')
@section('title', 'সম্পর্কে')
@section('content')

<style type="text/css">
    .about-page {
        min-height: calc(100vh - 200px);
        padding: 77px 0 0;
        background: #fff;
    }

    .about-hero {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        padding: 100px 20px 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
        animation: pulse 20s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .about-hero-content {
        position: relative;
        z-index: 1;
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
        max-width: 900px;
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

    .mission-card::before, .vision-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #000;
    }

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
            <h1 class="about-hero-title">আমাদের সম্পর্কে</h1>
            <p class="about-hero-subtitle">
                চলনবিল টেকনলজি - বিশ্বস্ত ও নির্ভরযোগ্য ইন্টারনেট সেবা প্রদানকারী। 
                আমরা প্রতিশ্রুতিবদ্ধ আপনার ডিজিটাল জীবনকে আরও সহজ ও দ্রুত করার জন্য।
            </p>
        </div>
    </div>

    <div class="about-container">
        <!-- About Us Section -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">আমাদের কাহিনী</h2>
                <p class="section-subtitle">আমাদের যাত্রা এবং উদ্দেশ্য</p>
            </div>
            <div class="about-content">
                <p>
                    চলনবিল টেকনলজি একটি প্রগতিশীল ইন্টারনেট সেবা প্রদানকারী প্রতিষ্ঠান যা 
                    গুরুদাসপুর এবং আশেপাশের এলাকায় বিশ্বস্ত ও উচ্চ গতির ইন্টারনেট সেবা প্রদান করে আসছে। 
                    আমাদের লক্ষ্য হলো প্রতিটি গ্রাহকের কাছে সহজলভ্য, সাশ্রয়ী এবং নির্ভরযোগ্য ইন্টারনেট 
                    সংযোগ পৌঁছে দেওয়া।
                </p>
                <p style="margin-top: 25px;">
                    আমরা শুধুমাত্র ইন্টারনেট সেবা প্রদান করি না, বরং আপনার ডিজিটাল প্রয়োজনের 
                    সম্পূর্ণ সমাধান প্রদান করি। আমাদের দক্ষ টিম সর্বদা প্রস্তুত আপনার যেকোনো 
                    সমস্যা সমাধানে সাহায্য করতে।
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">আমাদের লক্ষ্য ও উদ্দেশ্য</h2>
                <p class="section-subtitle">যা আমাদের চালিত করে</p>
            </div>
            <div class="mission-vision">
                <div class="mission-card">
                    <h3 class="mission-title">
                        <i class="material-icons">flag</i>
                        আমাদের মিশন
                    </h3>
                    <p class="mission-text">
                        প্রতিটি বাড়ি এবং ব্যবসায় উচ্চ গতির ইন্টারনেট সেবা পৌঁছে দেওয়া আমাদের মিশন। 
                        আমরা বিশ্বাস করি যে ইন্টারনেট হলো আধুনিক জীবনের একটি মৌলিক অধিকার, এবং 
                        আমাদের দায়িত্ব হলো এটি সবার কাছে সহজলভ্য করা।
                    </p>
                </div>
                <div class="vision-card">
                    <h3 class="vision-title">
                        <i class="material-icons">visibility</i>
                        আমাদের ভিশন
                    </h3>
                    <p class="vision-text">
                        বাংলাদেশের সবচেয়ে বিশ্বস্ত এবং নির্ভরযোগ্য ইন্টারনেট সেবা প্রদানকারী 
                        প্রতিষ্ঠান হওয়া আমাদের লক্ষ্য। আমরা চাই প্রতিটি গ্রাহক আমাদের সেবায় 
                        সন্তুষ্ট থাকুক এবং ডিজিটাল বিশ্বে সফল হোক।
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">কেন আমাদের বেছে নিবেন</h2>
                <p class="section-subtitle">আমাদের বিশেষত্ব</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">speed</i>
                    </div>
                    <h3 class="feature-title">উচ্চ গতি</h3>
                    <p class="feature-description">
                        আমরা সর্বোচ্চ গতির ইন্টারনেট সেবা প্রদান করি যা আপনার সকল অনলাইন 
                        কার্যক্রমের জন্য যথেষ্ট।
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">security</i>
                    </div>
                    <h3 class="feature-title">নিরাপত্তা</h3>
                    <p class="feature-description">
                        আপনার ডেটা এবং গোপনীয়তা সুরক্ষিত রাখা আমাদের অগ্রাধিকার। 
                        আমরা সর্বোচ্চ নিরাপত্তা মান বজায় রাখি।
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">support_agent</i>
                    </div>
                    <h3 class="feature-title">২৪/৭ সহায়তা</h3>
                    <p class="feature-description">
                        আমাদের দক্ষ সাপোর্ট টিম দিন-রাত আপনার পাশে রয়েছে যেকোনো 
                        সমস্যা সমাধানের জন্য।
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">payments</i>
                    </div>
                    <h3 class="feature-title">সাশ্রয়ী মূল্য</h3>
                    <p class="feature-description">
                        আমরা প্রতিযোগিতামূলক মূল্যে সর্বোচ্চ মানের সেবা প্রদান করি 
                        যা সবার জন্য সহজলভ্য।
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">build</i>
                    </div>
                    <h3 class="feature-title">দ্রুত ইনস্টলেশন</h3>
                    <p class="feature-description">
                        আমরা দ্রুততম সময়ে আপনার ইন্টারনেট সংযোগ ইনস্টল করি যাতে 
                        আপনি দেরি না করে সেবা পেতে পারেন।
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="material-icons">verified_user</i>
                    </div>
                    <h3 class="feature-title">বিশ্বস্ত সেবা</h3>
                    <p class="feature-description">
                        বছরের পর বছর ধরে আমরা বিশ্বস্ত সেবা প্রদান করে আসছি এবং 
                        আমাদের গ্রাহকদের আস্থা অর্জন করেছি।
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">১০০০+</div>
                    <div class="stat-label">সন্তুষ্ট গ্রাহক</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">৯৯.৯%</div>
                    <div class="stat-label">আপটাইম</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">২৪/৭</div>
                    <div class="stat-label">সাপোর্ট</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">১০+</div>
                    <div class="stat-label">বছরের অভিজ্ঞতা</div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="about-section">
            <div class="section-header">
                <h2 class="section-title">আমাদের সাথে যোগাযোগ করুন</h2>
                <p class="section-subtitle">আমরা আপনার প্রশ্নের উত্তর দিতে প্রস্তুত</p>
            </div>
            <div class="about-content">
                <p>
                    আপনার কোনো প্রশ্ন বা সমস্যা থাকলে আমাদের সাথে যোগাযোগ করতে পারেন। 
                    আমাদের সাপোর্ট টিম সর্বদা আপনার সাহায্যের জন্য প্রস্তুত।
                </p>
                <p style="margin-top: 25px; font-weight: 600; color: #000;">
                    <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">phone</i>
                    ফোন: 017 78 57 33 96, 017 03 58 79 11
                </p>
                <p style="margin-top: 15px; font-weight: 600; color: #000;">
                    <i class="material-icons" style="vertical-align: middle; margin-right: 8px;">schedule</i>
                    সময়: সকাল ৯টা - রাত ১০টা (সপ্তাহে ৭ দিন)
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

