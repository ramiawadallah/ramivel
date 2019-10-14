<!doctype html>
<html class="no-js" lang="@if(App::getLocale() == 'ar')" dir="rtl" @else() dir="ltr" @endif()>
    
<!-- Mirrored from bdevs.net/pohat/pohat/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Apr 2019 11:18:02 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="{{ setting()->subtitle }}">
        <meta name="keywords" content="{{ setting()->keyword }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ theme('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/meanmenu.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/slick.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/default.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ theme('frontend/css/responsive.css') }}">
    </head>
    <body>
        <!-- preloader -->
        <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- preloader end  -->

        <!-- header -->
        <header>
            <div class="header-top d-none d-sm-block">
                <div class="container-fluid container-p">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="h-social display-ib">
                                <!-- <a target="_new" href="{{ setting()->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                <a target="_new" href="{{ setting()->twitter }}"><i class="fab fa-twitter"></i></a>
                                <a target="_new" href="{{ setting()->youtube }}"><i class="fab fa-youtube"></i></a> -->
                                <a target="_new" href="{{ setting()->linkedin }}"><i class="fab fa-linkedin"></i></a>
                                <span>{{ setting()->phone }}</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="ht-cta text-right">
                                <span><i class="fal fa-envelope"></i><a href="{{ setting()->email }}" class="__cf_email__" data-cfemail="">{{ setting()->email }}</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  id="header-sticky" class="main-header">
                <div class="container-fluid container-p">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-3">
                            <div class="logo pr-85 display-ib">
                                <a href="{{ url('/') }}"><img width="110" class="img-fluid" src="{{ Storage::url( setting()->logo ) }}" alt="img"></a>
                            </div>
                            @if(\App\Lang::count() > 2)
                                <div class="h-language display-ib">
                                    <select name="name" class="selected">
                                        @foreach(\App\Lang::all() as $lang)
                                            <option value=""><a href="{{ $lang->cod }}">{{ $lang->trans('name') }}</a></option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif()
                            <!-- <div class="h-cta th-cta display-ib">
                                <span>{{ setting()->phone }}</span>
                            </div> -->
                        </div>

                        <div class="col-xl-5 col-lg-7">
                            <div class="main-menu text-right">
                                <nav id="mobile-menu">
                                    <ul>
                                        @include('partials.navigation')
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- <div class="col-xl-2 col-lg-3 d-none d-lg-block">
                            <div class="menu-btn text-right">
                                <a href="#" class="btn">Get A Quote</a>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header-end -->
        <!-- main -->
        <main>
            @yield('content')
        </main>
        <!-- main-end -->
        <!-- footer -->
        <footer class="s-footer-bg" data-background="{{ theme('frontend/img/slider/slider_bg04.jpg') }}">
            <div class="container">
                <div class="f-top pt-100 pb-100">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-10">
                            <div class="s-footer-text mb-45 text-center">
                                <div class="f-logo mb-45">
                                    <a href="{{ url('/') }}"><img style="filter: grayscale(100%);" width="150" class="img-fluid" src="{{ Storage::url( setting()->logo ) }}" alt="img"></a>
                                </div>
                                <p style="color: #FDFDFD !important;">{!! setting()->trans('content') !!}</p>
                            </div>
                            <div class="footer-social sf-social text-center">
                                <!-- <a target="_new" href="{{ setting()->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                 <a target="_new" href="{{ setting()->twitter }}"><i class="fab fa-twitter"></i></a>
                                 <a target="_new" href="{{ setting()->youtube }}"><i class="fab fa-youtube"></i></a> -->
                                <a target="_new" href="{{ setting()->linkedin }}"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-wrap s-copyright pt-30 pb-30">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <div class="copyright-text">
                                <p>Copyright <a target="_new" href="https://www.ramiawadallah.com" class="__cf_email__" data-cfemail="41033801">Rami Awadallah</a> | {{ setting()->trans('copyright') }} </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="back-btn s-back-btn text-right">
                                <a href="#" id="scrollToTop" class="btn transparent-btn">BACK TO TOP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-end -->




        <!-- JS here -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
        </script>
        <script src="{{ theme('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
        <script src="{{ theme('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ theme('frontend/js/popper.min.js') }}"></script>
        <script src="{{ theme('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ theme('frontend/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ theme('frontend/js/slick.min.js') }}"></script>
        <script src="{{ theme('frontend/js/jquery.meanmenu.min.js') }}"></script>
        <script src="{{ theme('frontend/js/ajax-form.js') }}"></script>
        <script src="{{ theme('frontend/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ theme('frontend/js/js_jquery.knob.js') }}"></script>
        <script src="{{ theme('frontend/js/js_jquery.appear.js') }}"></script>
        <script src="{{ theme('frontend/js/wow.min.js') }}"></script>
        <script src="{{ theme('frontend/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ theme('frontend/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ theme('frontend/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ theme('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ theme('frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ theme('frontend/js/plugins.js') }}"></script>
        <script src="{{ theme('frontend/js/main.js') }}"></script>
    </body>

<!-- Mirrored from bdevs.net/pohat/pohat/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Apr 2019 11:20:30 GMT -->
</html>
