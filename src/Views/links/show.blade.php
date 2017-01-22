<a href="{{$link->address}}" alt="{{$link->alt}}" @if($link->new_window) target="_blank" @endif>
	@if($link->image)
		<img src="{{$link->image}}" width="250px" height="250px">
	@else
		{{$link->title}}
	@endif
</a>