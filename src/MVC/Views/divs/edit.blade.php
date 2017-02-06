@extends('layouts.edit')

@section('title', 'Editing Div')

@section('content')
<div class="container">
	<h2>Editing Div</h2>
	<form method="POST" action="/div/update" class="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$div->id}}">

		<div class="form-group form-inline">
				<label for="div-url">Url</label>
				<input type="div" id="div-url" name="url" value="{{old('url', $div->url)}}" readonly="readonly" class="form-control">	
				<label for="div-location">Location</label>
				<input type="div" id="div-location" name="location" value="{{old('locations', $div->location)}}" readonly="readonly" class="form-control">
		</div>

		<div class="checkbox">
	    	<label>
				<input type="checkbox" name="global" @if(old('global') || $div->global)checked="checked" @endif> Show on all ({{$div->location}}) regardless of the url.
		    </label>
		</div>

		<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="div-title">Title</label>
			<input type="text" id="div-title" name="title" value="{{old('title', $div->title)}}" class="form-control">
			@if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
      @endif
		</div>

	  <div class="form-group">
		  <div class="input-group">
	      <span class="input-group-btn">
	        <a id="img-picker" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
	          <i class="fa fa-picture-o"></i> Choose Image
	        </a>
	      </span>
	      <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', $div->image)}}">
	    </div>
	    <img id="holder" style="margin-top:15px;max-height:100px;" src="{{old('image', $div->image)}}">
		</div>

		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="{{old('url', $div->url)}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')

@endsection