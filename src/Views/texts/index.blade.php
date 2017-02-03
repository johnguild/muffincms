@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && count(array_filter($data->toArray(),function($data) use($loc){return $data['location'] == $loc;})) < $limit))
		@include('modules.add', ['mod'=>'text', 'add'=>'/url/'.$mypage->name.'/location/'.$loc, 'mess'=>"Add new text on ".$loc])
	@endif
@endif
@php $datactr = 0; @endphp
@foreach($data as $key => $text)
	@if(isset($limit) && $datactr >= $limit) @break; @endif
	@if($text->location != $loc) @continue @endif
	@php $datactr++; @endphp
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
@endforeach