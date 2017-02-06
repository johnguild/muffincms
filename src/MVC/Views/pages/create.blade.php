@extends('layouts.admin')

@section('title', 'Creating New Page')

@section('content')
<div id="page-wrapper">
	<div class="container-fluid">
		<h2>Creating New Page</h2>
		<form method="POST" action="/page/store" class="form">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="page-name">Name</label>
				<input type="text" id="page-name" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter url of the page ex. about-us">	
				@if ($errors->has('name'))
					<span class="help-block">
					    <strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="checkbox">
		    	<label>
					<input type="checkbox" name="public" @if(old('public'))checked="checked" @endif> Open to public
			    </label>
			</div>

			<div class="form-group">
			    <label for="page-template">Select a template</label>
			    <select class="form-control" id="page-template" name="template">
			      @foreach($templates as $tpl)
			      	<option value="{{$tpl}}" {{(old('template') == $tpl ? "selected":"") }}>{{$tpl}}</option>
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