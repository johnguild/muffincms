@extends('muffincms::layouts.admin')

@section('title', 'Editing Text')

@section('content')
<div class="col-lg-12 col-md-12 content-editor">
	<h2>Editing Text</h2>
	<form method="POST" action="{{url('admin/text/update')}}" class="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$mod->id}}">
		<input name="_method" type="hidden" value="POST">

		<div class="form-group form-inline">
			<label for="text-url">Url</label>
			<input type="text" id="text-url" name="url" value="{{old('url', $mod->url)}}" readonly="readonly" class="form-control">	
			
			<label for="text-location">Location</label>
			<input type="text" id="text-location" name="location" value="{{old('location', $mod->location)}}" readonly="readonly" class="form-control">
		</div>

		<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="link-title">Title</label>
			<input type="text" id="link-title" name="title" value="{{old('title', $mod->title)}}" class="form-control">
			@if ($errors->has('title'))
		        <span class="help-block">
		            <strong>{{ $errors->first('title') }}</strong>
		        </span>
		    @endif
		</div>

		<div class="checkbox">
	    	<label>
				<input type="checkbox" name="global" @if(old('global') || $mod->global)checked="checked" @endif> Show on all ({{$mod->location}}) regardless of the url.
		    </label>
		</div>

		<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
			<label for="text-content">Content</label>
			<textarea cols="15" rows="5" id="text-content" class="tinyeditor" name="content">{{old('content', $mod->content)}}</textarea>
			@if ($errors->has('content'))
		        <span class="help-block">
		            <strong>{{ $errors->first('content') }}</strong>
		        </span>
		    @endif
		</div>
		
		<div class="form-group edit-div">
			<input type="submit" name="submit" value="Save" class="btn btn-primary">
			<a href="{{url('/'.$mod->url)}}" id="" class="btn btn-default">Cancel</a>
		</div>
	</form>
</div>
@endsection

@section('script')
	
@endsection