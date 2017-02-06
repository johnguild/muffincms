@php $datactr = 0; @endphp
@foreach($data as $key => $link)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($link->location != $loc) @continue @endif
	@php $datactr++; @endphp
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
@endforeach
{{-- Add more link --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('modules.add', ['mod'=>'link', 'add'=>'/url/'.$url.'/location/'.$loc, 'mess'=>"Add new link on ".$loc])
	@endif
@endif