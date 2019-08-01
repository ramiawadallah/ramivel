<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RAMVEL') }} {{ ucfirst(config('multiauth.prefix')) }}</title>

        <meta name="description" content="RAMVEL - LARAVEL 4 Admin CONTROLLER &amp; UI Framework created by Rami Awadallah">
        <meta name="author" content="Rami Awadallah">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="RAMVEL - LARAVEL 4 Admin CONTROLLER &amp; UI Framework">
        <meta property="og:site_name" content="RAMVEL">
        <meta property="og:description" content="RAMVEL - LARAVEL 4 Admin CONTROLLER &amp; UI Framework created by Rami Awadallah">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ theme('backend/media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ theme('backend/media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ theme('backend/media/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}">

        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{ theme('backend/css/ramvel.css') }}">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ theme('backend/css/themes/modern.min.css') }}">
        <!-- END Stylesheets -->
    </head>
    <body>

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->
        
        <!-- Footer -->
            <div class="font-size-sm text-center text-muted py-3">
                <strong>Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">Rami Awadallah</a></strong> &copy; 
                <a class="font-w600" href="http://ramiawadallah.com" target="_blank">RAMVEL 1.0</a> &copy; <span data-toggle="year-copy"></span>
            </div>
        <!-- Footer -->

        <script src="{{ theme('backend/js/ramvel.core.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/ramvel.app.min.js' ) }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ theme('backend/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/select2/js/select2.full.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/dropzone/dropzone.min.js' ) }}"></script>

        <!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
        <script>jQuery(function(){ One.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>
    </body>

</html>