@extends('layouts.admin')

@section('title', ucfirst('dashboard'))

@section('content')

  <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
            
              <!-- <div class="row">
                  <div class="col-lg-12">
                      <div class="alert alert-info alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                      </div>
                  </div>
              </div> -->
              <!-- /.row -->

              <!-- WEEKLY REPORT -->
              <div class="row">
                  <div class="col-lg-3 col-md-6">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-pencil fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">{{$week['new_posts']}}</div>
                                      <div>@if($week['new_posts'] > 1) Posts @else Post @endif This Week</div>
                                  </div>
                              </div>
                          </div>
                          <a href="/post/create">
                              <div class="panel-footer">
                                  <span class="pull-left">Create New</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                      <div class="panel panel-green">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-eye fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">{{array_sum($week['report'])}}</div>
                                      <div>@if(array_sum($week['report']) > 1) Views @else View @endif This Week</div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                  
                  <div class="col-lg-6 col-md-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> Reports</h3>
                          </div>
                          <div class="panel-body">
                              <p>Weekly report starts from <i>SUNDAY</i> and ends at <i>SATURDAY</i></p>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-level-up fa-fw"></i> This Week Top Viewed Posts</h3>
                          </div>
                          <div class="panel-body">
                              @foreach($week['top_posts']->sortByDesc('total_viewers') as $post)
                                <div class="col-lg-3 col-sm-6">
                                  <div class="card hovercard">
                                      <div class="cardheader" style="background: url('{{$post->image}}');background-size:cover;">

                                      </div>
                                      <div class="info">
                                          <div class="title">
                                              <a target="_blank" href="/{{$post->slug}}">{{$post->title}}</a>
                                          </div>
                                          <div class="desc">This week views {{$post->getThisWeekViewCount()}}</div>
                                          <div class="desc">Total views {{$post->total_viewers}}</div>
                                      </div>
                                      <div class="bottom">
                                        <div class="opt-div">
                                          <a href="/{{$post->slug}}" class="btn btn-success" target="_blank" title="visit">
                                              <i class="fa fa-eye" aria-hidden=true></i>
                                          </a>
                                          <a href="/post/edit/{{$post->id}}" class="btn btn-info" title="edit">
                                              <i class="fa fa-pencil-square-o" aria-hidden=true></i>
                                          </a>
                                          <a href="/post/delete/{{$post->id}}" class="btn btn-danger delete" data-mod="post" title="delete">
                                              <i class="fa fa-times" aria-hidden=true></i>
                                          </a>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> This Week Views Overview</h3>
                          </div>
                          <div class="panel-body">
                              <div id="morris-bar-chart"></div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- END WEEKLY REPORT -->
          </div>
          <!-- /.container-fluid -->

      </div>

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      // Weekly View Bar Chart
      Morris.Bar({
          element: 'morris-bar-chart',
          data: [{
              views: 'Sunday',
              countbench: {{$week['report']['sun']}}
          }, {
              views: 'Monday',
              countbench: {{$week['report']['mon']}}
          }, {
              views: 'Tuesday',
              countbench: {{$week['report']['tue']}}
          }, {
              views: 'Wednesday',
              countbench: {{$week['report']['wed']}}
          }, {
              views: 'Thursday',
              countbench: {{$week['report']['thu']}}
          }, {
              views: 'Friday',
              countbench: {{$week['report']['fri']}}
          }, {
              views: 'Saturday',
              countbench: {{$week['report']['sat']}}
          }],
          xkey: 'views',
          ykeys: ['countbench'],
          labels: ['Views'],
          barRatio: 0.4,
          xLabelAngle: 35,
          hideHover: 'auto',
          resize: true,
          yLabelFormat: function(y){ return y != Math.round(y)?'':y; },
          gridIntegers: true,
          ymin: 0,
      });


    // // Area Chart
    //   Morris.Area({
    //       element: 'morris-area-chart',
    //       data: [{
    //           period: '2010 Q1',
    //           iphone: 2666,
    //           ipad: null,
    //           itouch: 2647
    //       }, {
    //           period: '2010 Q2',
    //           iphone: 2778,
    //           ipad: 2294,
    //           itouch: 2441
    //       }, {
    //           period: '2010 Q3',
    //           iphone: 4912,
    //           ipad: 1969,
    //           itouch: 2501
    //       }, {
    //           period: '2010 Q4',
    //           iphone: 3767,
    //           ipad: 3597,
    //           itouch: 5689
    //       }, {
    //           period: '2011 Q1',
    //           iphone: 6810,
    //           ipad: 1914,
    //           itouch: 2293
    //       }, {
    //           period: '2011 Q2',
    //           iphone: 5670,
    //           ipad: 4293,
    //           itouch: 1881
    //       }, {
    //           period: '2011 Q3',
    //           iphone: 4820,
    //           ipad: 3795,
    //           itouch: 1588
    //       }, {
    //           period: '2011 Q4',
    //           iphone: 15073,
    //           ipad: 5967,
    //           itouch: 5175
    //       }, {
    //           period: '2012 Q1',
    //           iphone: 10687,
    //           ipad: 4460,
    //           itouch: 2028
    //       }, {
    //           period: '2012 Q2',
    //           iphone: 8432,
    //           ipad: 5713,
    //           itouch: 1791
    //       }],
    //       xkey: 'period',
    //       ykeys: ['iphone', 'ipad', 'itouch'],
    //       labels: ['iPhone', 'iPad', 'iPod Touch'],
    //       pointSize: 2,
    //       hideHover: 'auto',
    //       resize: true
    //   });

    // // Donut Chart
    //   Morris.Donut({
    //       element: 'morris-donut-chart',
    //       data: [{
    //           label: "Download Sales",
    //           value: 12
    //       }, {
    //           label: "In-Store Sales",
    //           value: 30
    //       }, {
    //           label: "Mail-Order Sales",
    //           value: 20
    //       }],
    //       resize: true
    //   });

    // // Line Chart
    //   Morris.Line({
    //       // ID of the element in which to draw the chart.
    //       element: 'morris-line-chart',
    //       // Chart data records -- each entry in this array corresponds to a point on
    //       // the chart.
    //       data: [{
    //           d: '2012-10-01',
    //           visits: 802
    //       }, {
    //           d: '2012-10-02',
    //           visits: 783
    //       }, {
    //           d: '2012-10-03',
    //           visits: 820
    //       }, {
    //           d: '2012-10-04',
    //           visits: 839
    //       }, {
    //           d: '2012-10-05',
    //           visits: 792
    //       }, {
    //           d: '2012-10-06',
    //           visits: 859
    //       }, {
    //           d: '2012-10-07',
    //           visits: 790
    //       }, {
    //           d: '2012-10-08',
    //           visits: 1680
    //       }, {
    //           d: '2012-10-09',
    //           visits: 1592
    //       }, {
    //           d: '2012-10-10',
    //           visits: 1420
    //       }, {
    //           d: '2012-10-11',
    //           visits: 882
    //       }, {
    //           d: '2012-10-12',
    //           visits: 889
    //       }, {
    //           d: '2012-10-13',
    //           visits: 819
    //       }, {
    //           d: '2012-10-14',
    //           visits: 849
    //       }, {
    //           d: '2012-10-15',
    //           visits: 870
    //       }, {
    //           d: '2012-10-16',
    //           visits: 1063
    //       }, {
    //           d: '2012-10-17',
    //           visits: 1192
    //       }, {
    //           d: '2012-10-18',
    //           visits: 1224
    //       }, {
    //           d: '2012-10-19',
    //           visits: 1329
    //       }, {
    //           d: '2012-10-20',
    //           visits: 1329
    //       }, {
    //           d: '2012-10-21',
    //           visits: 1239
    //       }, {
    //           d: '2012-10-22',
    //           visits: 1190
    //       }, {
    //           d: '2012-10-23',
    //           visits: 1312
    //       }, {
    //           d: '2012-10-24',
    //           visits: 1293
    //       }, {
    //           d: '2012-10-25',
    //           visits: 1283
    //       }, {
    //           d: '2012-10-26',
    //           visits: 1248
    //       }, {
    //           d: '2012-10-27',
    //           visits: 1323
    //       }, {
    //           d: '2012-10-28',
    //           visits: 1390
    //       }, {
    //           d: '2012-10-29',
    //           visits: 1420
    //       }, {
    //           d: '2012-10-30',
    //           visits: 1529
    //       }, {
    //           d: '2012-10-31',
    //           visits: 1892
    //       }, ],
    //       // The name of the data record attribute that contains x-visitss.
    //       xkey: 'd',
    //       // A list of names of data record attributes that contain y-visitss.
    //       ykeys: ['visits'],
    //       // Labels for the ykeys -- will be displayed when you hover over the
    //       // chart.
    //       labels: ['Visits'],
    //       // Disables line smoothing
    //       smooth: false,
    //       resize: true
    //   });

    
    });
  </script>
@endsection
    
