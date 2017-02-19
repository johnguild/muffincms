<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  	@if(isset($facebook))
  		<li role="presentation" class="active"><a href="#fb-comments" aria-controls="fb-comments" role="tab" data-toggle="tab">Facebook Comments</a></li>
  	@endif
    @if(isset($google))
    	<li role="presentation"><a href="#google-comments" aria-controls="google-comments" role="tab" data-toggle="tab">Google Comments</a></li>
    @endif
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  	@if(isset($facebook))
  		<div role="tabpanel" class="tab-pane active" id="fb-comments">
			<div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5"></div>
  		</div>
  	@endif
  	@if(isset($google))
   		<div role="tabpanel" class="tab-pane" id="google-comments">
   			<script src="https://apis.google.com/js/plusone.js"></script>
			<div id="comments"></div>
			<script>
			gapi.comments.render('comments', {
			    href: window.location,
			    width: '624',
			    first_party_property: 'BLOGGER',
			    view_type: 'FILTERED_POSTMOD'
			});
			</script>
   		</div>
   	@endif
  </div>

</div>