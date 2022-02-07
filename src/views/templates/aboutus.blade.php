@extends('layouts.frontend')

@section('content')

	<style>
		/* Tell the list-items to not display numbers, but keep track of what the numbers should be */

		.about-section ol li {
			counter-increment: list;
			list-style-type: none;
			position: relative;
		}

		/* Output the numbers using the counter() function, but use a custom color, and position the numbers how we want */
		.about-section ol li:before {
			color: #e75204;
			content: " ";
			@if(App::currentLocale() == 'ar') right: -32px; @else left: -32px; @endif
			position: absolute;
			width: 15px;
			height: 15px;
			border: #FF4800 solid 1px;
			border-radius: 100%;
		}
	</style>


	@foreach(\App\Models\Page::where('uri', Request::path())->get() as $page)
		<section 
			class="page-title-section" 
			style="background-image: url({{ media($page->photo) }}); background-size: cover;"
			>
			<div 
				class="container"
				>
				<div class="row">
					<div class="col-xl-12 text-center">
						<div class="page-title-content "
								{{-- @if(App::currentLocale() == 'ar') float-right @endif"
								@if(App::currentLocale() == 'ar') dir="ltr" @endif --}}
							>
							<h3 class="title text-white">{{ $page->trans('title') }}</h3>
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('lang.Home') }}</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{ $page->trans('title') }}</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="about-section anim-object pdt-110 pdb-170 pdb-lg-110">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-12 col-xl-6">
						<div class="about-image-box mrr-lg-0 mrb-lg-110">
							{{-- <img class="about-image1 img-full js-tilt d-none d-xl-block" 
							src="{{ media($page->photo) }}" alt="" style=""> --}}
							<img class="about-image2 img-full"
							src="{{ media($page->photo) }}" alt="">
						</div>
					</div>
					<div class="col-md-12 col-xl-6 pdl-60" @if(App::currentLocale() == 'ar') dir="rtl" @endif>
						<h5 class="side-line-left text-primary-color mrb-15">{{ $page->trans('title') }}</h5>
						<h2 class="text-uppercase mrb-30">{{ $page->trans('subtitle') }}</h2>
						{!! $page->trans('content') !!}
					</div>
				</div>
			</div>
		</section>

		<section class="pdb-90">
			<div class="section-content">
				<div class="container border-top pdt-80">
					<div class="row">
						<div class="col-lg-12">
							<div class="owl-carousel client-items">
								@foreach (\App\Models\Partner::where('status','active')->get() as $partner)
									<div class="client-item">
										<img src="{{ media($partner->photo) }}" alt="">
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	@endforeach()
@endsection