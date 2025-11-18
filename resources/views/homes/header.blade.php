<style>
    .professional-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10000;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .professional-header.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
    }

    .header-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .header-logo:hover {
        transform: scale(1.05);
    }

    .header-logo img {
        height: 45px;
        width: auto;
    }

    .header-brand {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        letter-spacing: 0.5px;
    }

    .header-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .header-nav li {
        margin: 0;
    }

    .header-link {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 10px;
        color: #555;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
    }

    .header-link:hover {
        color: #000;
        background: rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .header-link.active {
        color: #000;
        background: rgba(0, 0, 0, 0.1);
    }

    .header-link i.material-icons {
        font-size: 18px;
    }
    
    .header-btn i.fa {
        font-size: 16px;
    }

    .header-btn {
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .header-btn-primary {
        background: #000;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .header-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        background: #333;
        color: #fff;
    }

    .header-btn-outline {
        border: 2px solid #000;
        color: #000;
        background: transparent;
    }

    .header-btn-outline:hover {
        background: #000;
        color: #fff;
        transform: translateY(-2px);
    }

    .language-selector {
        position: relative;
        margin-left: 8px;
    }

    .language-selector select {
        padding: 10px 36px 10px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        background: #fff;
        color: #555;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23000' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    .language-selector select:hover,
    .language-selector select:focus {
        border-color: #000;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
    }

    .mobile-menu-toggle {
        display: none;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .mobile-menu-toggle:hover {
        background: rgba(0, 0, 0, 0.05);
    }

    .mobile-menu-toggle i {
        font-size: 28px;
        color: #333;
    }

    @media (max-width: 992px) {
        .header-container {
            padding: 12px 20px;
        }

        .header-logo img {
            height: 38px;
        }

        .header-brand {
            font-size: 18px;
        }

        .mobile-menu-toggle {
            display: block;
        }

        .header-nav {
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            flex-direction: column;
            padding: 20px;
            gap: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .header-nav.active {
            max-height: 500px;
            opacity: 1;
        }

        .header-nav li {
            width: 100%;
        }

        .header-link,
        .header-btn {
            width: 100%;
            justify-content: center;
            padding: 14px 20px;
        }

        .language-selector {
            margin-left: 0;
            width: 100%;
        }

        .language-selector select {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .header-container {
            padding: 10px 15px;
        }

        .header-brand {
            display: none;
        }
    }
</style>

<nav class="professional-header" id="professionalHeader">
    <div class="header-container">
        <!-- Logo -->
        <a href="/" class="header-logo">
            <img src="{{ app()->getLocale() == 'en' ? '/images/logo_english.png' : '/images/logo.png' }}" alt="Chalanbeel Technology">
        </a>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="material-icons">menu</i>
        </button>

        <!-- Navigation -->
        <ul class="header-nav" id="headerNav">
            <li>
                <a href="/" class="header-link active">
                    <i class="material-icons">home</i>
                    {{ __('messages.header.home') }}
                </a>
            </li>
            
            <li>
                <a href="/about" class="header-link">
                    <i class="material-icons">info</i>
                    {{ __('messages.header.about') }}
                </a>
            </li>
            <li>
                <a href="/package" class="header-link">
                    <i class="material-icons">view_list</i>
                    {{ __('messages.header.package') }}
                </a>
            </li>
            <li>
                <a href="/services" class="header-link">
                    <i class="material-icons">business</i>
                    {{ __('messages.header.services') }}
                </a>
            </li>
            <li>
                <a href="/view-user-on-map" class="header-link">
                    <i class="material-icons">people</i>
                    {{ __('messages.header.users') }}
                </a>
            </li>
            <li>
                <a href="/register/create" class="header-link">
                    <i class="material-icons">person_add</i>
                    {{ __('messages.header.register') }}
                </a>
            </li>
            <li>
                <a href="/login" class="header-link">
                    <i class="material-icons">lock</i>
                    {{ __('messages.header.login') }}
                </a>
            </li>
            <li>
                <a href="https://inventory.chalanbeel.com/" target="_blank" class="header-btn header-btn-outline" rel="noopener noreferrer">
                    <i class="fa fa-cubes"></i>
                    {{ __('messages.header.inventory') }}
                </a>
            </li>
            <li>
                <a href="https://grameenbazar.vercel.app/" target="_blank" class="header-btn header-btn-outline" rel="noopener noreferrer">
                    <i class="material-icons">store</i>
                    {{ __('messages.header.bazar') }}
                </a>
            </li>
            
            <li class="language-selector">
                <select onchange="location = this.value;">
                    <option value="{{ route('changeLanguage', ['locale' => 'en']) }}" @if(app()->getLocale() == 'en') selected @endif>🌐 English</option>
                    <option value="{{ route('changeLanguage', ['locale' => 'bn']) }}" @if(app()->getLocale() == 'bn') selected @endif>🌐 বাংলা</option>
                </select>
            </li>
        </ul>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('mobileMenuToggle').addEventListener('click', function() {
        const nav = document.getElementById('headerNav');
        const icon = this.querySelector('i');
        nav.classList.toggle('active');
        icon.textContent = nav.classList.contains('active') ? 'close' : 'menu';
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('professionalHeader');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const nav = document.getElementById('headerNav');
        const toggle = document.getElementById('mobileMenuToggle');
        if (nav.classList.contains('active') && !nav.contains(event.target) && !toggle.contains(event.target)) {
            nav.classList.remove('active');
            toggle.querySelector('i').textContent = 'menu';
        }
    });
</script>

<div class="wrapper wrapper-full-page">

@include('partials.messages')