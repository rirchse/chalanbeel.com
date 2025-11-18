<style>
    .professional-footer {
        background: #000;
        color: #fff;
        padding: 60px 0 0;
        position: relative;
        z-index: 1;
    }

    .footer-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-main {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        padding-bottom: 40px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-section h3 {
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 20px;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-section h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: #fff;
    }

    .footer-about {
        max-width: 300px;
    }

    .footer-logo {
        margin-bottom: 15px;
    }

    .footer-logo img {
        height: 50px;
        width: auto;
        filter: brightness(0) invert(1);
    }

    .footer-about p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links ul li {
        margin-bottom: 0;
        display: block;
        list-style: none;
        text-align: left;
    }

    .footer-links ul li a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 6px;
        white-space: nowrap;
    }

    .footer-links ul li a:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .footer-links ul li a i {
        font-size: 16px;
    }

    .footer-contact {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        line-height: 2;
    }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 15px;
    }

    .footer-contact-item i {
        font-size: 18px;
        color: #fff;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .footer-contact-item span {
        color: rgba(255, 255, 255, 0.8);
    }

    .footer-social {
        margin-top: 20px;
    }

    .footer-social h4 {
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 15px;
    }

    .social-links {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .social-link {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
    }

    .social-link:hover.fb-link {
        background: #1877f2;
        border-color: #1877f2;
        color: #fff;
    }

    .social-link:hover.twitter-link {
        background: #1da1f2;
        border-color: #1da1f2;
        color: #fff;
    }

    .social-link:hover.youtube-link {
        background: #ff0000;
        border-color: #ff0000;
        color: #fff;
    }

    .social-link:hover.linkedin-link {
        background: #0077b5;
        border-color: #0077b5;
        color: #fff;
    }

    .social-link i {
        font-size: 18px;
    }

    .footer-bottom {
        background: rgba(0, 0, 0, 0.5);
        padding: 25px 20px;
        text-align: center;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-bottom-content {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .footer-copyright {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
    }

    .footer-copyright a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .footer-copyright a:hover {
        text-decoration: underline;
    }

    .footer-payments {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .footer-payments span {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        margin-right: 5px;
    }

    .payment-method {
        width: 40px;
        height: 30px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
    }

    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: #000;
        color: #fff;
        border: 2px solid #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: #fff;
        color: #000;
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    .back-to-top i {
        font-size: 24px;
    }

    @media (max-width: 768px) {
        .professional-footer {
            padding: 40px 0 0;
        }

        .footer-main {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-links ul {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .footer-links ul li a {
            width: 100%;
        }

        .footer-bottom-content {
            flex-direction: column;
            text-align: center;
        }

        .footer-payments {
            justify-content: center;
        }

        .back-to-top {
            bottom: 20px;
            right: 20px;
            width: 45px;
            height: 45px;
        }
    }
</style>

<footer class="professional-footer">
    <div class="footer-content">
        <div class="footer-main">
            <!-- About Section -->
            <div class="footer-section footer-about">
                <div class="footer-logo">
                    <img src="{{ app()->getLocale() == 'en' ? '/images/logo_english.png' : '/images/logo.png' }}" alt="Chalanbeel Technology">
                </div>
                <h3>{{ __('messages.footer.about_us') }}</h3>
                <p>
                    {{ __('messages.footer.about_desc') }}
                </p>
                <div class="footer-social">
                    <h4>{{ __('messages.footer.stay_connected') }}</h4>
                    <div class="social-links">
                        <a href="#" class="social-link fb-link" title="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="social-link twitter-link" title="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link youtube-link" title="YouTube">
                            <i class="fa fa-youtube"></i>
                        </a>
                        <a href="#" class="social-link linkedin-link" title="LinkedIn">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section footer-links">
                <h3>{{ __('messages.footer.quick_links') }}</h3>
                <ul>
                    <li>
                        <a href="/">
                            <i class="material-icons">home</i>
                            <span>{{ __('messages.header.home') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/register/create">
                            <i class="material-icons">person_add</i>
                            <span>{{ __('messages.header.register') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/login">
                            <i class="material-icons">lock</i>
                            <span>{{ __('messages.header.login') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/package">
                            <i class="material-icons">view_list</i>
                            <span>{{ __('messages.header.package') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/check_payment">
                            <i class="material-icons">payment</i>
                            <span>{{ __('messages.footer.payment_check') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-section footer-links">
                <h3>{{ __('messages.services.title') }}</h3>
                <ul>
                    <li>
                        <a href="/service/high-speed-internet">
                            <i class="material-icons">flash_on</i>
                            <span>{{ __('messages.services.high_speed') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/service/stable-connection">
                            <i class="material-icons">wifi</i>
                            <span>{{ __('messages.services.stable_connection') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/service/24-7-support">
                            <i class="material-icons">headset_mic</i>
                            <span>{{ __('messages.services.support_247') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/service/secure-network">
                            <i class="material-icons">security</i>
                            <span>{{ __('messages.services.secure_network') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/service/fast-installation">
                            <i class="material-icons">build</i>
                            <span>{{ __('messages.services.fast_installation') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/service/trusted-service">
                            <i class="material-icons">verified_user</i>
                            <span>{{ __('messages.services.trusted_service') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-section footer-contact">
                <h3>{{ __('messages.contact.title') }}</h3>
                <div class="footer-contact-item">
                    <i class="material-icons">phone</i>
                    <div>
                        <div>017 78 57 33 96</div>
                        <div>017 03 58 79 11</div>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">email</i>
                    <div>
                        <div>info@chalanbeel.com</div>
                        <div>support@chalanbeel.com</div>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">schedule</i>
                    <div>
                        <div>{{ __('messages.contact.hours') }}</div>
                        <div>{{ __('messages.contact.days') }}</div>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">location_on</i>
                    <div>
                        <div>Chanchkoir Bazar, Gurudaspur Natore</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <div class="footer-copyright">
                &copy; <script>document.write(new Date().getFullYear())</script>
                <a href="/">Chalanbeel Technology</a>. {{ __('messages.footer.all_rights_reserved') }}.
            </div>
            <div class="footer-payments">
                <span>{{ __('messages.footer.payment_methods') }}:</span>
                <div class="payment-method">bKash</div>
                <div class="payment-method">Nagad</div>
                <div class="payment-method">Rocket</div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<div class="back-to-top" id="backToTop">
    <i class="material-icons">arrow_upward</i>
</div>

<script>
    // Back to top button
    const backToTop = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    });

    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
    </div>