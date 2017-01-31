@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && count(array_filter($data->toArray(),function($data) use($loc){return $data['location'] == $loc;})) < $limit))
		@include('modules.add', ['mod'=>'div', 'add'=>'/url/'.$mypage->name.'/location/'.$loc, 'mess'=>"Add new div on ".$loc])
	@endif
@endif
@php $datactr = 0; @endphp
@foreach($data as $key => $div)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($div->location != $loc) @continue @endif
	@php $datactr++; @endphp
		@include('divs.'.$view, $div)
		@if(Auth::check() && Auth::user()->isAdmin())
			<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif @if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
				@if($conf)
					@include('modules.conf', ['mod'=>'div', 'id'=>$div->id, 'conf'=>$conf])
				@endif
			</div>
		@endif
		@if(Auth::check() && Auth::user()->isAdmin())
				@if($opt)
					@include('modules.opt', ['mod'=>'div', 'id'=>$div->id, 'opt'=>$opt])
				@endif
		@endif
@endforeach