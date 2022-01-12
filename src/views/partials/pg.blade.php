@if ($paginator->hasPages())
	@if ($paginator->onFirstPage())
	@else
		<li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">PREV</a> </li>
	@endif

	 <!-- @foreach ($elements as $element)
    	@if (is_string($element))
    		<div class="page-item">
            	<a href="page-link">{{ $element }}</a>
            </div>
        @endif

    	@if (is_array($element))
        	@foreach ($element as $page => $url)
            	@if ($page == $paginator->currentPage())
            		<div class="page-item"><a class="page-link" href="">{{ $page }}</a></div>
        		@else
        			<div class="page-item">
        				<a class="page-link" href="{{ $url }}">{{ $page }}
        				</a>
        			</div>
        		@endif
        	@endforeach
        @endif
   	@endforeach
 -->
	@if ($paginator->hasMorePages())
		<li class="page-item"> <a class="page-link" href="{{ $paginator->nextPageUrl() }}">NEXT</a> </li>
	@else

	@endif
@endif


<!-- @if ($paginator->hasPages())
	<div class="w-full mx-auto my-4 bg-white p-5 text-sm 2 rounded-xl">
	  <div class="flex justify-center space-x-4">
	    	@if ($paginator->onFirstPage())
	        <div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
	        	<a href="">
		            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
		                <polyline points="15 18 9 12 15 6"></polyline>
		            </svg>
		        </a>
	        </div>
	        @else
			<div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
	        	<a class="w-full h-full flex justify-center items-center" href="{{ $paginator->previousPageUrl() }}">
		            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
		                <polyline points="15 18 9 12 15 6"></polyline>
		            </svg>
		        </a>
	        </div>	        
	        @endif

	        <div class="flex h-8 font-medium rounded-full bg-gray-200">
	            @foreach ($elements as $element)
	            	@if (is_string($element))
	            		<div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full bg-pink-600 text-white ">
		                	<a href="#">{{ $element }}</a>
		                </div>
		            @endif

	            	@if (is_array($element))
		            	@foreach ($element as $page => $url)
	                    	@if ($page == $paginator->currentPage())
	                    		<div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full bg-pink-600 text-white">{{ $page }}</div>
		            		@else
		            			<div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full">
		            				<a class="w-full h-full flex justify-center items-center" href="{{ $url }}">{{ $page }}
		            				</a>
		            			</div>
		            		@endif
		            	@endforeach
		            @endif
	           	@endforeach
	        </div>

	        @if ($paginator->hasMorePages())
		        <div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
		        	<a class="w-full h-full flex justify-center items-center" href="{{ $paginator->nextPageUrl() }}">
			            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
			                <polyline points="9 18 15 12 9 6"></polyline>
			            </svg>
			        </a>
		        </div>
		    @else
		    	<div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
		            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
		                <polyline points="9 18 15 12 9 6"></polyline>
		            </svg>
		        </div>
	        @endif

	    </div>
	</div>
@endif() -->