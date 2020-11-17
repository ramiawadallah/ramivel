<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RAMIVEL') }} {{ ucfirst(config('multiauth.prefix')) }}</title>

        <meta name="description" content="RAMIVEL - LARAVEL 4 Admin CONTROLLER &amp; UI Framework created by Rami Awadallah">
        <meta name="author" content="Rami Awadallah">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="RAMIVEL - LARAVEL 4 Admin CONTROLLER &amp; UI Framework">
        <meta property="og:site_name" content="RAMIVEL">
        <meta property="og:description" content="RAMIVEL - LARAVEL 4 Admin CONTROLLER &amp; UI Framework created by Rami Awadallah">
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
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/magnific-popup/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ theme('backend/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{ theme('backend/css/bootstrap-tagsinput.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ theme('backend/css/ramivel.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ theme('backend/css/main.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@2.1.0/dark.css">
        
        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ theme('backend/css/themes/' . setting()->theme . '.css') }}">
        <!-- END Stylesheets -->

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
          var editor_config = {
                path_absolute : "/",
                selector: "textarea",
                plugins: [
                  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                  "searchreplace wordcount visualblocks visualchars code fullscreen",
                  "insertdatetime media nonbreaking save table contextmenu directionality",
                  "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ltr rtl | insertfile media image video| removeformat",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                  var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                  var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                  var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                  if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                  } else {
                    cmsURL = cmsURL + "&type=Files";
                  }
                  tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                  });
                }
              };
              tinymce.init(editor_config);
        </script>

    </head>
    <body>
        @include('message') 

        <div id="page-container" class="sidebar-o sidebar-light enable-page-overlay side-scroll page-header-fixed">
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="font-w600 text-dual" href="{{ url('/admin') }}">
                        <img  class="logo-main img-fluid text-primary" src="{{ theme('backend/media/favicons/logo.png') }}">
                        <span class="smini-hide">
                            <span style="margin-left: -30px;" class="font-w700 font-size-h6">RAMIVEL</span><span class="font-w400">1.0</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Color Variations -->
                        <div class="dropdown d-inline-block ml-3">
                            <a class="text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="si si-drop"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                                <!-- Color Themes -->

                                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                                @foreach($thems = app('config')->get('cms.design') as $key => $value)

                                    <a  class="dropdown-item d-flex align-items-center justify-content-between" 
                                            data-toggle="theme" 
                                            data-theme="{{ ucfirst($value) }}" 
                                            href="#" 
                                            onclick="event.preventDefault();
                                            document.getElementById('updateSetting{{ $value }}').submit();">
                                        <span>{{ ucfirst($value) }}</span>
                                        <i class="fa fa-circle text-{{ $value }}"></i>
                                    </a>

                                    <form action="{{ route('admin.settings.updatetheme',setting()->id) }}" style="display:none;" id="updateSetting{{ $value }}" method="POST">
                                        @csrf
                                        <input type="submit" type="hidden">
                                        <input type="hidden" name="theme" value="{{ $value }}">
                                    </form>

                                @endforeach
                                
                            </div>
                        </div>
                        <!-- END Themes -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                            <i class="fa fa-times"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
                <!-- END Side Header -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ url('/admin') }}">
                                <i class="nav-main-link-icon si si-speedometer"></i>
                                <span class="nav-main-link-name">{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">{{ __('App links') }}</li>
                        
                        @admin('super')
                            <li class="nav-main-item"><a class="nav-main-link" href="{{ route('admin.show') }}">
                                <i class="nav-main-link-icon si si-user-follow"></i><span class="nav-main-link-name">{{ ucfirst(config('multiauth.prefix')) }}</span></a>
                            </li>
                            <li class="nav-main-item"><a class="nav-main-link" href="{{ route('admin.roles') }}">
                                <i class="nav-main-link-icon si si-badge"></i><span class="nav-main-link-name">{{ __('Role') }}</span></a>
                            </li>

                            <li class="nav-main-item"><a class="nav-main-link" href="{{ url('admin/settings') }}">
                                <i class="nav-main-link-icon si si-settings"></i><span class="nav-main-link-name">{{ __('Settings') }}</span></a>
                            </li>

                            <li class="nav-main-item"><a class="nav-main-link" href="{{ url('admin/guards') }}">
                                <i class="nav-main-link-icon si si-anchor"></i><span class="nav-main-link-name">{{ __('Guards') }}</span></a>
                            </li>
                        @endadmin
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Toggle Mini Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>
                        <!-- END Toggle Mini Sidebar -->

                        <!-- Open Search Section (visible on smaller screens) -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">
                            <i class="si si-magnifier"></i>
                        </button>
                        <!-- END Open Search Section -->

                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="d-flex align-items-center">
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded" src="{{ isset(auth()->user()->avatarUrl) ? auth()->user()->avatarUrl : theme('backend/media/avatars/avatar0.jpg') }}" alt="Avatar" style="width: 18px;">
                                <span class="d-none d-sm-inline-block ml-1">{{ auth('admin')->user()->name }}</span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                                <div class="p-3 text-center bg-primary">
                                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ isset(auth()->user()->avatarUrl) ? auth()->user()->avatarUrl  : theme('backend/media/avatars/avatar0.jpg') }}" alt="Avatar">
                                </div>
                                <div class="p-2">
                                    <h5 class="dropdown-header text-uppercase">{{ __('User options') }}</h5>
                                    <!-- Authentication Links -->
                                    @guest('admin')
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{route('admin.login')}}">
                                            <span>{{ __('Login') }} </span>
                                        </a>
                                        @else
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.password.change') }}"><span>{{ __('Change password') }}</span></a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('admin.media') }}"><span>{{ __('Media') }}</span></a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="/admin/logout" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <span>{{ __('Logout') }}</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                        </form>
                                    @endguest
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header bg-white">
                    <div class="content-header">
                        <form class="w-100" action="be_pages_generic_search.html" method="POST">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-fw fa-times-circle"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-white">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://www.ramiawadallah.com" target="_blank">Rami Awadallah</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                            <a class="font-w600" href="https://www.ramiawadallah.com" target="_blank">RAMIVEL 1.0</a> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>

        <script src="{{ theme('backend/js/ramivel.core.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/ramivel.app.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/main.js' ) }}"></script>
        <script src="{{ theme('backend/js/bootstrap-tagsinput.js' ) }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.3/dist/sweetalert2.all.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="{{ theme('backend/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/select2/js/select2.full.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/dropzone/dropzone.min.js' ) }}"></script>
        <script src="{{ theme('backend/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
        <script src="{{ theme('backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

        <script src="{{ theme('backend/js/pages/be_tables_datatables.min.js') }}"></script>
        

        <script>
            $(document).ready(function(){
                $("#myToast").toast({delay: 7000});
                $("#myToast").toast('show');
            });
        </script>

        <script type="text/javascript">
            $('.test-popup-link').magnificPopup({
              type: 'image'
              // other options
            });
        </script>

        <!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
        <script>jQuery(function(){ One.helpers(['magnific-popup','notify','datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>

    </body>

</html>