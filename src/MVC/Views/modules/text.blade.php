@foreach(contents('text', $loc) as $key => $text)
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
{{-- Add More Text --}}
@if(Auth::check() && Auth::user()->isAdmin())
	@if(!isset($limit) || (isset($limit) && count(contents('text', $loc)) < $limit))
		@include('muffincms::modules.add', 
						['mod'=>'text', 'loc'=>$loc, 'mess'=> (isset($mess)?$mess:"+"), 'addclass'=>isset($addclass)?$addclass:''])
	@endif
@endif