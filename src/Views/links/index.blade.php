@if(Auth::check() && Auth::user()->isAdmin())
	@include('modules.add', ['mod'=>'link', 'add'=>'/url/'.$mypage->name.'/location/'.$loc, 'mess'=>"Add new link on ".$loc])
@endif
@foreach($data as $link)
	@if($link->location == $loc)
		@if(Auth::check() && Auth::user()->isAdmin())
		<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif @if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
			@if($conf)
				@include('modules.conf', ['mod'=>'link', 'id'=>$link->id, 'conf'=>$conf])
			@endif
		@endif
			@include('links.'.$view, $link)
		@if(Auth::check() && Auth::user()->isAdmin())
			@if($opt)
				@include('modules.opt', ['mod'=>'link', 'id'=>$link->id, 'opt'=>$opt])
			@endif
		</div>
		@endif
	@endif
@endforeach