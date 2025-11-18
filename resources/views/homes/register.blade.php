@extends('home')
@section('title', 'নিবন্ধন')
@section('content')

<style type="text/css">
    .register-page {
        min-height: calc(100vh - 70px);
        display: flex;
        overflow: hidden;
        margin-top: 70px;
    }

    .register-left {
        flex: 1;
        background: linear-gradient(135deg, #000 0%, #1a1a1a 50%, #244f58 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 60px 50px;
        position: relative;
        overflow: hidden;
    }

    .register-left::before {
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

    .register-left-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: #fff;
        max-width: 500px;
    }

    .register-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 60px;
    }

    .register-logo-icon {
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #000;
        font-weight: 700;
    }

    .register-logo-text {
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        letter-spacing: 2px;
    }

    .register-welcome-title {
        font-size: 48px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 20px 0;
        line-height: 1.2;
    }

    .register-welcome-subtitle {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.8;
        margin: 0 0 50px 0;
    }

    .sign-in-btn {
        padding: 16px 40px;
        background: transparent;
        border: 2px solid #fff;
        border-radius: 50px;
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .sign-in-btn:hover {
        background: #fff;
        color: #000;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    .register-right {
        flex: 1;
        background: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 60px 50px;
        position: relative;
        overflow: hidden;
    }

    .register-right::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.05) 0%, transparent 100%);
        border-radius: 50%;
    }

    .register-right::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.03) 0%, transparent 100%);
        border-radius: 50%;
    }

    .register-form-container {
        position: relative;
        z-index: 1;
        max-width: 500px;
        margin: 0 auto;
        width: 100%;
    }

    .register-form-title {
        font-size: 42px;
        font-weight: 800;
        color: #000;
        margin: 0 0 40px 0;
        text-align: center;
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .social-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #e0e0e0;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #666;
        font-size: 22px;
        text-decoration: none;
    }

    .social-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .social-btn:hover.fb-btn {
        border-color: #1877f2;
        color: #1877f2;
        background: rgba(24, 119, 242, 0.1);
    }

    .social-btn:hover.google-btn {
        border-color: #ea4335;
        color: #ea4335;
        background: rgba(234, 67, 53, 0.1);
    }

    .social-btn:hover.linkedin-btn {
        border-color: #0077b5;
        color: #0077b5;
        background: rgba(0, 119, 181, 0.1);
    }

    .divider {
        text-align: center;
        margin: 30px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e0e0e0;
    }

    .divider-text {
        background: #fff;
        padding: 0 20px;
        color: #999;
        font-size: 14px;
        position: relative;
        display: inline-block;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        color: #666;
        font-size: 20px;
        z-index: 1;
    }

    .form-control {
        width: 100%;
        padding: 16px 16px 16px 55px;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        font-size: 16px;
        background: #f8f8f8;
        color: #000;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #000;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
    }

    .form-control::placeholder {
        color: #999;
    }

    select.form-control {
        padding-left: 55px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23000' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 18px center;
        padding-right: 45px;
        cursor: pointer;
    }

    textarea.form-control {
        border-radius: 20px;
        padding: 16px 20px;
        padding-left: 55px;
        min-height: 120px;
        resize: vertical;
    }

    .package-info-mini {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        padding: 20px;
        border-radius: 20px;
        margin-bottom: 30px;
        text-align: center;
    }

    .package-info-mini h4 {
        margin: 0 0 10px 0;
        font-size: 16px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
    }

    .package-info-mini .package-details {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .package-info-mini .package-detail {
        font-size: 14px;
    }

    .package-info-mini .package-detail strong {
        display: block;
        font-size: 18px;
        margin-bottom: 5px;
    }

    .submit-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        margin-top: 10px;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, #1a1a1a 0%, #000 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .alert-mini {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-size: 13px;
        color: #856404;
        line-height: 1.6;
    }

    @media (max-width: 968px) {
        .register-page {
            flex-direction: column;
            margin-top: 60px;
        }

        .register-left {
            padding: 40px 30px;
            min-height: 300px;
        }

        .register-welcome-title {
            font-size: 36px;
        }

        .register-right {
            padding: 40px 30px;
        }

        .register-form-title {
            font-size: 32px;
        }
    }

    @media (max-width: 768px) {
        .register-left {
            padding: 30px 20px;
            min-height: 250px;
        }

        .register-welcome-title {
            font-size: 28px;
        }

        .register-welcome-subtitle {
            font-size: 16px;
        }

        .register-right {
            padding: 30px 20px;
        }

        .register-form-title {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .register-logo-text {
            font-size: 24px;
        }
    }
</style>

<div class="register-page">
    <!-- Left Side: Welcome Section -->
    <div class="register-left">
        <div class="register-left-content">
            <div class="register-logo">
                <div class="register-logo-icon">CT</div>
                <div class="register-logo-text">চলনবিল টেকনলজি</div>
            </div>
            <h1 class="register-welcome-title">স্বাগতম!</h1>
            <p class="register-welcome-subtitle">
                আমাদের সাথে যুক্ত হয়ে বিশ্বস্ত ও নির্ভরযোগ্য ইন্টারনেট সেবা উপভোগ করুন। 
                উচ্চ গতির ইন্টারনেট সাশ্রয়ী মূল্যে।
            </p>
            <a href="/login" class="sign-in-btn">লগইন করুন</a>
        </div>
    </div>

    <!-- Right Side: Registration Form -->
    <div class="register-right">
        <div class="register-form-container">
            <h2 class="register-form-title">নতুন একাউন্ট তৈরি করুন</h2>

            @if(isset($package) && $package)
            <div class="package-info-mini">
                <h4>
                    <i class="material-icons" style="vertical-align: middle; font-size: 18px;">check_circle</i>
                    নির্বাচিত প্যাকেজ
                </h4>
                <div class="package-details">
                    <div class="package-detail">
                        <strong>{{ $package->speed ?? 'N/A' }}</strong>
                        <span>গতি</span>
                    </div>
                    <div class="package-detail">
                        <strong>{{ $package->time_limit ?? 'N/A' }}</strong>
                        <span>সময়</span>
                    </div>
                    <div class="package-detail">
                        <strong>৳{{ number_format($package->price ?? 0) }}</strong>
                        <span>মূল্য</span>
                    </div>
                </div>
            </div>
            @endif

            <div class="social-login">
                <a href="#" class="social-btn fb-btn" title="Facebook">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="#" class="social-btn google-btn" title="Google">
                    <i class="fa fa-google"></i>
                </a>
                <a href="#" class="social-btn linkedin-btn" title="LinkedIn">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>

            <div class="divider">
                <span class="divider-text">অথবা আপনার ইমেইল দিয়ে নিবন্ধন করুন</span>
            </div>

            <div class="alert-mini">
                <i class="material-icons" style="vertical-align: middle; font-size: 16px;">info</i>
                অনুগ্রহ করে সঠিক তথ্য দিয়ে নিবন্ধন করুন এবং আপনার মোবাইল নম্বর দুবার পরীক্ষা করুন।
            </div>

            {!! Form::open(['route' => 'register.store', 'method' => 'POST', 'files' => true, 'id' => 'RegisterValidation']) !!}
                
                @if(isset($package) && $package)
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                @elseif(Session::has('selected_package_id'))
                <input type="hidden" name="package_id" value="{{ Session::get('selected_package_id') }}">
                @endif

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">person</i>
                        {{ Form::text('full_name', null, ['class' => 'form-control', 'id' => 'full_name', 'required', 'placeholder' => 'আপনার পূর্ণ নাম']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">phone</i>
                        {{ Form::text('contact', null, ['class' => 'form-control', 'id' => 'contact', 'required', 'maxlength' => '11', 'pattern' => '[0-9]{11}', 'placeholder' => 'মোবাইল নম্বর']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">phone_android</i>
                        {{ Form::text('contact_confirmation', null, ['class' => 'form-control', 'id' => 'contact_confirmation', 'required', 'maxlength' => '11', 'pattern' => '[0-9]{11}', 'placeholder' => 'মোবাইল নম্বর নিশ্চিত করুন']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">email</i>
                        {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'ইমেইল ঠিকানা (ঐচ্ছিক)']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">place</i>
                        {{ Form::select('area', ['' => 'এলাকা নির্বাচন করুন'] + $locations->pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'area']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">home</i>
                        {{ Form::textarea('details', null, ['class' => 'form-control', 'id' => 'address', 'rows' => 3, 'placeholder' => 'সম্পূর্ণ ঠিকানা']) }}
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    নিবন্ধন করুন
                </button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
