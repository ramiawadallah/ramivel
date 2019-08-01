@if (session()->has('message') || session()->has('status'))
    <div class="alert alert-success">{{ session()->get('message') }}</div>
@endif

@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
    	<script type="text/javascript">
    		One.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: '{{ $error }}'});
    	</script>
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif