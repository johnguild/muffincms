@extends('layouts.admin')

@section('title', ucfirst('posts'))

@section('content')

	<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Posts <small>You're Recent Posts</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Posts
                    </li>
                </ol>
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
		
