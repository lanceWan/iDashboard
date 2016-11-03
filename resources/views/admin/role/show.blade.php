@inject('rolePresenter','App\Presenters\Admin\RolePresenter')
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title">{{trans('admin/role.info')}}</h4>
</div>
<div class="modal-body">
  <form class="form-horizontal">
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">{{trans('admin/role.model.name')}}</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->name}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">{{trans('admin/role.model.slug')}}</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->slug}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">{{trans('admin/role.model.description')}}</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->description}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">{{trans('admin/role.model.level')}}</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->level}}</p>
      </div>
    </div>
    <div class="hr-line-dashed no-margins"></div>
    <div class="form-group">
      <label class="col-sm-3 control-label">{{trans('admin/role.model.created_at')}}</label>
      <div class="col-sm-8">
        <p class="form-control-static">{{$role->created_at}}</p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <div class="ibox float-e-margins">
          <div class="ibox-content">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th class="col-md-2 text-center">{{trans('admin/role.module')}}</th>
                <th class="col-md-10 text-center">{{trans('admin/role.permission')}}</th>
              </tr>
              </thead>
              <tbody>
              {!!$rolePresenter->showRolePermissions($role->permissions)!!}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">{!!trans('admin/action.actionButton.close')!!}</button>
</div>
