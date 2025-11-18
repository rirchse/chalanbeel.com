@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('home')
@section('title', 'Services')
@section('content')

<style type="text/css">
    .services-page {
        min-height: calc(100vh - 200px);
        padding: 100px 0 0;
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
        background: linear-gradient(to right, transparent, #000, transparent);
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
        <h1 class="services-title">আমাদের সেবাসমূহ</h1>
        <p class="services-subtitle">
            আমরা আপনার ব্যবসা এবং সংযোগের সকল প্রয়োজন মেটাতে সম্পূর্ণ প্রযুক্তি সমাধান প্রদান করি। 
            আপনার ব্যবসাকে শক্তিশালী করার জন্য ডিজাইন করা আমাদের পেশাদার সেবার পরিসর অন্বেষণ করুন।
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
                <p class="service-number">সেবা ০১</p>
                <h2 class="service-name">ফাইবার অপটিক্স ইন্টারনেট</h2>
                <p class="service-description">
                    আমাদের উচ্চ গতির ফাইবার অপটিক ইন্টারনেট সেবার সাথে ইন্টারনেট সংযোগের ভবিষ্যত অনুভব করুন। 
                    আমরা আবাসিক এবং বাণিজ্যিক উভয় গ্রাহকের জন্য অতি দ্রুত, নির্ভরযোগ্য ইন্টারনেট সংযোগ প্রদান করি, 
                    আপনার সকল অনলাইন কার্যক্রমের জন্য ন্যূনতম বিলম্ব এবং সর্বোচ্চ কর্মক্ষমতা নিশ্চিত করে।
                </p>
                <ul class="service-features">
                    <li>অতি দ্রুত ডাউনলোড এবং আপলোড গতি</li>
                    <li>গেমিং এবং স্ট্রিমিংয়ের জন্য ন্যূনতম বিলম্ব</li>
                    <li>৯৯.৯% আপটাইম গ্যারান্টি</li>
                    <li>২৪/৭ প্রযুক্তিগত সহায়তা</li>
                    <li>স্কেলযোগ্য ব্যান্ডউইথ অপশন</li>
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
                <p class="service-number">সেবা ০২</p>
                <h2 class="service-name">ওয়্যারলেস ইন্টারনেট</h2>
                <p class="service-description">
                    গুরুদাসপুরের যেকোনো দূরবর্তী অবস্থানে রেডিও ডিভাইসের মাধ্যমে ওয়্যারলেস ইন্টারনেট। 
                    আমাদের ওয়্যারলেস ইন্টারনেট সমাধান এমন এলাকায় নির্ভরযোগ্য সংযোগ প্রদান করে যেখানে 
                    ঐতিহ্যগত কেবল অবকাঠামো সম্ভব নয়। দূরবর্তী অবস্থান, গ্রামীণ এলাকা এবং নমনীয় সংযোগ 
                    বিকল্প প্রয়োজন এমন ব্যবসার জন্য উপযুক্ত।
                </p>
                <ul class="service-features">
                    <li>গুরুদাসপুরের দূরবর্তী অবস্থানে কভারেজ</li>
                    <li>কোনো কেবল ইনস্টলেশন প্রয়োজন নেই</li>
                    <li>দ্রুত সেটআপ এবং স্থাপনা</li>
                    <li>বিভিন্ন আবহাওয়ার অবস্থায় স্থিতিশীল সংযোগ</li>
                    <li>দূরবর্তী এলাকার জন্য খরচ-কার্যকর সমাধান</li>
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
                <p class="service-number">সেবা ০৩</p>
                <h2 class="service-name">সফটওয়্যার ডেভেলপমেন্ট সেবা</h2>
                <p class="service-description">
                    আমাদের কাস্টম সফটওয়্যার ডেভেলপমেন্ট সেবার সাথে আপনার ব্যবসায়িক ধারণাগুলোকে শক্তিশালী 
                    সফটওয়্যার সমাধানে রূপান্তর করুন। ওয়েব অ্যাপ্লিকেশন থেকে এন্টারপ্রাইজ সিস্টেম পর্যন্ত, 
                    আমরা আপনার নির্দিষ্ট ব্যবসায়িক প্রয়োজন এবং উদ্দেশ্যের জন্য তৈরি উচ্চ-মানের, 
                    স্কেলযোগ্য সফটওয়্যার সরবরাহ করি।
                </p>
                <ul class="service-features">
                    <li>কাস্টম ওয়েব অ্যাপ্লিকেশন ডেভেলপমেন্ট</li>
                    <li>এন্টারপ্রাইজ সফটওয়্যার সমাধান</li>
                    <li>মোবাইল অ্যাপ ডেভেলপমেন্ট</li>
                    <li>API ইন্টিগ্রেশন এবং ডেভেলপমেন্ট</li>
                    <li>চলমান রক্ষণাবেক্ষণ এবং সহায়তা</li>
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
                <p class="service-number">সেবা ০৪</p>
                <h2 class="service-name">ইনভেন্টরি ম্যানেজমেন্ট সেবা</h2>
                <p class="service-description">
                    আমাদের সম্পূর্ণ ইনভেন্টরি ম্যানেজমেন্ট সিস্টেমের সাথে আপনার ব্যবসায়িক কার্যক্রম 
                    সুবিন্যস্ত করুন। আমাদের সমাধান আপনাকে দক্ষতার সাথে আপনার ইনভেন্টরি ট্র্যাক, পরিচালনা 
                    এবং অপ্টিমাইজ করতে সাহায্য করে, খরচ কমানো এবং উৎপাদনশীলতা বৃদ্ধি করে। খুচরা, 
                    পাইকারি এবং উৎপাদন ব্যবসার জন্য উপযুক্ত।
                </p>
                <ul class="service-features">
                    <li>রিয়েল-টাইম ইনভেন্টরি ট্র্যাকিং</li>
                    <li>স্বয়ংক্রিয় স্টক লেভেল সতর্কতা</li>
                    <li>মাল্টি-লোকেশন ইনভেন্টরি ম্যানেজমেন্ট</li>
                    <li>বিস্তারিত রিপোর্টিং এবং বিশ্লেষণ</li>
                    <li>বিদ্যমান সিস্টেমের সাথে ইন্টিগ্রেশন</li>
                </ul>
            </div>
        </div>
    </section>
</div>

@endsection
