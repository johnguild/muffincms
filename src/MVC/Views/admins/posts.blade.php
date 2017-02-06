@extends('layouts.admin')

@section('title', ucfirst('posts'))

@section('content')

	<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Posts
                </h1>
                <!-- <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Posts
                    </li>
                </ol> -->
                <div class="page-content">
                    <p class="lead col-md-9">
                        Blogs, Tutorials, or any kind of information you want to share the world<br>
                        <small>(visit the post's page to start managing it's contents)</small>
                    </p>
                    <a href="/post/create" class="btn btn-primary" class="pull-right col-md-3 text-right">
                        <i class="fa fa-pencil-square-o" aria-hidden=true></i>
                        Create New
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Template</th>
                                <th>Publicity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr class="@if($post->public) success @else danger @endif">
                                    <td>{{ucfirst($post->title)}}</td>
                                    <td>{{$post->desc}}</td>
                                    <td>{{$post->template}}</td>
                                    <td>@if($post->public) Public
                                        @else Private
                                        @endif
                                    </td>
                                    <td>
                                        <div class="opt-div">
                                            <a href="/{{$post->slug}}" class="btn btn-success" target="_blank">
                                                <i class="fa fa-eye" aria-hidden=true></i>
                                                visit
                                            </a>
                                            <a href="/post/edit/{{$post->id}}" class="btn btn-info">
                                                <i class="fa fa-pencil-square-o" aria-hidden=true></i>
                                                edit
                                            </a>
                                            <a href="/post/delete/{{$post->id}}" class="btn btn-danger delete" data-mod="post">
                                                <i class="fa fa-times" aria-hidden=true></i>
                                                delete
                                            </a>
                                            <div class="clear"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{$posts->links()}}
            </div>
        </div>
       
       
    </div>
    <!-- /.container-fluid -->

  </div>

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
    });
  </script>
@endsection
		
