<footer class="footer">
	<div class="container">
	  <div class="row">
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