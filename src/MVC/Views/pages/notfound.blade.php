@extends('muffincms::layouts.index')

@section('title', ucfirst(unSlug(mypage()->name)))

@section('meta')
    <meta name="description" content="{{mypage()->desc}}">
    <meta name="muffin-url" content="{{mypage()->name}}">
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('vendor/muffincms/template/css/freelancer.min.css')}}" />
@endsection

@section('content')
    <div id="page-top">

        <div id="skipnav"><a href="#maincontent">Skip to main content</a></div>

        <!-- Navigation -->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#page-top">@include('muffincms::modules.text', ['loc'=>'webname','limit'=>1,'mess'=>'website-name'])</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        @include('muffincms::modules.link', ['loc'=>'nav-link','wrapbegin'=>"<li class='page-scroll'>",'wrapend'=>"</li>"])
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

      	 <!-- Header -->
        <header>
            <div class="container" tabindex="-1">
                <div class="row">
                    <div class="col-lg-12">
                        @include('muffincms::modules.text', ['loc'=>'notfound-message','limit'=>1,'mess'=>'message'])
                    </div>
                </div>
            </div>
        </header>


        <!-- Footer -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">
                            @include('muffincms::modules.text', ['loc'=>'footer-1','limit'=>1])
                        </div>
                        <div class="footer-col col-md-4">
                            <h3>Around the Web</h3>
                            <ul class="list-inline">
                                <li>
                                    <a href="#" class="btn-social btn-outline"><span class="sr-only">Facebook</span><i class="fa fa-fw fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><span class="sr-only">Google Plus</span><i class="fa fa-fw fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><span class="sr-only">Twitter</span><i class="fa fa-fw fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><span class="sr-only">Linked In</span><i class="fa fa-fw fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn-social btn-outline"><span class="sr-only">Dribble</span><i class="fa fa-fw fa-dribbble"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-col col-md-4">
                            @include('muffincms::modules.text', ['loc'=>'footer-3','limit'=>1])
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('muffincms::modules.text', ['loc'=>'copyright','limit'=>1])
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{asset('vendor/muffincms/template/js/freelancer.min.js')}}"></script>
@endsection