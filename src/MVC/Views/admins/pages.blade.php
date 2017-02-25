@extends('layouts.admin')

@section('title', ucfirst('pages'))

@section('content')

	<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Pages
                </h1>
                <!-- <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-newspaper-o"></i> Pages
                    </li>
                </ol> -->

                <div class="page-content">
                    <p class="lead col-md-9">
                        Static pages that caters specific contents<br>
                        <small>(visit the page to start managing it's contents)</small>
                    </p>
                    <a href="/page/create" class="btn btn-primary" class="pull-right col-md-3 text-right">
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
                                <th>Page Name</th>
                                <th>Description</th>
                                <th>Template</th>
                                <th>Publicity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr class="@if($page->public) success @else danger @endif">
                                    <td>{{ucfirst($page->name)}}</td>
                                    <td>{{ucfirst($page->desc)}}</td>
                                    <td>{{ucfirst($page->template)}}</td>
                                    <td>@if($page->public) Public
                                        @else Private
                                        @endif
                                    </td>
                                    <td>
                                        <div class="opt-div">
                                            <a href="/{{$page->name}}" class="btn btn-success" target="_blank">
                                                <i class="fa fa-eye" aria-hidden=true></i>
                                                visit
                                            </a>
                                            <a href="/page/edit/{{$page->id}}" class="btn btn-info">
                                                <i class="fa fa-pencil-square-o" aria-hidden=true></i>
                                                edit
                                            </a>
                                            @if($page->id > 2)
                                            <a href="/page/delete/{{$page->id}}" class="btn btn-danger delete" data-mod="page">
                                                <i class="fa fa-times" aria-hidden=true></i>
                                                delete
                                            </a>
                                            @endif
                                            <div class="clear"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{$pages->links()}}
            </div>
        </div>
       
    </div>
    <!-- /.container-fluid -->

  </div>

@endsection

@section('script')

@endsection
		
