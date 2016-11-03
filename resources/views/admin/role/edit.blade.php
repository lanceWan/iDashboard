@extends('layouts.admin')
@section('css')
<link href="{{asset('vendors/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
@inject('rolePresenter','App\Presenters\Admin\RolePresenter')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/role.title')!!}</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
        </li>
        <li>
            <a href="{{url('admin/role')}}">{!!trans('admin/breadcrumb.role.list')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('admin/breadcrumb.role.edit')!!}</strong>
        </li>
    </ol>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('admin/role.edit')!!}</h5>
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
          <form method="post" action="{{url('admin/role/'.$role->id)}}" class="form-horizontal">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="id" value="{{$role->id}}">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">{{trans('admin/role.model.name')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old('name',$role->name)}}" placeholder="{{trans('admin/role.model.name')}}"> 
                @if ($errors->has('name'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">{{trans('admin/role.model.slug')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="slug" value="{{old('slug',$role->slug)}}" placeholder="{{trans('admin/role.model.slug')}}"> 
                @if ($errors->has('slug'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('slug') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/role.model.description')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old('description',$role->description)}}" placeholder="{{trans('admin/role.model.description')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/role.model.level')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="level" value="{{old('level',$role->level)}}" placeholder="{{trans('admin/role.model.level')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/role.permission')}}</label>
              <div class="col-sm-10">
                <div class="ibox float-e-margins">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th class="col-md-1 text-center">{{trans('admin/role.module')}}</th>
                          <th class="col-md-10 text-center">{{trans('admin/role.permission')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      {!! $rolePresenter->permissionList($permissions,array_column($role->permissions->toArray(),'id')) !!}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                  <a class="btn btn-white" href="{{url()->previous()}}">{!!trans('admin/action.actionButton.cancel')!!}</a>
                  <button class="btn btn-primary" type="submit">{!!trans('admin/action.actionButton.submit')!!}</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  	</div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/role/role.js')}}"></script>
@endsection