<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Google Fonts - Roboto Condensed for English -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    @include('partials.styles')

    @yield('stylesheets')

    <style>
        /* Apply Roboto Condensed font for English language - exclude icon elements */
        html[lang="en"] body {
            font-family: 'Roboto Condensed', sans-serif !important;
        }
        
        html[lang="en"] p,
        html[lang="en"] h1,
        html[lang="en"] h2,
        html[lang="en"] h3,
        html[lang="en"] h4,
        html[lang="en"] h5,
        html[lang="en"] h6,
        html[lang="en"] span:not(.material-icons):not(.fa),
        html[lang="en"] div:not(.material-icons):not(.fa),
        html[lang="en"] a:not(.material-icons):not(.fa),
        html[lang="en"] li:not(.material-icons):not(.fa),
        html[lang="en"] td:not(.material-icons):not(.fa),
        html[lang="en"] th:not(.material-icons):not(.fa),
        html[lang="en"] label:not(.material-icons):not(.fa),
        html[lang="en"] input:not(.material-icons):not(.fa),
        html[lang="en"] textarea:not(.material-icons):not(.fa),
        html[lang="en"] select:not(.material-icons):not(.fa),
        html[lang="en"] button:not(.material-icons):not(.fa) {
            font-family: 'Roboto Condensed', sans-serif !important;
        }
        
        /* Ensure icon fonts are preserved */
        html[lang="en"] .material-icons,
        html[lang="en"] i.material-icons,
        html[lang="en"] [class*="material-icons"] {
            font-family: 'Material Icons' !important;
        }
        
        html[lang="en"] .fa,
        html[lang="en"] i.fa,
        html[lang="en"] [class*="fa-"],
        html[lang="en"] i[class*="fa"] {
            font-family: 'FontAwesome' !important;
        }
        
        /* Keep Bengali-friendly fonts for Bengali language */
        html[lang="bn"] body {
            font-family: 'Bangla', 'Noto Sans Bengali', 'Kalpurush', 'SolaimanLipi', sans-serif;
        }
        
        html[lang="bn"] p,
        html[lang="bn"] h1,
        html[lang="bn"] h2,
        html[lang="bn"] h3,
        html[lang="bn"] h4,
        html[lang="bn"] h5,
        html[lang="bn"] h6,
        html[lang="bn"] span:not(.material-icons):not(.fa),
        html[lang="bn"] div:not(.material-icons):not(.fa),
        html[lang="bn"] a:not(.material-icons):not(.fa),
        html[lang="bn"] li:not(.material-icons):not(.fa),
        html[lang="bn"] td:not(.material-icons):not(.fa),
        html[lang="bn"] th:not(.material-icons):not(.fa),
        html[lang="bn"] label:not(.material-icons):not(.fa),
        html[lang="bn"] input:not(.material-icons):not(.fa),
        html[lang="bn"] textarea:not(.material-icons):not(.fa),
        html[lang="bn"] select:not(.material-icons):not(.fa),
        html[lang="bn"] button:not(.material-icons):not(.fa) {
            font-family: 'Bangla', 'Noto Sans Bengali', 'Kalpurush', 'SolaimanLipi', sans-serif;
        }
        
        /* Ensure icon fonts are preserved for Bengali */
        html[lang="bn"] .material-icons,
        html[lang="bn"] i.material-icons,
        html[lang="bn"] [class*="material-icons"] {
            font-family: 'Material Icons' !important;
        }
        
        html[lang="bn"] .fa,
        html[lang="bn"] i.fa,
        html[lang="bn"] [class*="fa-"],
        html[lang="bn"] i[class*="fa"] {
            font-family: 'FontAwesome' !important;
        }
    </style>

</head>

<body ng-app="cbTech" style="background:url(/images/bg.jpg) center center; padding-top: 0;">

	@include('homes.header')

		@yield('content')

	@include('homes.footer')

	<!-- Floating Action Buttons -->
	<div class="floating-buttons">
		<a href="/speed-test" class="floating-btn speed-test-btn" title="{{ __('messages.speed_test.title') }}">
			<i class="material-icons">flash_on</i>
		</a>
		<a href="https://wa.me/8801703587911" target="_blank" class="floating-btn whatsapp-btn" title="WhatsApp" rel="noopener noreferrer">
			<i class="fa fa-whatsapp"></i>
		</a>
	</div>

	<style>
		.floating-buttons {
			position: fixed;
			bottom: 30px;
			left: 30px;
			z-index: 1000;
			display: flex;
			flex-direction: column;
			gap: 15px;
		}

		.floating-btn {
			width: 60px;
			height: 60px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			color: #fff;
			text-decoration: none;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
			transition: all 0.3s ease;
			cursor: pointer;
			position: relative;
		}

		.floating-btn i {
			font-size: 28px;
		}

		.floating-btn i.material-icons {
			font-family: 'Material Icons' !important;
			font-size: 28px !important;
		}

		.floating-btn i.fa {
			font-family: 'FontAwesome' !important;
			font-size: 28px !important;
		}

		.floating-btn:hover {
			transform: translateY(-5px) scale(1.1);
			box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
		}

		.speed-test-btn {
			background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
		}

		.speed-test-btn:hover {
			background: linear-gradient(135deg, #1a1a1a 0%, #000 100%);
		}

		.whatsapp-btn {
			background: #25D366;
		}

		.whatsapp-btn:hover {
			background: #20BA5A;
		}

		.floating-btn::before {
			content: attr(title);
			position: absolute;
			right: 70px;
			background: #000;
			color: #fff;
			padding: 8px 12px;
			border-radius: 6px;
			font-size: 14px;
			white-space: nowrap;
			opacity: 0;
			pointer-events: none;
			transition: all 0.3s ease;
			font-weight: 600;
		}

		.floating-btn:hover::before {
			opacity: 1;
			right: 75px;
		}

		@media (max-width: 768px) {
			.floating-buttons {
				bottom: 20px;
				left: 20px;
				gap: 12px;
			}

			.floating-btn {
				width: 55px;
				height: 55px;
			}

			.floating-btn i {
				font-size: 24px;
			}

			.floating-btn::before {
				display: none;
			}
		}
	</style>

	<!--   Core JS Files   -->
	@include('partials.scripts')

	@yield('scripts')

	<script type="text/javascript">
    $().ready(function() {
    	demo.checkFullPageBackgroundImage();
    	setTimeout(function() {
    		// after 1000 ms we add the class animated to the login/register card
    		$('.card').removeClass('card-hidden');
    	}, 700)
    });
  </script>

</body>
</html>