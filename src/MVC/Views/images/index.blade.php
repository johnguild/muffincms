@php $datactr = 0; @endphp
@foreach($data as $key => $image)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($image->location != $loc) @continue @endif
	@php $datactr++; @endphp
		@if(Auth::check() && Auth::user()->isAdmin())
			<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif @if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
				@if($conf)
					@include('modules.conf', ['mod'=>'image', 'id'=>$image->id, 'conf'=>$conf])
				@endif
		@endif
		@include('images.'.$view, ['image'=>$image])
		@if(Auth::check() && Auth::user()->isAdmin())
				@if($opt)
					@include('modules.opt', ['mod'=>'image', 'id'=>$image->id, 'opt'=>$opt])
				@endif
			</div>
		@endif
@endforeach
{{-- Add more Image --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('modules.add', ['mod'=>'image', 'add'=>'/url/'.$url.'/location/'.$loc, 'mess'=>"Add new image on ".$loc])
	@endif
@endif