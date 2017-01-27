@extends('layouts.admin')

@section('title', 'Creating Page')

@section('content')
<div id="page-wrapper">
	<div class="container-fluid">
		<h2>Creating New Page</h2>
		<form method="POST" action="/page/store" class="form">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="page-name">Name</label>
				<input type="text" id="page-name" name="name" value="{{old('name')}}" class="form-control">	
				@if ($errors->has('name'))
					<span class="help-block">
					    <strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group {{ $errors->has('public') ? ' has-error' : '' }}">
				<label for="page-public">Publicity</label>
				<input type="text" id="page-public" name="public" value="{{old('public')}}" class="form-control">	
				@if ($errors->has('public'))
					<span class="help-block">
					    <strong>{{ $errors->first('public') }}</strong>
					</span>
				@endif
			</div>
			
			<div class="form-group edit-div">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				<a href="{{URL::previous()}}" id="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
	
@endsection