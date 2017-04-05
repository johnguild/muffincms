@php $datactr = 0; @endphp
@foreach($data as $key => $image)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($image->location != $loc) @continue @endif
	@php $datactr++; @endphp
	
	@if(isset($wrapbegin))
		{!! $wrapbegin !!}
	@endif

	@if(isset($view))
		@include($view, ['image'=>$image])

		@if(isset($wrapend))
			{!! $wrapend !!}
		@endif
		
		@continue
	@endif

	<img src="{{$image->image}}" alt="{{$image->alt}}" class="muff muff-img img-responsive"  data-muff-id="{{$image->id}}">	
	
	@if(isset($wrapend))
		{!! $wrapend !!}
	@endif

@endforeach
{{-- Add more Image --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('muffincms::modules.add', 
						['mod'=>'image', 'loc'=>$loc, 'mess'=> (isset($mess)?$mess:"+"), 'addclass'=>isset($addclass)?$addclass:''])
	@endif
@endif