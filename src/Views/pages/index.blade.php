@extends('layouts.index')

@section('title', ucfirst($mypage->name))

@section('content')

	<div class="container col-md-12">
		<!-- text samples -->
		<div class="container">
			<div class="col-md-4">
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@header', 'view'=>'show', 'opt'=>0, 'conf'=>0])
			</div>
			<div class="col-md-4">
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@header', 'view'=>'show', 'opt'=>1, 'conf'=>1])
			</div>
			<div class="col-md-4">
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@header', 'view'=>'show', 'opt'=>2, 'conf'=>2])
			</div>
		</div>

		<hr>
		<div class="container">
			<div class="col-md-4">	
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@body', 'view'=>'show', 'opt'=>0, 'conf'=>0])
			</div>
			<div class="col-md-4">	
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@body', 'view'=>'show', 'opt'=>1, 'conf'=>1])
			</div>
			<div class="col-md-4">	
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@body', 'view'=>'show', 'opt'=>2, 'conf'=>2])
			</div>
		</div>
	</div>

@endsection

@section('script')

@endsection
		
