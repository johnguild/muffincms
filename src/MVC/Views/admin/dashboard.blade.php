@extends('muffincms::layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="col-lg-12 col-md-12 content-editor dashboard">
	<h1>Dashboard</h1>
	
	<div class="row">
		<div class="col-md-4 text-center">
            <div class="box">
                <div class="box-content">
                    <h3 class="tag-title">Pages</h3>
                    <hr />
                    <p>Total Pages: {{$pages['count']}}</p>
                    <p>Public Pages: {{$pages['public']}}</p>
                    <p>Private Pages: {{$pages['private']}}</p>
                    <a href="{{url('/admin/pages')}}" class="btn btn-block btn-primary">See All</a>
                </div>
            </div>
        </div>

	</div>
</div>
@endsection

@section('script')

@endsection
