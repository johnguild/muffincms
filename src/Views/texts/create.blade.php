@extends('layouts.edit')

@section('title', 'Creating Text')

@section('content')
<div class="container">
	<h2>Editing Text</h2>
	<form method="POST" action="/text/store" class="form">
		{{ csrf_field() }}

		<div class="form-group form-inline">
			<label for="text-url-location">Url</label>
			<input type="text" id="text-url-location" name="url" value="{{$url}}" readonly="readonly" class="form-control">	
			
			<label for="text-url-location">Location</label>
			<input type="text" id="text-url-location" name="location" value="{{$location}}" readonly="readonly" class="form-control">
		</div>

		<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
			<label for="text-content">Content</label>
			<textarea cols="15" rows="5" id="text-content" class="ckeditor" name="content">{{old('content')}}</textarea>
			@if ($errors->has('content'))
        <span class="help-block">
            <strong>{{ $errors->first('content') }}</strong>
        </span>
      @endif
		</div>
		
		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="/{{$url}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')
	
@endsection