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

<!-- CSS FILES -->
<link rel="stylesheet" href="{{ theme('frontend/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ theme('frontend/css/bundle.min.css') }}">
<link rel="stylesheet" href="{{ theme('frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ theme('frontend/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.css">
</head>
<body class="bg-dark">
  <div class="cursor js-cursor"></div>
  <!-- end cursor -->
  <div class="preloader" id="preloader"> 
    <span></span>
    <div class="inner">
      <canvas class="progress-bar" id="progress-bar" width="500" height="500"></canvas>
      <img src="{{ Storage::url(setting()->icon) }}" srcset="{{ Storage::url(setting()->icon) }}" alt="Image">
    </div>
    <!-- end inner --> 
  </div>
  <!-- end preloder -->

  <!-- end page-transition -->
  <div class="site-navigation" style="">
    <ul>
      @include('partials.navigation')
    </ul>
  </div>
  <!-- edn site-navigation -->
  <nav class="navbar">
    <div class="logo"> <a href="{{ url('/') }}">
    	<img src="{{ Storage::url(setting()->logo) }}" srcset="{{ Storage::url(setting()->logo) }}" alt="Image"> </a> 
    </div>
    <!-- end logo -->
    <!-- <ul class="languages">
      <li><a href="#" data-text="Eng">Eng</a></li>
      <li><a href="#" data-text="Rus">Rus</a></li>
    </ul> -->
    <!-- end languages --> 
    <span class="menu-text">Navigation</span>
    <div class="sandwich-menu">
      <div class="sandwich">
        <div class="sand"> <span></span> <span></span> </div>
        <!-- end sand -->
        <div class="closed"> <span></span> <span></span> </div>
        <!-- end closed --> 
      </div>
      <!-- end sandwich --> 
      
    </div>
    <!-- end sandwich-menu --> 
  </nav>
  <!-- end navbar -->

  @yield('content')

  

<!-- JS FILES --> 
<script src="{{ theme('frontend/js/jquery.min.js') }}"></script> 
<script src="{{ theme('frontend/js/bootstrap.min.js') }}"></script> 
<script src="{{ theme('frontend/js/bundle.js') }}"></script> 
<script src="{{ theme('frontend/js/scripts.js') }}"></script>
<script src="{{ theme('js/contact.form.min.js') }}"></script> 
<script src="https://api-maps.yandex.ru/2.1/?lang=en_RU"></script>
<script src="{{ theme('frontend/js/maps.min.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
</body>

</html>