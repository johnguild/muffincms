@extends('layouts.edit')

@section('title', 'Edit Link')

@section('content')
<!-- <pre>
{{print_r($link)}}
</pre> -->
<div class="container">
	<h2>Editing Link</h2>
	<form method="POST" action="/link/update" class="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$link->id}}">

		<div class="form-group form-inline">
				<label for="link-url">Url</label>
				<input type="link" id="link-url" name="url" value="{{old('url', $link->url)}}" readonly="readonly" class="form-control">	
				<label for="link-location">Location</label>
				<input type="link" id="link-location" name="location" value="{{old('locations', $link->location)}}" readonly="readonly" class="form-control">
		</div>

		<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="link-title">Title</label>
			<input type="text" id="link-title" name="title" value="{{old('title', $link->title)}}" class="form-control">
			@if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
      @endif
		</div>

		<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
			<label for="link-address">Address</label>
			<input type="text" id="link-address" name="address" value="{{old('address', $link->address)}}" class="form-control">
			@if ($errors->has('address'))
        <span class="help-block">
            <strong>{{ $errors->first('address') }}</strong>
        </span>
      @endif
		</div>
		
		<div class="form-group{{ $errors->has('alt') ? ' has-error' : '' }}">
			<label for="link-alt">Alt</label>
			<input type="text" id="link-alt" name="alt" value="{{old('alt', $link->alt)}}" class="form-control">
			@if ($errors->has('alt'))
        <span class="help-block">
            <strong>{{ $errors->first('alt') }}</strong>
        </span>
      @endif
		</div>

		<div class="checkbox">
    	<label>
				<input type="checkbox" name="new_window" @if(old('new_window') || $link->new_window)checked="checked" @endif> Open on new window
	    </label>
	  </div>

	  <div class="form-group">
		  <div class="input-group">
	      <span class="input-group-btn">
	        <a id="img-picker" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
	          <i class="fa fa-picture-o"></i> Choose Image
	        </a>
	      </span>
	      <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', $link->image)}}">
	    </div>
	    <img id="holder" style="margin-top:15px;max-height:100px;" src="{{old('image', $link->image)}}">
		</div>

		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="{{old('url', $link->url)}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')

@endsection