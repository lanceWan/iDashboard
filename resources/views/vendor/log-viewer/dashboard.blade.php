@extends('layouts.admin')
@section('css')
<link href="http://cdn.bootcss.com/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/menu.title')!!}</h2>
    <ol class="breadcrumb">
      <li>
          <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
      </li>
      <li class="active">
          <strong>{!!trans('admin/breadcrumb.log.dash')!!}</strong>
      </li>
    </ol>
  </div>
  @permission(config('admin.permissions.log.list'))
  <div class="col-lg-2">
    <div class="title-action">
      <a href="{{route('log.index')}}" class="btn btn-info">{!!trans('admin/log.list')!!}</a>
    </div>
  </div>
  @endpermission
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>{!!trans('admin/breadcrumb.log.dash')!!}</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
      <div class="row">
          <div class="col-md-3">
              <canvas id="stats-doughnut-chart"></canvas>
          </div>
          <div class="col-md-9">
              <section class="box-body">
                  <div class="row">
                      @foreach($percents as $level => $item)
                          <div class="col-md-4">
                              <div class="widget style1 lazur-bg">
                                  <div class="row">
                                      <div class="col-xs-4">
                                          {!! log_styler()->icon($level) !!}
                                      </div>
                                      <div class="col-xs-8 text-right">
                                          <span>{{ $item['count'] }} entries - {!! $item['percent'] !!} %</span>
                                          <h2 class="font-bold">{{ $item['name'] }}</h2>
                                          <div class="progress progress-striped active m-b-none  m-t-sm">
                                              <div style="width: {{ $item['percent'] }}%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-danger">{{ $item['percent'] }}%
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </section>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="http://cdn.bootcss.com/moment.js/2.15.2/moment-with-locales.min.js"></script>
<script src="http://cdn.bootcss.com/Chart.js/2.3.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<script>
  Chart.defaults.global.responsive      = true;
  Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
  Chart.defaults.global.animationEasing = "easeOutQuart";
  $(function() {
    var data = {!! $reports !!};
    new Chart($('#stats-doughnut-chart')[0].getContext('2d'))
      .Doughnut(data, {
          animationEasing : "easeOutQuart"
    });
  });
</script>
@endsection