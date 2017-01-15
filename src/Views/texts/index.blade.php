@if(Auth::check() && Auth::user()->isAdmin())
	<div class="w-add text-center">
		<a href="/text/create/url/{{$mypage->name}}/location/{{$loc}}" class="btn btn-warning">Add new text on {{$loc}}</a>
	</div>
@endif
@foreach($data as $text)
	@if($text->location == $loc)
		@if(Auth::check() && Auth::user()->isAdmin())
		<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif @if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
			@if($conf)
				<div class="dropdown pull-right">
					<a href="#" class="@if($conf==2)conf-hvr-btn @elseif($conf==1)conf-btn @endif pull-right">
						<i class="fa fa-cog" aria-hidden=true></i>
					</a>
					<ul class="submenu pull-right">
						<li><a href="#">Configure</a></li>
					</ul>
				</div>
			@endif
		@endif
			@include('texts.'.$view, $text)
		@if(Auth::check() && Auth::user()->isAdmin())
			@if($opt)
				<div class="opt-div">
					<a href="/text/edit/{{$text->id}}" class="btn btn-info">
						<i class="fa fa-pencil-square-o" aria-hidden=true></i>
						edit
					</a>
					<a href="/text/delete/{{$text->id}}" class="btn btn-danger delete">
						<i class="fa fa-times" aria-hidden=true></i>
						delete
					</a>
					<div class="clear"></div>
				</div>
			@endif
		</div>
		@endif
	@endif
@endforeach