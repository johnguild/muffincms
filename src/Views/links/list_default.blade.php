@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && count(array_filter($data->toArray(),function($data) use($loc){return $data['location'] == $loc;})) < $limit))
		@include('modules.add', ['mod'=>'link', 'add'=>'/url/'.$mypage->name.'/location/'.$loc, 'mess'=>"Add new link on ".$loc])
	@endif
@endif
@php $datactr = 0; @endphp
@foreach($data as $key => $link)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($link->location != $loc) @continue @endif
	@php $datactr++; @endphp
	<li>
		@if(Auth::check() && Auth::user()->isAdmin())
		<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif">
			@if($conf)
				@include('modules.conf', ['mod'=>'link', 'id'=>$link->id, 'conf'=>$conf])
			@endif
		</div>
		@endif

		@include('links.'.$view, $link)
		
		@if(Auth::check() && Auth::user()->isAdmin())
		<div class="@if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
			@if($opt)
				@include('modules.opt', ['mod'=>'link', 'id'=>$link->id, 'opt'=>$opt])
			@endif
		</div>
		@endif
	</li>
@endforeach