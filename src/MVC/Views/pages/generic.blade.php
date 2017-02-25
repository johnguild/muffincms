@extends('layouts.index')

@section('title', ucfirst($mypage->name))

@section('meta')
    <meta name="description" content="{{$mypage->desc}}">
@endsection

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
                    <li><a href="/register">Register</a></li>
                @else
                    <li><a href="/dashboard">Dashboard</a>
                @endif
            </ul>
        </nav>

    <!-- Main -->
        <section id="main" class="wrapper">
            <div class="container">

                <header class="major special">
                    <h2>Generic</h2>
                    <p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
                </header>

                <a href="#" class="image fit"><img src="images/pic11.jpg" alt="" /></a>
                <p>Vis accumsan feugiat adipiscing nisl amet adipiscing accumsan blandit accumsan sapien blandit ac amet faucibus aliquet placerat commodo. Interdum ante aliquet commodo accumsan vis phasellus adipiscing. Ornare a in lacinia. Vestibulum accumsan ac metus massa tempor. Accumsan in lacinia ornare massa amet. Ac interdum ac non praesent. Cubilia lacinia interdum massa faucibus blandit nullam. Accumsan phasellus nunc integer. Accumsan euismod nunc adipiscing lacinia erat ut sit. Arcu amet. Id massa aliquet arcu accumsan lorem amet accumsan.</p>
                <p>Amet nibh adipiscing adipiscing. Commodo ante vis placerat interdum massa massa primis. Tempus condimentum tempus non ac varius cubilia adipiscing placerat lorem turpis at. Aliquet lorem porttitor interdum. Amet lacus. Aliquam lobortis faucibus blandit ac phasellus. In amet magna non interdum volutpat porttitor metus a ante ac neque. Nisi turpis. Commodo col. Interdum adipiscing mollis ut aliquam id ante adipiscing commodo integer arcu amet Ac interdum ac non praesent. Cubilia lacinia interdum massa faucibus blandit nullam. Accumsan phasellus nunc integer. Accumsan euismod nunc adipiscing lacinia erat ut sit. Arcu amet. Id massa aliquet arcu accumsan lorem amet accumsan commodo odio cubilia ac eu interdum placerat placerat arcu commodo lobortis adipiscing semper ornare pellentesque.</p>
                <p>Amet nibh adipiscing adipiscing. Commodo ante vis placerat interdum massa massa primis. Tempus condimentum tempus non ac varius cubilia adipiscing placerat lorem turpis at. Aliquet lorem porttitor interdum. Amet lacus. Aliquam lobortis faucibus blandit ac phasellus. In amet magna non interdum volutpat porttitor metus a ante ac neque. Nisi turpis. Commodo col. Interdum adipiscing mollis ut aliquam id ante adipiscing commodo integer arcu amet blandit adipiscing arcu ante.</p>

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
@endsection
		
