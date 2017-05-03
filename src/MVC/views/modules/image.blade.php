@foreach(contents('image', $loc) as $key => $image)
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
	@if(!isset($limit) || (isset($limit) && count(contents('image', $loc)) < $limit))
		@include('muffincms::modules.add', 
						['mod'=>'image', 'loc'=>$loc, 'mess'=> (isset($mess)?$mess:"+"), 'addclass'=>isset($addclass)?$addclass:''])
	@endif
@endif