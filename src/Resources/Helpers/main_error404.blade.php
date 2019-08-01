<!DOCTYPE html>
{!! Html::style($cpanel.'css/my-style.css') !!}
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ site('site_name',true) }} | {{ trans('lang.error404') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
        {!! Html::style($cpanel.'css/font-awesome.min.css') !!}
        {!! Html::style($cpanel.'css/simple-line-icons.min.css') !!}
        {!! Html::style($cpanel.'css/bootstrap'.getDir(true).'.min.css') !!}
        {!! Html::style($cpanel.'css/uniform.default.min.css') !!}
        {!! Html::style($cpanel.'css/bootstrap-switch'.getDir(true).'.min.css') !!}
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style($cpanel.'css/components'.getDir(true).'.min.css') !!}
        {!! Html::style($cpanel.'css/plugins'.getDir(true).'.min.css') !!}
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!! Html::style($cpanel.'css/error'.getDir(true).'.min.css') !!}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ $icon }}" /> </head>
    <!-- END HEAD -->
    <body class=" page-404-full-page">
        <div class="row">
            <div class="col-md-12 page-404">
                <div class="number font-red"> 404 </div>
                <div class="details">
                    <h3>{{ trans('lang.error404title') }}</h3>
                    <p> {{ trans('lang.error404content') }}
                        <br/>
                        <br/>
                        <a href="{{ url('/') }}" class="btn red btn-outline"> {{ lang('return_home') }} </a>
                        <br> </p>
                    
                </div>
            </div>
        </div>
    </body>

</html>