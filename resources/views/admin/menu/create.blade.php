@inject('menuPresenter','App\Presenters\Admin\MenuPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="createBox">
  <div class="ibox-title">
    <h5>{{trans('admin/menu.create')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{url('admin/menu')}}" class="form-horizontal" id="createForm">
      {!!csrf_field()!!}
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.name')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.name')}}" name="name">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.pid')}}</label>
        <div class="col-sm-10">
          <select class="form-control" name="pid">
            {!!$menuPresenter->topMenuList($menus)!!}
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.icon')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.icon')}}" name="icon">
          <span class="help-block m-b-none">{!!trans('admin/menu.moreIcon')!!}</span>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.slug')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.slug')}}" name="slug">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.url')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.url')}}" name="url">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.active')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.active')}}" name="active">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.description')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.description')}}" name="description">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-2 control-label">{{trans('admin/menu.model.sort')}}</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{{trans('admin/menu.model.sort')}}" name="sort">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <a class="btn btn-white close-link">{!!trans('admin/action.actionButton.close')!!}</a>
            <button class="btn btn-primary createButton ladda-button"  data-style="zoom-in">{!!trans('admin/action.actionButton.submit')!!}</button>
          </div>
      </div>
    </form>
  </div>
</div>