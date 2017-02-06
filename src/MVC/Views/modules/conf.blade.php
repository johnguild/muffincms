<div class="dropdown pull-right">
	<a href="#" class="@if($conf==2)conf-hvr-btn @elseif($conf==1)conf-btn @endif pull-right">
		<i class="fa fa-cog" aria-hidden=true></i>
	</a>
	<ul class="submenu pull-right">
		<!-- <li><a href="#">Configure</a></li> -->
		<li><a href="/{{$mod}}/edit/{{$id}}">Edit</a></li>
		<li><a href="/{{$mod}}/delete/{{$id}}" class="delete" data-mod="{{$mod}}">Delete</a></li>
	</ul>
</div>