@extends('layouts.admin')
@section('css')
<link href="{{asset('vendors/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
@inject('userPresenter','App\Presenters\Admin\UserPresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/user.title')!!}</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
        </li>
        <li>
            <a href="{{url('admin/user')}}">{!!trans('admin/breadcrumb.user.list')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('admin/breadcrumb.user.info')!!}</strong>
        </li>
    </ol>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('admin/user.create')!!}</h5>
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
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/user.model.name')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$user->name}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">{{trans('admin/user.model.username')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$user->username}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">{{trans('admin/user.model.email')}}</label>
              <div class="col-sm-10">
                <p class="form-control-static">{{$user->email}}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/user.role')}}</label>
              <div class="col-sm-10">
                {!!$userPresenter->showUserRoles($user->roles)!!}
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/user.permission')}}</label>
              <div class="col-sm-10">
                <div class="ibox float-e-margins">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th class="col-md-1 text-center">{{trans('admin/user.module')}}</th>
                          <th class="col-md-10 text-center">{{trans('admin/user.permission')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      {!! $userPresenter->showUserPermissions($user->userPermissions) !!}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{url()->previous()}}">{!!trans('admin/action.actionButton.cancel')!!}</a>
              </div>
            </div>
          </form>
        </div>
    </div>
  	</div>
  </div>
</div>
@include('admin.user.modal')
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/user/user.js')}}"></script>
@endsection