@php $datactr = 0; @endphp
@foreach($data as $key => $link)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($link->location != $loc) @continue @endif
	@php $datactr++; @endphp

	@if(isset($wrapbegin))
		{!! $wrapbegin !!}
	@endif

	@if(isset($view))
		@include($view, ['link'=>$link])

		@if(isset($wrapend))
			{!! $wrapend !!}
		@endif

		@continue
	@endif

	<a href="{{$link->address}}" alt="{{$link->alt}}" class="muff muff-a"  data-muff-id="{{$link->id}}" @if($link->new_window) target="_blank" @endif >
		
		@if($link->image)
			<img src="{{$link->image}}" width="250px" height="250px" class="img-responsive">
		@else
			{{$link->title}}
		@endif
	</a>

	@if(isset($wrapend))
		{!! $wrapend !!}
	@endif

@endforeach
{{-- Add more link --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('muffincms::modules.add', 
						['mod'=>'link', 'loc'=>$loc, 'mess'=> (isset($mess)?$mess:"+"), 'addclass'=>isset($addclass)?$addclass:''])
	@endif
@endif