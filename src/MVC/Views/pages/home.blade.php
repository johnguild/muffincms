@extends('layouts.index')

@section('title', ucfirst($appname))

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('css/templates/default/main.css')}}" />
@endsection

@section('content')

    <!-- Header -->
        <header id="header">
            <h1>
                @include('texts.index', ['data' => $modules['Text'], 'loc'=>'nav-title', 'view'=>'show', 'opt'=>0, 'conf'=>1, 'limit'=>1])
            </h1>
            <a href="#nav">Menu</a>
        </header>

    <!-- Nav -->
        <nav id="nav">
            <ul class="links">
                @include('links.list_default', ['data' => $modules['Link'], 'loc'=>'nav-links', 'view'=>'show', 'opt'=>0, 'conf'=>1])
                @if (Auth::guest())
                    <li><a href="/login">Login</a></li>
                    @if(Config::get('muffincms.registration'))
                        <li><a href="/register">Register</a></li>
                    @endif
                @else
                    <li><a href="/dashboard">Dashboard</a>
                @endif
            </ul>
        </nav>

    <!-- Banner -->
        <section id="banner">
            @include('texts.index', ['data' => $modules['Text'], 'loc'=>'banner-text', 'view'=>'show', 'opt'=>1, 'conf'=>0, 'limit'=>1])
            <ul class="actions">
                <li><a href="#" class="button big special">Learn More</a></li>
            </ul>
        </section>

        

    <!-- One -->
        <section id="one" class="wrapper style1">
            <div class="inner">
                @include('divs.index', 
                ['data' => $modules['Div'], 
                    'loc'=>'home-articles', 
                    'view'=>'show', 
                    'opt'=>0, 
                    'conf'=>1])
                <!-- <article class="feature left">
                    <span class="image"><img src="images/pic01.jpg" alt="" /></span>
                    
                </article>
                <article class="feature right">
                    <span class="image"><img src="images/pic02.jpg" alt="" /></span>
                    <div class="content">
                        <h2>Integer vitae libero acrisus egestas placerat  sollicitudin</h2>
                        <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.</p>
                        <ul class="actions">
                            <li>
                                <a href="#" class="button alt">More</a>
                            </li>
                        </ul>
                    </div>
                </article> -->
            </div>
        </section>

    <!-- Two -->
        <section id="two" class="wrapper special">
            <div class="inner">
                <header class="major narrow">
                    <h2>Aliquam Blandit Mauris</h2>
                    <p>Ipsum dolor tempus commodo turpis adipiscing Tempor placerat sed amet accumsan</p>
                </header>
                <div class="image-grid">
                    <a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
                    <a href="#" class="image"><img src="images/pic10.jpg" alt="" /></a>
                </div>
                <ul class="actions">
                    <li><a href="#" class="button big alt">Tempus Aliquam</a></li>
                </ul>
            </div>
        </section>

    <!-- Three -->
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major narrow ">
                    <h2>Magna sed consequat tempus</h2>
                    <p>Ipsum dolor tempus commodo turpis adipiscing Tempor placerat sed amet accumsan</p>
                </header>
                <ul class="actions">
                    <li><a href="#" class="button big alt">Magna feugiat</a></li>
                </ul>
            </div>
        </section>

    <!-- Four -->
        <section id="four" class="wrapper style2 special">
            <div class="inner">
                <header class="major narrow">
                    <h2>Get in touch</h2>
                    <p>Ipsum dolor tempus commodo adipiscing</p>
                </header>
                <form action="#" method="POST">
                    <div class="container 75%">
                        <div class="row uniform 50%">
                            <div class="6u 12u$(xsmall)">
                                <input name="name" placeholder="Name" type="text" />
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <input name="email" placeholder="Email" type="email" />
                            </div>
                            <div class="12u$">
                                <textarea name="message" placeholder="Message" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" class="special" value="Submit" /></li>
                        <li><input type="reset" class="alt" value="Reset" /></li>
                    </ul>
                </form>
            </div>
        </section>

    <!-- Footer -->
        <footer id="footer">
            <div class="inner">
                <ul class="icons">
                    <li><a href="#" class="icon fa-facebook">
                        <span class="label">Facebook</span>
                    </a></li>
                    <li><a href="#" class="icon fa-twitter">
                        <span class="label">Twitter</span>
                    </a></li>
                    <li><a href="#" class="icon fa-instagram">
                        <span class="label">Instagram</span>
                    </a></li>
                    <li><a href="#" class="icon fa-linkedin">
                        <span class="label">LinkedIn</span>
                    </a></li>
                </ul>
                <ul class="copyright">
                    <li>&copy; Untitled.</li>
                    <li>Images: <a href="http://unsplash.com">Unsplash</a>.</li>
                    <li>Design: <a href="http://templated.co">TEMPLATED</a>.</li>
                </ul>
            </div>
        </footer>

@endsection

@section('script')
    <script src="{{asset('js/templates/default/skel.min.js')}}"></script>
    <script src="{{asset('js/templates/default/util.js')}}"></script>
    <script src="{{asset('js/templates/default/main.js')}}"></script>
    <script type="text/javascript">
        var b = document.getElementsByTagName('body');
        b[0].className+="landing";
    </script>
@endsection
		
