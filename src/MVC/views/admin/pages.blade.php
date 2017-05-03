@extends('muffincms::layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="col-lg-12 col-md-12 content-editor">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Pages
            </h1>
            @include('muffincms::helpers.flash')
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
                                <td>{{$page->name}}</td>
                                <td>{{ucfirst($page->desc)}}</td>
                                <td>{{$page->template}}</td>
                                <td>@if($page->public) Public
                                    @else Private
                                    @endif
                                </td>
                                <td>
                                    <div class="opt-div">
                                        <a href="{{url('/'.$page->name)}}" class="btn btn-success" target="_blank">
                                            <i class="fa fa-eye" aria-hidden=true></i>
                                            visit
                                        </a>
                                        <a href="{{url('/admin/page/'.$page->id.'/edit')}}" class="btn btn-info">
                                            <i class="fa fa-pencil-square-o" aria-hidden=true></i>
                                            edit
                                        </a>
                                        @if($page->id > 2)
                                        <a href="{{url('/admin/page/delete')}}" class="btn btn-danger delete" data-mod="page" data-id="{{$page->id}}">
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


    <div class="row" id="create-page">
    	<div class="col-lg-12">
            <h3>Create New Page</h3>
            <hr>
            <form method="POST" action="{{url('/admin/page/store')}}" class="form">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="page-name">Name/URL</label>
                    <input type="text" id="page-name" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter url of the page ex. about-us">    
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                    <label for="page-desc">Description</label>
                    <textarea cols="15" rows="5" id="page-desc" class="tinyeditor" name="desc">{{old('desc')}}</textarea>
                    @if ($errors->has('desc'))
                        <span class="help-block">
                            <strong>{{ $errors->first('desc') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="page-template">Select a template</label>
                    <select class="form-control" id="page-template" name="template">
                      @foreach($templates as $tpl)
                        <option value="{{$tpl}}" {{(old('template') == $tpl ? "selected":"") }}>{{$tpl}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="public" @if(old('public'))checked="checked" @endif> Open to public
                    </label>
                </div>
                
                <div class="form-group edit-div">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    <a href="{{url('admin/pages')}}" id="" class="btn btn-default">Cancel</a>
                </div>
            </form>
    	</div>
    </div>
       
</div>
@endsection

@section('script')

@endsection
