@extends('muffincms::layouts.admin')

@section('title', 'Creating Link')

@section('content')
<div class="col-lg-12 col-md-12 content-editor">
	<h2>Creating New Link</h2>
	<hr>
	<form method="POST" action="{{url('/admin/link/store')}}" class="form">
		{{ csrf_field() }}

		<div class="form-group form-inline">
			<label for="link-url">Url</label>
			<input type="text" id="link-url" name="url" value="{{old('url', $url)}}" readonly="readonly" class="form-control">	
			<label for="link-location">Location</label>
			<input type="text" id="link-location" name="location" value="{{old('location', $location)}}" readonly="readonly" class="form-control">
		</div>



		<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="link-title">Title</label>
			<input type="text" id="link-title" name="title" value="{{old('title')}}" placeholder="title" class="form-control">
			@if ($errors->has('title'))
		        <span class="help-block">
		            <strong>{{ $errors->first('title') }}</strong>
		        </span>
		    @endif
		</div>

		<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
			<label for="link-address">Address</label>
			<input type="text" id="link-address" name="address" value="{{old('address')}}" placeholder="address" class="form-control">
			@if ($errors->has('address'))
			    <span class="help-block">
			        <strong>{{ $errors->first('address') }}</strong>
			    </span>
			@endif
		</div>
		
		<div class="form-group{{ $errors->has('alt') ? ' has-error' : '' }}">
			<label for="link-alt">Alt</label>
			<input type="text" id="link-alt" name="alt" value="{{old('alt')}}" placeholder="alt" class="form-control">
			@if ($errors->has('alt'))
		        <span class="help-block">
		            <strong>{{ $errors->first('alt') }}</strong>
		        </span>
		    @endif
		</div>

		<div class="input-group">
	      	<span class="input-group-btn">
		        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
		          <i class="fa fa-picture-o"></i> Choose Image
		        </a>
	      	</span>
	      	<input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image')}}">
	    </div>
    
    	<img id="holder" style="margin-top:15px;max-height:100px;" src="{{old('image')}}">
		<br>
		
		<div class="checkbox">
	    	<label>
				<input type="checkbox" name="global" @if(old('global'))checked="checked" @endif> Show on all ({{$location}}) regardless of the url.
		    </label>
		</div>

		<div class="checkbox">
	    	<label>
					<input type="checkbox" name="new_window" @if(old('new_window'))checked="checked" @endif> Open on new window
		    </label>
	  	</div>

	  	
		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="{{url('/')}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#lfm').filemanager('image');
});
</script>
@endsection
