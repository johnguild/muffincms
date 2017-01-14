@foreach($data as $text)
	@if($text->location == $loc)
		@if(Auth::check() && Auth::user()->isAdmin())
		<div class="@if($conf==2)w-conf-hvr @elseif($conf==1)w-conf @endif @if($opt==2)w-opt-hvr @elseif($opt==1)w-opt @endif">
			@if($conf)
				<div class="dropdown pull-right">
					<a href="#" class="@if($conf==2)conf-hvr-btn @elseif($conf==1)conf-btn @endif pull-right">
						<i class="fa fa-cog" aria-hidden=true></i>
					</a>
					<ul class="submenu pull-right">
						<li><a href="#">Configure</a></li>
					</ul>
				</div>
			@endif
		@endif
			@include('texts.'.$view, $text)
		@if(Auth::check() && Auth::user()->isAdmin())
			@if($opt)
				<div class="opt-div pull-center">
					<center>
					<a href="/text/edit/{{$text->id}}" class="btn btn-info">
						<i class="fa fa-pencil-square-o" aria-hidden=true></i>
						edit
					</a>
					<a href="#" class="btn btn-danger delete" data-toggle="modal" data-target="#delete-confirm">
						<i class="fa fa-times" aria-hidden=true></i>
						delete
					</a>
					<div class="clear"></div>
					<!-- Modal -->
					<div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this text</h5>
					      </div>
					      <!-- <div class="modal-body">
					        ...
					      </div> -->
					      <form method="POST" action="/text/delete/{{$text->id}}" class="">
					      	<div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
										{{ csrf_field() }}			
										<button type="submit" name="submit" class="btn btn-danger">Continue</button>
					      	</div>
								</form>
					    </div>
					  </div>
					</div>
				</div>
			@endif
		</div>
		@endif
	@endif
@endforeach