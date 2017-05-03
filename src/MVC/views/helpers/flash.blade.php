@if(session()->has('flash'))
	<div class="alert {{ session('flash_class') }} col-md-10 col-md-offset-1">
    	<div class="navbar-right" style="margin-right: 3px;">
    		<a class="plain-link message-close" title="close" style="color:gray;">x</a>
    	</div>
    	{{ session('flash') }}
    </div>
    <div style="clear:both;"></div>
@endif