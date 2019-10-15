@extends('layouts.backend') 
@section('content')
        <!-- Hero -->
        <div class="bg-image overflow-hidden" style="background-image: url( {{ theme('backend/media/photos/photo3@2x.jpg') }} ) ;">
            <div class="bg-primary-dark-op">
                <div class="content content-narrow content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-2 mb-2 text-center text-sm-left">
                        <div class="flex-sm-fill">
                            <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">{{ trans('lang.dashboard') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content content-narrow">
            <!-- Stats -->
            <div class="row">
                <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                    <a href="{{ url('/admin/show') }}" class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">{{ trans('lang.admin') }}</div>
                            <div class="font-size-h2 font-w400 text-dark">{{ App\Admin::count() }}</div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- END Stats -->
        </div>
@endsection