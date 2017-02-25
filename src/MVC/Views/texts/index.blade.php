@php $datactr = 0; @endphp
@foreach($data as $key => $text)
	@if(isset($limit) && $datactr >= $limit) @break; @endif
	@if($text->location != $loc) @continue @endif
	@php $datactr++; @endphp

	@if(isset($view))
		@include('texts.'.$view, ['text'=>$text])
		@continue
	@endif


	<div class="muff muff-text" data-muff-id="{{$text->id}}">
		{!! str_replace('&nbsp;', ' ', html_entity_decode($text->content)) !!}
	</div>
		
@endforeach
{{-- Add More Link --}}
@if(Auth::check() && Auth::user()->isAdmin())
	@if(!isset($limit) || (isset($limit) && $datactr < $limit))
		@include('modules.add', ['mod'=>'text', 'add'=>'/url/'.$url.'/location/'.$loc, 'mess'=>"Add new text on ".$loc])
	@endif
@endif