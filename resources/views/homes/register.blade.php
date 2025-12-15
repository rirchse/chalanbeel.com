@extends('home')
@section('title', __('messages.register.title'))
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

    .form-control:focus,
    .form-control:active {
        outline: none;
        border-color: #000;
        background: transparent !important;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
    }

    .form-control::placeholder {
        color: #999;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-size: 14px;
        font-weight: 600;
        padding-left: 18px;
    }

    select.form-control {
        padding-left: 55px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23000' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 18px center;
        background-color: #f8f8f8 !important;
        padding-right: 45px;
        cursor: pointer;
        color: #000 !important;
    }

    select.form-control:focus,
    select.form-control:active {
        color: #000 !important;
        background-color: transparent !important;
    }

    select.form-control option {
        color: #000 !important;
        background: #fff !important;
        padding: 10px;
    }

    select.form-control option:checked,
    select.form-control option:focus {
        color: #000 !important;
        background: #f8f8f8 !important;
    }

    select.form-control option:hover {
        background: #e0e0e0 !important;
        color: #000 !important;
    }

    /* Fix for default option (placeholder) */
    select.form-control option[value=""] {
        color: #999 !important;
    }

    /* Custom Searchable Select Dropdown */
    .custom-select-wrapper {
        position: relative;
        width: 100%;
    }

    .custom-select {
        position: relative;
        width: 100%;
    }

    .custom-select-trigger {
        width: 100%;
        padding: 16px 16px 16px 55px;
        border-bottom: 1px solid #bdb9b9;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
        min-height: 52px;
    }

    .custom-select-trigger:focus,
    .custom-select-trigger:active {
        outline: none;
        border-color: #000;
        background: transparent !important;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
    }

    .custom-select-value {
        flex: 1;
        color: #000;
        text-align: left;
    }

    .custom-select-value.placeholder {
        color: #999;
    }

    .custom-select-arrow {
        font-size: 24px;
        color: #666;
        transition: transform 0.3s ease;
        margin-left: 10px;
    }

    .custom-select.open .custom-select-arrow {
        transform: rotate(180deg);
    }

    .custom-select-options {
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        right: 0;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        max-height: 300px;
        overflow: hidden;
        display: none;
    }

    .custom-select.open .custom-select-options {
        display: block;
    }

    .custom-select-search {
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8f8f8;
    }

    .custom-select-search i {
        color: #666;
        font-size: 20px;
    }

    .custom-select-search-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: #000;
        padding: 5px 0;
    }

    .custom-select-search-input::placeholder {
        color: #999;
    }

    .custom-select-options-list {
        max-height: 240px;
        overflow-y: auto;
        padding: 5px 0;
    }

    .custom-select-option {
        padding: 12px 20px;
        cursor: pointer;
        color: #000;
        transition: all 0.2s ease;
        font-size: 15px;
    }

    .custom-select-option:hover {
        background: #f0f0f0;
    }

    .custom-select-option.selected {
        background: #000;
        color: #fff;
    }

    .custom-select-option.hidden {
        display: none;
    }

    /* Scrollbar styling for options list */
    .custom-select-options-list::-webkit-scrollbar {
        width: 6px;
    }

    .custom-select-options-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .custom-select-options-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .custom-select-options-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* No results message */
    .no-results {
        padding: 12px 20px;
        color: #999;
        text-align: center;
        font-size: 14px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .custom-select-options {
            max-height: 250px;
        }

        .custom-select-options-list {
            max-height: 190px;
        }
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
                <div class="register-logo-text">{{ __('messages.register.logo_text') }}</div>
            </div>
            <h1 class="register-welcome-title">{{ __('messages.register.welcome') }}</h1>
            <p class="register-welcome-subtitle">
                {{ __('messages.register.welcome_subtitle') }}
            </p>
            <a href="/login" class="sign-in-btn">{{ __('messages.register.sign_in') }}</a>
        </div>
    </div>

    <!-- Right Side: Registration Form -->
    <div class="register-right">
        <div class="register-form-container">
            <h2 class="register-form-title">{{ __('messages.register.form_title') }}</h2>

            @if(isset($package) && $package)
            <div class="package-info-mini">
                <h4>
                    <i class="material-icons" style="vertical-align: middle; font-size: 18px;">check_circle</i>
                    {{ __('messages.register.selected_package') }}
                </h4>
                <div class="package-details">
                    <div class="package-detail">
                        <strong>{{ $package->speed ?? 'N/A' }}</strong>
                        <span>{{ __('messages.register.speed') }}</span>
                    </div>
                    <div class="package-detail">
                        <strong>{{ $package->time_limit ?? 'N/A' }}</strong>
                        <span>{{ __('messages.register.time') }}</span>
                    </div>
                    <div class="package-detail">
                        <strong>৳{{ number_format($package->price ?? 0) }}</strong>
                        <span>{{ __('messages.register.price') }}</span>
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
                <span class="divider-text">{{ __('messages.register.divider_text') }}</span>
            </div>

            <div class="alert-mini">
                <i class="material-icons" style="vertical-align: middle; font-size: 16px;">info</i>
                {{ __('messages.register.alert_message') }}
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
                        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required', 'placeholder' => __('messages.register.name')]) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">phone</i>
                        {{ Form::text('contact', null, ['class' => 'form-control', 'id' => 'contact', 'required', 'maxlength' => '11', 'pattern' => '[0-9]{11}', 'placeholder' => __('messages.register.contact')]) }}
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">phone_android</i>
                        {{ Form::text('contact_confirmation', null, ['class' => 'form-control', 'id' => 'contact_confirmation', 'required', 'maxlength' => '11', 'pattern' => '[0-9]{11}', 'placeholder' => __('messages.register.confirm_mobile')]) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">email</i>
                        {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => __('messages.register.email')]) }}
                    </div>
                </div> --}}

                {{-- <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">place</i>
                        <div class="custom-select-wrapper">
                            <input type="hidden" name="area" id="area" value="">
                            <div class="custom-select" id="customAreaSelect">
                                <div class="custom-select-trigger">
                                    <span class="custom-select-value">{{ __('messages.register.select_area') }}</span>
                                    <i class="material-icons custom-select-arrow">keyboard_arrow_down</i>
                                </div>
                                <div class="custom-select-options">
                                    <div class="custom-select-search">
                                        <i class="material-icons">search</i>
                                        <input type="text" class="custom-select-search-input" placeholder="{{ __('messages.register.search_area') }}" id="areaSearch">
                                    </div>
                                    <div class="custom-select-options-list" id="areaOptionsList">
                                        @foreach($areas as $area)
                                            <div class="custom-select-option" data-value="{{ $area['english'] }}" data-bangla="{{ $area['bangla'] }}" data-english="{{ $area['english'] }}">
                                                {{ app()->getLocale() == 'bn' ? $area['bangla'] : $area['english'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="material-icons input-icon">home</i>
                        {{ Form::textarea('details', null, ['class' => 'form-control', 'id' => 'address', 'rows' => 3, 'placeholder' => __('messages.register.address')]) }}
                    </div>
                </div>
                
                <div class="input-group">
                  <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="{{__('messages.register.map')}}">
                  <span class="input-group-addon">
                    <button type="button" data-toggle="modal" data-target="#map_modal">
                      <i class="fa fa-map"></i>
                    </button>
                  </span>
              </div>

                <button type="submit" class="submit-btn">
                    {{ __('messages.register.submit') }}
                </button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Google Map</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div id="map" style="width:100%; height:400px; margin-top:0"></div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<script src="{{'/js/open-map.js?v=1.0.2'}}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const customSelect = document.getElementById('customAreaSelect');
    const selectTrigger = customSelect.querySelector('.custom-select-trigger');
    const selectValue = customSelect.querySelector('.custom-select-value');
    const selectOptions = customSelect.querySelector('.custom-select-options');
    const hiddenInput = document.getElementById('area');
    const searchInput = document.getElementById('areaSearch');
    const optionsList = document.getElementById('areaOptionsList');
    const allOptions = optionsList.querySelectorAll('.custom-select-option');
    const currentLocale = '{{ app()->getLocale() }}';

    // Toggle dropdown
    selectTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        customSelect.classList.toggle('open');
        if (customSelect.classList.contains('open')) {
            searchInput.focus();
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!customSelect.contains(e.target)) {
            customSelect.classList.remove('open');
        }
    });

    // Handle option selection
    allOptions.forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const bangla = this.getAttribute('data-bangla');
            const english = this.getAttribute('data-english');
            
            // Update hidden input
            hiddenInput.value = value;
            
            // Update displayed value
            selectValue.textContent = currentLocale === 'bn' ? bangla : english;
            selectValue.classList.remove('placeholder');
            
            // Update selected state
            allOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            
            // Close dropdown
            customSelect.classList.remove('open');
            
            // Clear search
            searchInput.value = '';
            filterOptions('');
        });
    });

    // Search functionality
    searchInput.addEventListener('input', function(e) {
        filterOptions(e.target.value);
    });

    function filterOptions(searchTerm) {
        const term = searchTerm.toLowerCase();
        let visibleCount = 0;
        
        allOptions.forEach(option => {
            const bangla = option.getAttribute('data-bangla').toLowerCase();
            const english = option.getAttribute('data-english').toLowerCase();
            const matches = bangla.includes(term) || english.includes(term);
            
            if (matches) {
                option.classList.remove('hidden');
                visibleCount++;
            } else {
                option.classList.add('hidden');
            }
        });
        
        // Show message if no results
        if (visibleCount === 0 && term.length > 0) {
            if (!optionsList.querySelector('.no-results')) {
                const noResults = document.createElement('div');
                noResults.className = 'no-results';
                noResults.style.padding = '12px 20px';
                noResults.style.color = '#999';
                noResults.style.textAlign = 'center';
                noResults.textContent = '{{ __('messages.register.no_results') }}';
                optionsList.appendChild(noResults);
            }
        } else {
            const noResults = optionsList.querySelector('.no-results');
            if (noResults) {
                noResults.remove();
            }
        }
    }

    // Keyboard navigation
    selectTrigger.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            customSelect.classList.toggle('open');
            if (customSelect.classList.contains('open')) {
                searchInput.focus();
            }
        }
    });

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            customSelect.classList.remove('open');
            selectTrigger.focus();
        }
    });
});
</script>

@endsection
