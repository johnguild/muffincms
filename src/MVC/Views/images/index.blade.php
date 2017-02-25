@php $datactr = 0; @endphp
@foreach($data as $key => $image)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($image->location != $loc) @continue @endif
	@php $datactr++; @endphp

	@if(isset($view))
		@include('images.'.$view, ['image'=>$image])
		@continue
	@endif


	<img src="{{$image->image}}" alt="{{$image->alt}}" class="muff muff-img"  data-muff-id="{{$image->id}}">	

@endforeach
{{-- Add more Image --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('modules.add', ['mod'=>'image', 'add'=>'/url/'.$url.'/location/'.$loc, 'mess'=>"Add new image on ".$loc])
	@endif
@endif