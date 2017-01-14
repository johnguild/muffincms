@extends('layouts.edit')

@section('title', 'Edit Text')

@section('content')
<div class="container">
	<h2>Editing Text</h2>
	<form method="POST" action="/text/update" class="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$text->id}}">

		<div class="form-group">
			<label for="text-url-location">Location</label>
			<input type="text" id="text-url-location" name="url_location" value="{{$text->url.$text->location}}" readonly="readonly" class="form-control">
		</div>

		<div class="form-group">
			<label for="text-content">Content</label>
			<textarea cols="15" rows="5" id="text-content" class="ckeditor" name="content">{{$text->content}}</textarea>
		</div>
		
		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="{{url()->previous()}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')
	
@endsection