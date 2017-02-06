@extends('layouts.admin')

@section('title', $post->title)

@section('content')
<div id="page-wrapper">
	<div class="container-fluid">
		<h2>Editing Post</h2>
		<form method="POST" action="/post/update" class="form">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$post->id}}">

			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="post-title">Title</label>
				<input type="text" id="post-title" name="title" value="{{old('title', $post->title)}}" class="form-control">
				@if ($errors->has('title'))
			        <span class="help-block">
			            <strong>{{ $errors->first('title') }}</strong>
			        </span>
			    @endif
			</div>

			<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
				<label for="post-desc">Description</label>
				<textarea cols="15" rows="5" id="post-desc" class="ckeditor" name="desc">{{old('desc', $post->desc)}}</textarea>
				@if ($errors->has('desc'))
			        <span class="help-block">
			            <strong>{{ $errors->first('desc') }}</strong>
			        </span>
			    @endif
			</div>

			<div class="checkbox">
		    	<label>
					<input type="checkbox" name="public" @if(old('public') || $post->public)checked="checked" @endif> Make this post public
			    </label>
			</div>

			<div class="form-group">
			    <label for="page-template">Select a template</label>
			    <select class="form-control" id="page-template" name="template">
			      @foreach($templates as $tpl)
			      	<option value="{{$tpl}}" {{(old('template', $post->template) == $tpl ? "selected":"") }}>{{$tpl}}</option>
			      @endforeach
			    </select>
			</div>

		  	<div class="input-group">
		      	<span class="input-group-btn">
		        	<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
		          		<i class="fa fa-picture-o"></i> Choose Image
		        	</a>
		      	</span>
		      	<input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image', $post->image)}}">
		    </div>

	    	<img id="holder" style="margin-top:15px;max-height:100px;" src="{{old('image', $post->image)}}">
	    	<br>

			<div class="form-group edit-div">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				<a href="/admin/posts" id="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#lfm').filemanager('image');
    });
  </script>
@endsection