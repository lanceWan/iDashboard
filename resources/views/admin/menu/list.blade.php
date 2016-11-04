@extends('layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/nestable/nestable.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/ladda/ladda-themeless.min.css')}}">
@endsection
@section('content')
@inject('menuPreseter','App\Presenters\Admin\MenuPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/menu.title')!!}</h2>
    <ol class="breadcrumb">
      <li>
          <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
      </li>
      <li class="active">
          <strong>{!!trans('admin/breadcrumb.menu.list')!!}</strong>
      </li>
    </ol>
  </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
  <div class="row">
    @include('flash::message')
    <div class="col-lg-6">
      <div class="ibox animated fadeInRightBig">
        <div class="ibox-title">
            <h5>{!!trans('admin/menu.desc')!!}</h5>
        </div>
        <div class="ibox-content">
          <div class="dd" id="nestable">
              <ol class="dd-list">
                {!!$menuPreseter->menuNestable($menus)!!}
              </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 menuBox">
        {!!$menuPreseter->canCreateMenu()!!}
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset('vendors/nestable/jquery.nestable.js')}}"></script>
<script src="{{asset('vendors/ladda/spin.min.js')}}"></script>
<script src="{{asset('vendors/ladda/ladda.min.js')}}"></script>
<script src="{{asset('vendors/ladda/ladda.jquery.min.js')}}"></script>
<script src="{{asset('vendors/layer/layer.js')}}"></script>
<script src="{{asset('admin/js/menu/menu.js')}}"></script>
<script type="text/javascript">
  $('#nestable').on('click','.destroy_item',function() {
    var _item = $(this);
    var title = "{{trans('admin/alert.deleteTitle')}}";
    layer.confirm(title, {
      btn: ['{{trans('admin/action.actionButton.destroy')}}', '{{trans('admin/action.actionButton.no')}}'],
      icon: 5
    },function(index){
      _item.children('form').submit();
      layer.close(index);
    });
  });
</script>
@endsection