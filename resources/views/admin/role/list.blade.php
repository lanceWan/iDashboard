@extends('layouts.admin')
@section('css')
<link href="{{asset('vendors/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/role.title')!!}</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('admin/breadcrumb.role.list')!!}</strong>
        </li>
    </ol>
  </div>
  @permission(config('admin.permissions.role.create'))
  <div class="col-lg-2">
    <div class="title-action">
      <a href="{{url('admin/role/create')}}" class="btn btn-info">{!!trans('admin/role.action.create')!!}</a>
    </div>
  </div>
  @endpermission
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('admin/role.desc')!!}</h5>
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
          @include('flash::message')
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-hover dataTablesAjax" >
		          <thead>
			          <tr>
			            <th>{{trans('admin/role.model.id')}}</th>
			            <th>{{trans('admin/role.model.name')}}</th>
			            <th>{{trans('admin/role.model.slug')}}</th>
			            <th>{{trans('admin/role.model.description')}}</th>
			            <th>{{trans('admin/role.model.created_at')}}</th>
			            <th>{{trans('admin/role.model.updated_at')}}</th>
			            <th>{{trans('admin/action.title')}}</th>
			          </tr>
		          </thead>
		          <tbody>
		          </tbody>
	          </table>
          </div>
        </div>
      </div>
  	</div>
  </div>
</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
          
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset('vendors/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('vendors/layer/layer.js')}}"></script>
<script src="{{asset('admin/js/role/role-datatable.js')}}"></script>
<script type="text/javascript">
  $(document).on('click','.destroy_item',function() {
    var _item = $(this);
    layer.msg('{{trans('admin/alert.deleteTitle')}}', {
      time: 0, //不自动关闭
      btn: ['{{trans('admin/action.actionButton.destroy')}}', '{{trans('admin/action.actionButton.no')}}'],
      icon: 5,
      yes: function(index){
        _item.children('form').submit();
        layer.close(index);
      }
    });
  });
</script>
@endsection