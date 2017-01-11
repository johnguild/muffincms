@extends('layouts.index')

@section('title', ucfirst($mypage->name))

@section('content')

	<div class="container col-md-12">
		<!-- text samples -->
		@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@header', 'tpl'=>'show'])
		<hr>
		@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@body', 'tpl'=>'show'])
	</div>

@endsection

@section('script')

@endsection
		
