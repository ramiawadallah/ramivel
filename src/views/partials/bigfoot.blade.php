<!-- end content-section -->
	<footer class="footer" style="padding-top: 50px !important;">
		<div class="container">
		  <div class="row">
		    <div class="col-lg-10">
		      <div class="work-with-us">
		        <h6>Let's start to work together</h6>
		        <h2>Don't be <span>stranger</span> to talk to us?</h2>
		        <a href="{{ url('contact-us') }}" class="custom-btn">
		        <svg>
		          <rect width="218" height="56" x="1" y="1" rx="0" fill="none" stroke="#ffffff"></rect>
		        </svg>
		        <span>WORK WITH US</span> </a> </div>
		      <!-- end work-with-us --> 
		    </div>
		    <!-- end col-10 -->
		    <div class="col-lg-4">
		      <address>
		      <small>Address</small>
		      <p>{{ setting()->address }}</p>
		      </address>
		    </div>
		    <!-- end col-4 -->
		    <div class="col-lg-4 col-md-6">
		      <address>
		      <small>Phone</small>
		      <p>{{ setting()->phone }}</p>
		      </address>
		    </div>
		    <!-- end col-4 -->
		    <div class="col-lg-4 col-md-6">
		      <address>
		      <small>E-mail</small>
		      <p>{{ setting()->email }}</p>
		      </address>
		    </div>
		    <!-- end col-4 -->
		    <div class="col-12"> </div>
		    <!-- end col-12 -->
		    <div class="col-12">
		      <div class="footer-bottom"> <span>© 2021 {{ setting()->trans('title') }} |  By Rami Awadallah</span>
		        <ul class="footer-menu">
		        	@foreach(\App\Models\Page::where('status','active')->get() as $pageFooter)
		          	<li><a href="{{ $pageFooter->uri }}" data-text="{{ $pageFooter->trans('title') }}">{{ $pageFooter->trans('title') }}</a></li>
		          @endforeach
		        </ul>
		      </div>
		      <!-- end footer-bottom --> 
		    </div>
		    <!-- end col-12 --> 
		  </div>
		  <!-- end row --> 
		</div>
		<!-- end container --> 
	</footer>
<!-- end footer --> 