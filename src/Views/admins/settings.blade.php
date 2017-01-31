@extends('layouts.admin')

@section('title', ucfirst('settings'))

@section('content')

	<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Settings <small>Website's current configuration</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-newspaper-o"></i> Settings
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-fw fa-user"></i> User</h3>
                    </div>
                    <div class="panel-body">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="canRegister" > Allow user registration
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-fw fa-wrench"></i> Maintenance</h3>
                    </div>
                    <div class="panel-body">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="canRegister" > Turn on maintenance mode
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <!-- /.container-fluid -->



  </div>

@endsection

@section('script')

@endsection
		
