@extends('layouts.edit')

@section('title', 'Creating New Image')

@section('content')
<div class="container">
	<h2>Creating New Image</h2>
	<form method="POST" action="/image/store" class="form">
		{{ csrf_field() }}

		<div class="form-group form-inline">
				<label for="image-url">Url</label>
				<input type="text" id="image-url" name="url" value="{{old('url', $url)}}" readonly="readonly" class="form-control">	
				<label for="image-location">Location</label>
				<input type="text" id="image-location" name="location" value="{{old('location', $location)}}" readonly="readonly" class="form-control">
		</div>

		<img id="holder" style="margin-top:15px;max-height:240px;" src="{{old('image')}}">
	    <br>
	  	<div class="input-group">
	      	<span class="input-group-btn">
	        	<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
	          		<i class="fa fa-picture-o"></i> Choose Image
	        	</a>
	      	</span>
	      	<input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image')}}">
	    </div>
	    	


		<div class="form-group{{ $errors->has('alt') ? ' has-error' : '' }}">
			<label for="image-alt">Alt</label>
			<input type="text" id="image-alt" name="alt" value="{{old('alt')}}" class="form-control">
			@if ($errors->has('alt'))
		        <span class="help-block">
		            <strong>{{ $errors->first('alt') }}</strong>
		        </span>
		    @endif
		</div>

		<div class="checkbox">
	    	<label>
				<input type="checkbox" name="global" @if(old('global'))checked="checked" @endif> Show on all ({{$location}}) regardless of the url.
		    </label>
		</div>

		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="/{{$url}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#lfm').filemanager('image');
    });
  </script>
@endsection