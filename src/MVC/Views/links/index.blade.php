@php $datactr = 0; @endphp
@foreach($data as $key => $link)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($link->location != $loc) @continue @endif
	@php $datactr++; @endphp

	@if(isset($view))
		@include('links.'.$view, ['link'=>$link])
		@continue
	@endif

		
	<a href="{{$link->address}}" alt="{{$link->alt}}" class="muff muff-a"  data-muff-id="{{$link->id}}" @if($link->new_window) target="_blank" @endif >
		@if($link->image)
			<img src="{{$link->image}}" width="250px" height="250px">
		@else
			{{$link->title}}
		@endif
	</a>

@endforeach
{{-- Add more link --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('modules.add', ['mod'=>'link', 'add'=>'/url/'.$url.'/location/'.$loc, 'mess'=>"Add new link on ".$loc])
	@endif
@endif