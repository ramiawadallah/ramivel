@extends('layouts.frontend')

@section('content')
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

		<section class="contact-section pdt-110 pdb-95 pdb-lg-90" data-background="images/bg/abs-bg1.png" style="background-image: url(&quot;images/bg/abs-bg1.png&quot;);">
			<div class="container">
				<div class="row mrb-60">
					<div class="col-lg-7">
						<div class="contact-form">
							<form id="contact" name="contact" method="post" action="{{ url('send_email') }}">
								@CSRF
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group mrb-25">
											<input type="text" name="name" placeholder="{{ __('lang.Name') }}" class="form-control" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group mrb-25">
											<input type="text" name="phone" placeholder="{{ __('lang.Phone') }}" class="form-control" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group mrb-25">
											<input type="text" name="subject" placeholder="{{ __('lang.Subject') }}" class="form-control" required="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group mrb-25">
											<input type="email" name="email" placeholder="{{ __('lang.Email') }}" class="form-control" required="">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group mrb-25">
											<textarea rows="4" name="message" placeholder="{{ __('lang.Message') }}" class="form-control" required=""></textarea>
										</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group">
											<button type="submit" name="submit" class="cs-btn-one btn-md btn-round btn-primary-color element-shadow" value="Send">{{ __('lang.Submit Now') }}</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-5">
						<!-- Google Map Start -->
						<div class="mapouter fixed-height">
							<div class="gmap_canvas">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3626.132653565211!2d46.863453914998736!3d24.653561884151905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd92310f5b5b078a7!2zMjTCsDM5JzEyLjgiTiA0NsKwNTEnNTYuMyJF!5e0!3m2!1sen!2sjo!4v1644242711323!5m2!1sen!2sjo" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div>
						<!-- Google Map End -->
					</div>
				</div>
				<div class="row">
					{{-- <div class="col-lg-6 col-xl-4">
						<div class="contact-block d-flex mrb-30">
							<div class="contact-icon">
								<i class="webex-icon-map1"></i>
							</div>
							<div class="contact-details mrl-30">
								<h5 class="icon-box-title mrb-10">Our Address</h5>
								<p class="mrb-0">60 Broklyn Street USA</p>
							</div>
						</div>
					</div> --}}
					<div class="col-lg-6 col-xl-4">
						<div class="contact-block d-flex mrb-30">
							<div class="contact-icon">
								<i class="webex-icon-Phone2"></i>
							</div>
							<div class="contact-details mrl-30">
								<h5 class="icon-box-title mrb-10">{{ __('lang.Phone Number') }}</h5>
								<p class="mrb-0">{{ setting()->phone }}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-xl-4">
						<div class="contact-block d-flex mrb-30">
							<div class="contact-icon">
								<i class="webex-icon-envelope"></i>
							</div>
							<div class="contact-details mrl-30">
								<h5 class="icon-box-title mrb-10">{{ __('lang.Email Us') }}</h5>
								<p class="mrb-0">{{ setting()->email }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	@endforeach()
@endsection