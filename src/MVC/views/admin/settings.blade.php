@extends('muffincms::layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="col-lg-12 col-md-12 content-editor">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Settings
            </h1>
            @include('muffincms::helpers.flash')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-fw fa-wrench"></i> Maintenance</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{url('admin/settings')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$settings[0]->id}}">
                        <div class="checkbox">
                            <label>

                                <input type="checkbox" name="maintenance[val]"  @if(old('maintenance[val]', $settings[0]->val) == 'true' )checked="checked" @endif> Turn on maintenance mode
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Save" class="btn btn-primary pull-right">
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-fw fa-user"></i> User Registration</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{url('admin/settings')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$settings[1]->id}}">
                        <div class="checkbox">
                            <label>

                                <input type="checkbox" name="registration[val]"  @if(old('registration[val]', $settings[1]->val) == 'true' )checked="checked" @endif> Enable user registration
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Save" class="btn btn-primary pull-right">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

       
</div>
@endsection

@section('script')

@endsection
