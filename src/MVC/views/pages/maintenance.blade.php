@extends('muffincms::layouts.index')

@section('title', ucfirst(unSlug(mypage()->name)))

@section('meta')
    <meta name="description" content="{{mypage()->desc}}">
    <meta name="muffin-url" content="{{mypage()->name}}">
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('vendor/muffincms/template/css/freelancer.min.css')}}" />
    <style type="text/css">
    	#maintenance{
			height: 100%;
			min-height: 600px;
    	}
    </style>
@endsection

@section('content')
    <!-- <div id="page-top"> -->

        <!-- About Section -->
        <section class="success" id="maintenance">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>@include('muffincms::modules.text', [
                        							'loc'=>'maintenance-title',
                        							'limit'=>1,
                        							'mess'=>'Maintenance Greetings'])</h2>
                    </div>
                </div>
                <div class="row">
                    @include('muffincms::modules.text', ['loc'=>'maintenance-message','limit'=>1,'mess'=>'Your message'])
                </div>
            </div>
        </section>

    <!-- </div> -->

@endsection

@section('script')
    <script src="{{asset('vendor/muffincms/template/js/freelancer.min.js')}}"></script>
@endsection