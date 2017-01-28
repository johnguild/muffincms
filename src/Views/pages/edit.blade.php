@extends('layouts.admin')

@section('title', 'Editing '.$page->name)

@section('content')
<div id="page-wrapper">
	<div class="container-fluid">
		<h2>Editing {{ucfirst($page->name)}}</h2>
		<form method="POST" action="/page/update" class="form">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$page->id}}">

			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="page-name">Name</label>
				<input type="text" id="page-name" name="name" value="{{old('name', $page->name)}}" class="form-control" placeholder="{{$page->name}}">	
				@if ($errors->has('name'))
					<span class="help-block">
					    <strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="checkbox">
		    	<label>
					<input type="checkbox" name="public" @if(old('public') || $page->public)checked="checked" @endif> Open to public
			    </label>
			</div>

			<div class="form-group">
			    <label for="page-template">Select a template</label>
			    <select class="form-control" id="page-template" name="template">
			      @foreach($templates as $tpl)
			      	<option value="{{$tpl}}" {{(old('template', $page->template) == $tpl ? "selected":"") }}>{{$tpl}}</option>
			      @endforeach
			    </select>
			  </div>
			
			<div class="form-group edit-div">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				<a href="/admin/pages" id="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
	
@endsection