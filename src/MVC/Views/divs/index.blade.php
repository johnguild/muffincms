@php $datactr = 0; @endphp
@foreach($data as $key => $div)
	@if(isset($limit) && $datactr >= $limit) @break @endif
	@if($div->location != $loc) @continue @endif
	@php $datactr++; @endphp

	@if(isset($view))
		@include('divs.'.$view, ['div'=>$div])
		@continue
	@endif

	<div class="muff muff-div"  data-muff-id="{{$div->id}}">

		@if($div->title)
			<h1>{{$div->title}}</h1>
		@endif
		@if($div->image)
	        <span class="image"><img src="{{$div->image}}" alt="" /></span>
	    @endif	
	</div>
		
@endforeach
{{-- Add More Link --}}
@if(Auth::check() && Auth::user()->isAdmin() )
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('modules.add', ['mod'=>'div', 'add'=>'/url/'.$url.'/location/'.$loc, 'mess'=>"Add new div on ".$loc])
	@endif
@endif