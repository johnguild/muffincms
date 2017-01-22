@if(Auth::check() && Auth::user()->isAdmin())
	@include('modules.add', ['mod'=>'text', 'add'=>'/url/'.$mypage->name.'/location/'.$loc, 'mess'=>"Add new text on ".$loc])
@endif
@foreach($data as $text)
	@if($text->location == $loc)
		@if(Auth::check() && Auth::user()->isAdmin())
		<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif @if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
			@if($conf)
				@include('modules.conf', ['mod'=>'text', 'id'=>$text->id, 'conf'=>$conf])
			@endif
		@endif
			@include('texts.'.$view, $text)
		@if(Auth::check() && Auth::user()->isAdmin())
			@if($opt)
				@include('modules.opt', ['mod'=>'text', 'id'=>$text->id, 'opt'=>$opt])
			@endif
		</div>
		@endif
	@endif
@endforeach