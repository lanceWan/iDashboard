@extends('layouts.admin')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/permission.title')!!}</h2>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
        </li>
        <li>
            <a href="{{url('admin/permission')}}">{!!trans('admin/breadcrumb.permission.list')!!}</a>
        </li>
        <li class="active">
            <strong>{!!trans('admin/breadcrumb.permission.edit')!!}</strong>
        </li>
    </ol>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('admin/permission.edit')!!}</h5>
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
          <form method="post" action="{{url('admin/permission/'.$permission->id)}}" class="form-horizontal">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="id" value="{{$permission->id}}">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">{{trans('admin/permission.model.name')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old('name',$permission->name) }}" placeholder="{{trans('admin/permission.model.name')}}"> 
                @if ($errors->has('name'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
              <label class="col-sm-2 control-label">{{trans('admin/permission.model.slug')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="slug" value="{{old('slug',$permission->slug)}}" placeholder="{{trans('admin/permission.model.slug')}}"> 
                @if ($errors->has('slug'))
                <span class="help-block m-b-none text-danger">{{ $errors->first('slug') }}</span>
                @endif
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/permission.model.description')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old('description',$permission->description)}}" placeholder="{{trans('admin/permission.model.description')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/permission.model.model')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="model" value="{{old('model',$permission->model)}}" placeholder="{{trans('admin/permission.model.model')}}">
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