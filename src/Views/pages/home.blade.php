@extends('layouts.index')

@section('title', ucfirst($mypage->name))

@section('content')

	<div class="container col-md-12 text-center">

		<h1>This is your homepage</h1>
		@if (Auth::guest())
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Register</a>
    @else
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->firstname }} <span class="caret"></span>
        </a>
        <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif
	</div>

@endsection

@section('script')

@endsection
		
