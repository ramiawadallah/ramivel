<!<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from themezinho.net/annusa/index-video-bg.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Jan 2021 07:29:12 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="format-detection" content="telephone=no">
<meta name="theme-color" content="#4237ef"/>
<meta name="HandheldFriendly" content="true" />
<title>{{ config('app.name', 'RAMIVEL') }} | @yield('title')</title>
<meta name="author" content="Themezinho">
<meta name="description" content="{{ setting()->trans('title') }} | {{ setting()->trans('subtitle') }}">
<meta name="keywords" content="{{ setting()->keywords }}">

<!-- SOCIAL MEDIA META -->
<meta property="og:description" content="{{ setting()->trans('title') }} | {{ setting()->trans('subtitle') }}">
<meta property="og:image" content="{{ Storage::url(setting()->logo) }} ">
<meta property="og:site_name" content="{{ setting()->trans('title') }}">
<meta property="og:title" content="{{ setting()->trans('title') }}">
<meta property="og:type" content="{{ setting()->trans('subtitle') }}">

<!-- TWITTER META -->
<meta name="twitter:card" content="{{ setting()->trans('title') }}">
<meta name="twitter:site" content="{{ setting()->trans('title') }}">
<meta name="twitter:creator" content="{{ setting()->trans('copyright') }}">
<meta name="twitter:title" content="{{ setting()->trans('title') }}">
<meta name="twitter:description" content="{{ setting()->trans('title') }} | {{ setting()->trans('subtitle') }}">
<meta name="twitter:image" content="{{ Storage::url(setting()->logo) }} ">

<!-- FAVICON FILES -->
<link rel="apple-touch-icon" sizes="57x57" href="{{ theme('frontend/icon/apple-icon-57x57.png' ) }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ theme('frontend/icon/apple-icon-60x60.png' ) }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ theme('frontend/icon/apple-icon-72x72.png' ) }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ theme('frontend/icon/apple-icon-76x76.png' ) }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ theme('frontend/icon/apple-icon-114x114.png' ) }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ theme('frontend/icon/apple-icon-120x120.png' ) }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ theme('frontend/icon/apple-icon-144x144.png' ) }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ theme('frontend/icon/apple-icon-152x152.png' ) }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ theme('frontend/icon/apple-icon-180x180.png' ) }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ theme('frontend/icon/android-icon-192x192.png' ) }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ theme('frontend/icon/favicon-32x32.png' ) }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ theme('frontend/icon/favicon-96x96.png' ) }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ theme('frontend/icon/favicon-16x16.png' ) }}">
<link rel="manifest" href="{{ theme('/manifest.json') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!-- Main Stylesheet -->
	<link rel="stylesheet" href="{{ theme('frontend/css/bootstrap.css') }}">
	@if(App::currentLocale() == 'ar') 
		<link rel="stylesheet" href="{{ theme('frontend/css/rtl.min.css') }}">
	@endif
	<link rel="stylesheet" href="{{ theme('frontend/css/style.css') }}">
	<link rel="stylesheet" href="{{ theme('frontend/css/responsive.css') }}">

</head>
<body>
	<!-- Preloader Start -->
	<div class="preloader"></div>
	<!-- Preloader End -->

	<header  class="header-style-two">
		<div class="header-wrapper">
			<div class="header-top-area bg-primary-color d-none d-lg-block">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 header-top-left-part">
							<span class="phone"><i class="webexflaticon flaticon-phone-1"></i> {{ setting()->phone }}</span>
							<span class="phone"><i class="webexflaticon flaticon-send"></i> {{ setting()->email }}</span>
						</div>
						<div class="col-lg-6 header-top-right-part text-right">
							<ul class="social-links">
								<li><a href="{{ setting()->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
								{{-- <li><a href="{{ setting()->twitter }}"><i class="fab fa-twitter"></i></a></li> --}}
								<li><a href="{{ setting()->instagram }}"><i class="fab fa-instagram"></i></a></li>
							</ul>

							<div class="language">
								@if ( App::currentLocale() == 'en')
									<a class="" 
									href="{{ url('locale/'. \App\Models\Lang::where('code','ar')->first()->code) }}">
									<i class="webexflaticon flaticon-internet"></i>
									{{ \App\Models\Lang::where('code','ar')->first()->name }}
									</a>
								@elseif ( App::currentLocale() == 'ar' )
									<a class="" 
									href="{{ url('locale/'. \App\Models\Lang::where('code','en')->first()->code) }}"><i class="webexflaticon flaticon-internet"></i>
									{{ \App\Models\Lang::where('code','en')->first()->name }}
									</a>
								@endif
						</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-navigation-area two-layers-header">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<a class="navbar-brand logo f-left mrt-10 mrt-md-0" href="{{ url('/') }}">
								{{-- <img id="logo-image" class="img-center" src="{{ media(setting()->logo) }}" alt=""> --}}
								@if(App::currentLocale() == 'ar') 
									<img id="logo-image" class="img-center" src="{{ theme('frontend/img/sdlogo-02.png') }}" alt="">
								@else
									<img id="logo-image" class="img-center" src="{{ theme('frontend/img/sdlogo-01.png') }}" alt="">
								@endif
							</a>
							<div class="mobile-menu-right"></div>
							<div class="main-menu f-right">
								<nav id="mobile-menu-right">
									<ul>
										@include('partials.navigation')										
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

  	@yield('content')

	  <div class="footer-bottom-area">
			<div class="container footer-border-top pdt-30 pdb-10">
				<div class="row">
					<div class="col-xl-12">
						<div class="text-center">
							<span class="text-light-gray">Copyright © 2022 by <a class="text-primary-color" target="_blank" href="http://ramiawadallah.com"> Rami Awdallah</a> | All rights reserved </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->
	<!-- BACK TO TOP SECTION -->
	<div class="back-to-top bg-primary-color">
		<i class="fab fa-angle-up"></i>
	</div>
	<!-- Integrated important scripts here -->
	<script src="{{ theme('frontend/js/jquery.v1.12.4.min.js') }}"></script>
	<script src="{{ theme('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ theme('frontend/js/jquery-core-plugins.js') }}"></script>
	<script src="{{ theme('frontend/js/main.js') }}"></script>
</body>

</html>