@extends('layouts.index')

@section('title', ucfirst($mypage->name))

@section('content')

	<div class="container col-md-12">
		<!-- text samples -->
		<div class="container">
			<div class="col-md-4">
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'@header', 'view'=>'show', 'opt'=>1, 'conf'=>1])
			</div>
			<div class="col-md-4">
				@include('links.index', ['data' => $modules['Link'], 'loc'=>'@header', 'view'=>'show', 'opt'=>1, 'conf'=>1])
			</div>
		</div>
	</div>

@endsection

@section('script')

@endsection
		
