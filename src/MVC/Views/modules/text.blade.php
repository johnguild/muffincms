@php $datactr = 0; @endphp
@foreach($data as $key => $text)
	@if(isset($limit) && $datactr >= $limit) @break; @endif
	@if($text->location != $loc) @continue @endif
	@php $datactr++; @endphp


	@if(isset($wrapbegin))
		{!! $wrapbegin !!}
	@endif

	@if(isset($view))
		@include($view, ['text'=>$text])

		@if(isset($wrapend))
			{!! $wrapend !!}
		@endif

		@continue
	@endif

	<div class="muff muff-text" data-muff-id="{{$text->id}}">
		{!! str_replace('&nbsp;', ' ', html_entity_decode($text->content)) !!}
	</div>
	
	@if(isset($wrapend))
		{!! $wrapend !!}
	@endif

@endforeach
{{-- Add More Link --}}
@if(Auth::check() && Auth::user()->isAdmin())
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('muffincms::modules.add', 
						['mod'=>'text', 'loc'=>$loc, 'mess'=> (isset($mess)?$mess:"+"), 'addclass'=>isset($addclass)?$addclass:''])
	@endif
@endif