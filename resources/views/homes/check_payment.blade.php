@extends('home')
@section('title', __('messages.titles.check_payment'))
@section('content')
<div class="check-payment-page">
    <div class="check-payment-container">
        <div class="check-payment-header">
            <h1 class="check-payment-title">পেমেন্ট চেক করুন</h1>
            <p class="check-payment-subtitle">আপনার পেমেন্ট তথ্য দিয়ে চেক করুন</p>
        </div>

        <div class="check-payment-card">
            @if(Session::has('error'))
                <div class="alert alert-error">
                    <i class="material-icons">error</i>
                    {{ Session::get('error') }}
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    <i class="material-icons">check_circle</i>
                    {{ Session::get('success') }}
                </div>
            @endif

            {!! Form::open(['route' => 'check.payment', 'method' => 'POST', 'class' => 'check-payment-form']) !!}
                <div class="form-group">
                    <label for="payment_method" class="form-label">
                        <i class="material-icons">payment</i>
                        পেমেন্ট মাধ্যম
                    </label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="">পেমেন্ট মাধ্যম নির্বাচন করুন</option>
                        @foreach($payments as $paymethod)
                            <option value="{{ $paymethod->id }}">{{ $paymethod->payment_system }} - {{ $paymethod->bank_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="paid_mobile_no" class="form-label">
                        <i class="material-icons">phone</i>
                        মোবাইল নম্বর
                    </label>
                    <input type="text" name="paid_mobile_no" id="paid_mobile_no" class="form-control" placeholder="পেমেন্ট করা মোবাইল নম্বর" required maxlength="11">
                </div>

                <div class="form-group">
                    <label for="transaction_id" class="form-label">
                        <i class="material-icons">receipt</i>
                        লেনদেন আইডি (TrxID)
                    </label>
                    <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="লেনদেন আইডি লিখুন" required maxlength="32">
                </div>

                <button type="submit" class="submit-btn">
                    <i class="material-icons">search</i>
                    চেক করুন
                </button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<style>
    .check-payment-page {
        min-height: calc(100vh - 200px);
        padding: 100px 20px 80px;
        background: #f8f9fa;
    }

    .check-payment-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .check-payment-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .check-payment-title {
        font-size: 36px;
        font-weight: 700;
        color: #000;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }

    .check-payment-subtitle {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .check-payment-card {
        background: #fff;
        border: 2px solid #000;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .check-payment-form {
        width: 100%;
    }

    .form-group {
        margin-bottom: 30px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 16px;
        font-weight: 600;
        color: #000;
        margin-bottom: 10px;
    }

    .form-label i {
        font-size: 20px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        color: #333;
        background: #fff;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #000;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .submit-btn {
        width: 100%;
        padding: 16px;
        background: #000;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .submit-btn:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .submit-btn i {
        font-size: 20px;
    }

    .alert {
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 15px;
    }

    .alert-error {
        background: #ffebee;
        border: 2px solid #f44336;
        color: #c62828;
    }

    .alert-success {
        background: #e8f5e9;
        border: 2px solid #4caf50;
        color: #2e7d32;
    }

    .alert i {
        font-size: 24px;
    }

    @media (max-width: 768px) {
        .check-payment-page {
            padding: 80px 15px 60px;
        }

        .check-payment-title {
            font-size: 28px;
        }

        .check-payment-card {
            padding: 30px 20px;
        }
    }
</style>
@endsection
