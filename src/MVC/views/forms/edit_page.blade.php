@extends('muffincms::layouts.admin')

@section('title', 'Editing Page '.$mod->name)

@section('content')
<div id="page-wrapper">
	<div class="container-fluid">
		<h2>Editing Page {{$mod->name}}</h2>
		<hr>
		<form method="POST" action="{{url('admin/page/update')}}" class="form">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$mod->id}}">
			<input name="_method" type="hidden" value="POST">

			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="page-name">Name/URL</label>
				<input type="text" id="page-name" name="name" value="{{old('name', $mod->name)}}" class="form-control" placeholder="{{$mod->name}}">	
				@if ($errors->has('name'))
					<span class="help-block">
					    <strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
				<label for="page-desc">Description</label>
				<textarea cols="15" rows="5" id="page-desc" class="tinyeditor" name="desc">{{old('desc', $mod->desc)}}</textarea>
				@if ($errors->has('desc'))
			        <span class="help-block">
			            <strong>{{ $errors->first('desc') }}</strong>
			        </span>
			    @endif
			</div>

			<div class="form-group">
			    <label for="page-template">Select a template</label>
			    <select class="form-control" id="page-template" name="template">
			      @foreach($templates as $tpl)
			      	<option value="{{$tpl}}" {{(old('template', $mod->template) == $tpl ? "selected":"") }}>{{$tpl}}</option>
			      @endforeach
			    </select>
			</div>

			<div class="checkbox">
		    	<label>
					<input type="checkbox" name="public" @if(old('public') || $mod->public)checked="checked" @endif> Open to public
			    </label>
			</div>
			
			<div class="form-group edit-div">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				<a href="{{url('/admin/pages')}}" id="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
	
@endsection