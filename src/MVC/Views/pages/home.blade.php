@extends('muffincms::layouts.index')

@section('title', ucfirst($mypage->name))

@section('meta')
    <meta name="description" content="{{$mypage->desc}}">
    <meta name="muffin-url" content="{{$url}}">
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
                    <a class="navbar-brand" href="#page-top">@include('muffincms::modules.text', 
                                                                ['data'=>$modules['text'], 
                                                                'loc'=>'webname',
                                                                'limit'=>1,
                                                                'mess'=>'website-name'])</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        @include('muffincms::modules.link', 
                                        ['data'=>$modules['link'], 
                                        'loc'=>'nav-link',
                                        'wrapbegin'=>"<li class='page-scroll'>",
                                        'wrapend'=>"</li>"])
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Header -->
        <header>
            <div class="container" id="maincontent" tabindex="-1">
                <div class="row">
                    <div class="col-lg-12">
                        @include('muffincms::modules.image', 
                                            ['data'=>$modules['image'], 
                                            'loc'=>'logo',
                                            'limit'=>1,
                                            'mess'=>'logo'])
                        <div class="intro-text">
                            <h1 class="name">@include('muffincms::modules.text', 
                                                                ['data'=>$modules['text'], 
                                                                'loc'=>'webname',
                                                                'limit'=>1,
                                                                'mess'=>'website-name'])</h1>
                            <hr class="star-light">
                            <span class="skills">@include('muffincms::modules.text', 
                                                                ['data'=>$modules['text'], 
                                                                'loc'=>'header'])</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Portfolio Grid Section -->
        <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Portfolio</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    @php $pf = 1; @endphp
                    @while($pf <= 6)
                        <div class="col-sm-4 portfolio-item">
                            <a href="#portfolioModal{{$pf}}" class="portfolio-link" data-toggle="modal">
                                <div class="caption">
                                    <div class="caption-content">
                                        <i class="fa fa-search-plus fa-3x"></i>
                                    </div>
                                </div>
                                @include('muffincms::modules.image', 
                                                ['data'=>$modules['image'], 
                                                'loc'=>'portfolio-'.$pf,
                                                'limit'=>1,
                                                'mess'=>'Add photo for portfolio '.$pf,
                                                'addclass'=>'pull-left'])
                            </a>
                        </div>
                        @php $pf++; @endphp
                    @endwhile
                    
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="success" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>ABOUT</h2>
                        <hr class="star-light">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-2">
                        @include('muffincms::modules.text', 
                                            ['data'=>$modules['text'], 
                                            'loc'=>'about-1',
                                            'limit'=>1])
                    </div>
                    <div class="col-lg-4">
                        @include('muffincms::modules.text', 
                                            ['data'=>$modules['text'], 
                                            'loc'=>'about-2',
                                            'limit'=>1])
                    </div>
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <a href="#" class="btn btn-lg btn-outline">
                            <i class="fa fa-download"></i> Download Theme
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Contact Me</h2>
                        <hr class="star-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                        <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                        <form name="sentMessage" id="contactForm" novalidate>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label for="message">Message</label>
                                    <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-success btn-lg">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">
                            @include('muffincms::modules.text', 
                                            ['data'=>$modules['text'], 
                                            'loc'=>'footer-1',
                                            'limit'=>1])
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
                            @include('muffincms::modules.text', 
                                            ['data'=>$modules['text'], 
                                            'loc'=>'footer-3',
                                            'limit'=>1])
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('muffincms::modules.text', 
                                            ['data'=>$modules['text'], 
                                            'loc'=>'copyright',
                                            'limit'=>1])
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
    
        <!-- Portfolio Modals -->
        @php $pf = 1; @endphp
        @while($pf <= 6)
            <div class="portfolio-modal modal fade" id="portfolioModal{{$pf}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body">
                                    @include('muffincms::modules.text', 
                                                ['data'=>$modules['text'], 
                                                'loc'=>'portfolio-'.$pf.'-title',
                                                'limit'=>1,
                                                'mess'=>'Add title'])
                                    <hr class="star-primary">
                                    @include('muffincms::modules.image', 
                                                ['data'=>$modules['image'], 
                                                'loc'=>'portfolio-'.$pf,
                                                'limit'=>1])
                                    @include('muffincms::modules.text', 
                                                ['data'=>$modules['text'], 
                                                'loc'=>'portfolio-'.$pf.'-content',
                                                'limit'=>1,
                                                'mess'=>'Add content'])
                                    <ul class="list-inline item-details">
                                        <li>Client:
                                            <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                            </strong>
                                        </li>
                                        <li>Date:
                                            <strong><a href="http://startbootstrap.com">April 2014</a>
                                            </strong>
                                        </li>
                                        <li>Service:
                                            <strong><a href="http://startbootstrap.com">Web Development</a>
                                            </strong>
                                        </li>
                                    </ul>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php $pf++; @endphp
        @endwhile

        
        
    </div>
    

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{asset('vendor/muffincms/template/js/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('vendor/muffincms/template/js/contact_me.js')}}"></script>
    <script src="{{asset('vendor/muffincms/template/js/freelancer.min.js')}}"></script>
    
@endsection
		
