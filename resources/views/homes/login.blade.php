@extends('home')
@section('title', 'লগইন')
@section('content')

<style type="text/css">
    .login-page {
        min-height: calc(100vh - 70px);
        display: flex;
        overflow: hidden;
        margin-top: 70px;
    }

    .login-left {
        flex: 1;
        background: linear-gradient(135deg, #000 0%, #07354c 50%, #000 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 60px 50px;
        position: relative;
        overflow: hidden;
    }

    .login-left::before {
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

    .login-left-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: #fff;
        max-width: 500px;
    }

    .login-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 60px;
    }

    .login-logo-icon {
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

    .login-logo-text {
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        letter-spacing: 2px;
    }

    .login-welcome-title {
        font-size: 48px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 20px 0;
        line-height: 1.2;
    }

    .login-welcome-subtitle {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.8;
        margin: 0 0 50px 0;
    }

    .sign-up-btn {
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

    .sign-up-btn:hover {
        background: #fff;
        color: #000;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    .login-right {
        flex: 1;
        background: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 60px 50px;
        position: relative;
        overflow: hidden;
    }

    .login-right::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.05) 0%, transparent 100%);
        border-radius: 50%;
    }

    .login-right::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.03) 0%, transparent 100%);
        border-radius: 50%;
    }

    .login-form-container {
        position: relative;
        z-index: 1;
        max-width: 500px;
        margin: 0 auto;
        width: 100%;
    }

    .login-form-title {
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

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #000;
    }

    .forgot-password {
        color: #000;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #333;
        text-decoration: underline;
    }

    .error-message {
        background: #fee;
        border-left: 4px solid #f00;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        color: #c00;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .error-message i {
        font-size: 18px;
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

    @media (max-width: 968px) {
        .login-page {
            flex-direction: column;
            margin-top: 60px;
        }

        .login-left {
            padding: 40px 30px;
            min-height: 300px;
        }

        .login-welcome-title {
            font-size: 36px;
        }

        .login-right {
            padding: 40px 30px;
        }

        .login-form-title {
            font-size: 32px;
        }
    }

    @media (max-width: 768px) {
        .login-left {
            padding: 30px 20px;
            min-height: 250px;
        }

        .login-welcome-title {
            font-size: 28px;
        }

        .login-welcome-subtitle {
            font-size: 16px;
        }

        .login-right {
            padding: 30px 20px;
        }

        .login-form-title {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .login-logo-text {
            font-size: 24px;
        }

        .remember-forgot {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<div class="login-page">
    <!-- Left Side: Welcome Section -->
    <div class="login-left">
        <div class="login-left-content">
            <div class="login-logo">
                <div class="login-logo-icon">CT</div>
                <div class="login-logo-text">চলনবিল টেকনলজিতে</div>
            </div>
            <h1 class="login-welcome-title">স্বাগতম!</h1>
            <p class="login-welcome-subtitle">
                আপনার একাউন্টে প্রবেশ করুন এবং আমাদের সেবা উপভোগ করুন। 
                নতুন ব্যবহারকারী? এখনই নিবন্ধন করুন।
            </p>
            <a href="/register/create" class="sign-up-btn">নিবন্ধন করুন</a>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="login-right">
        <div class="login-form-container">
            <h2 class="login-form-title">আপনার একাউন্টে প্রবেশ করুন</h2>

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
                <span class="divider-text">অথবা আপনার একাউন্ট দিয়ে প্রবেশ করুন</span>
            </div>

            @if(session('error'))
            <div class="error-message">
                <i class="material-icons">error</i>
                {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="error-message">
                <i class="material-icons">error</i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            @endif

            <form role="form" method="POST" action="{{ route('user.login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">phone</i>
                        <input type="text" 
                               class="form-control {{ $errors->has('email') ? 'error' : '' }}" 
                               name="email" 
                               id="email"
                               placeholder="মোবাইল নম্বর" 
                               value="{{ old('email') }}"
                               required 
                               autofocus
                               maxlength="11"
                               pattern="[0-9]{11}"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">lock</i>
                        <input type="password" 
                               class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
                               name="password" 
                               id="password"
                               placeholder="পাসওয়ার্ড" 
                               required/>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>আমাকে মনে রাখুন</span>
                    </label>
                    <a href="#" class="forgot-password">পাসওয়ার্ড ভুলে গেছেন?</a>
                </div>

                <button type="submit" class="submit-btn">
                    প্রবেশ করুন
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
