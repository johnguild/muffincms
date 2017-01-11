@foreach($data as $value)
	@if($value->location == $loc)
		@include('texts.'.$tpl, $value)
	@endif
@endforeach