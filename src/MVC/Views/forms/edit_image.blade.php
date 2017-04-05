@extends('muffincms::layouts.admin')

@section('title', 'Editing Image')

@section('content')
<div class="col-lg-12 col-md-12 content-editor">
	<h2>Editing Image</h2>
	<form method="POST" action="{{url('admin/image/update')}}" class="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$mod->id}}">
		<input name="_method" type="hidden" value="POST">

		<div class="form-group form-inline">
				<label for="image-url">Url</label>
				<input type="text" id="image-url" name="url" value="{{old('url', $mod->url)}}" readonly="readonly" class="form-control">	
				<label for="image-location">Location</label>
				<input type="text" id="image-location" name="location" value="{{old('location', $mod->location)}}" readonly="readonly" class="form-control">
		</div>

		<img id="holder" style="margin-top:15px;max-height:240px;" src="{{old('image', $mod->image)}}">
		<div class="form-group">
		  	<div class="input-group">
		      	<span class="input-group-btn">
		        	<a id="img-picker" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
		          		<i class="fa fa-picture-o"></i> Choose Image
		        	</a>
		      	</span>
		      	<input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', $mod->image)}}">
		    </div>
		</div>
		
		<div class="form-group{{ $errors->has('alt') ? ' has-error' : '' }}">
			<label for="image-alt">Alt</label>
			<input type="text" id="image-alt" name="alt" value="{{old('alt', $mod->alt)}}" class="form-control">
			@if ($errors->has('alt'))
		        <span class="help-block">
		            <strong>{{ $errors->first('alt') }}</strong>
		        </span>
		    @endif
		</div>

		<div class="checkbox">
	    	<label>
				<input type="checkbox" name="global" @if(old('global') || $mod->global)checked="checked" @endif> Show on all ({{$mod->location}}) regardless of the url.
		    </label>
		</div>


		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			<a href="{{url('/'.$mod->url)}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')

@endsection