@extends('layouts.index')

@section('title', ucfirst($mypage->name))

@section('content')

	<div class="container col-md-12">
		<!-- text samples -->
		<div class="container">
			<div class="col-lg-12">
				@include('texts.index', ['data' => $modules['Text'], 'loc'=>'main-message', 'view'=>'show', 'opt'=>1, 'conf'=>0])
			</div>
		</div>
	</div>

@endsection

@section('script')

@endsection
		
