@extends('layouts.frontend')

@section('content')
	@foreach(\App\Models\Page::where('uri', Request::path())->get() as $page)
		<!-- Home Slider Start -->
			<section class="banner-section text-center" dir="rtl">
				<div class="home-carousel owl-theme owl-carousel">
					@foreach (\App\Models\Slider::all() as $slider)
						<div class="slide-item">
							<div class="image-layer" data-background="{{ media($slider->photo) }}"></div>
							<div class="auto-container">
								<div class="row clearfix">
									<div class="col-xl-12 col-lg-12 col-md-12 content-column">
										<div class="content-box">
											<h1>{{ $slider->trans('title') }}</h1>
											<div class="col-xl-8 col-lg-8 col-md-8 content-column mx-auto">
												<p>{!! $slider->trans('content') !!}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</section>
		<!-- Home Slider End -->
		
		<style>
			.section-title h2 {
				font-weight: 700;
				color: #20247b;
				font-size: 45px;
				margin: 0 0 15px;
				@if(App::currentLocale() == 'ar') 
				border-right: 5px solid #fc5356;
				@else 
				border-left: 5px solid #fc5356;
				padding-left: 15px;
				@endif
			}
		</style>
		

		@if(\App\Models\Section::count() >= 1)
			@foreach(\App\Models\Section::where('status', 'active')->where('page_id', $page->id)->get() as $section)
				@if($section->type == 'Service')	
				<section class="section services-section @if($section->id == 2) bg-light @endif" id="services" @if(App::currentLocale() == 'ar') dir="rtl" @endif>
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="section-title">
									<h2>{{ $section->trans('title') }}</h2>
									<p>
										{{ $section->trans('subtitle') }}
									</p>

									{{-- <p>
										{!! $section->trans('content') !!}
									</p> --}}
								</div>
							</div>
							{{-- <div class="col-md-6 flex text-center">
								<img class="img-fluid mx-auto" src="{{ media($section->photo) }}" alt="">
							</div> --}}
						</div>
						<div class="row">
							@foreach (\App\Models\Service::where('status','active')->where('type',$section->id)->get() as $service)	  
							<!-- feaure box -->
							<div class="col-sm-6 col-lg-4">
								<div class="feature-box-1">
									<div class="icon">
										<i class="fa">{{ $service->trans('title')  }}</i>
									</div>
									<div class="feature-content">
										<p>{!! $service->trans('content') !!}</p>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					</section>
				@endif
			@endforeach
		@endif


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
