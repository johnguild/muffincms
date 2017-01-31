@extends('layouts.edit')

@section('title', 'Creating New Div')

@section('content')
<div class="container">
	<h2>Creating New Div</h2>
	<form method="POST" action="/div/store" class="form">
		{{ csrf_field() }}

		<div class="form-group form-inline">
				<label for="div-url">Url</label>
				<input type="div" id="div-url" name="url" value="{{old('url', $url)}}" readonly="readonly" class="form-control">	
				<label for="div-location">Location</label>
				<input type="div" id="div-location" name="location" value="{{old('location', $location)}}" readonly="readonly" class="form-control">
		</div>

		<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="div-title">Title</label>
			<input type="text" id="div-title" name="title" value="{{old('title')}}" class="form-control">
			@if ($errors->has('title'))
				<span class="help-block">
				    <strong>{{ $errors->first('title') }}</strong>
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