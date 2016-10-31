<?php
namespace App\Trait;
trait ActionButtonAttributeTrait{
	/**
	 * 查看按钮
	 * @author 晚黎
	 * @date   2016-10-31T18:14:09+0800
	 * @param  boolean		$type [默认为跳转页面查看信息,false时<a>标签带上modal样式]
	 * @return [type]
	 */
	public function getShowActionButton($type = true)
	{
		//开启查看按钮
		if (config('admin.global.'.$this->action.'.show')) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.show'))) {
				if ($type) {
					return '<a href="'.url('admin/'.$this->action.'/'.$this->id).'" class="btn btn-xs btn-outline btn-info tooltips" data-toggle="tooltip" data-original-title="' . trans('admin/action.actionButtion.show') . '"  data-placement="top"><i class="fa fa-search"></i></a>';
				}
				return '<a href="'.url('admin/'.$this->action.'/'.$this->id).'" class="btn btn-xs btn-info tooltips" data-toggle="modal" data-target="#draggable" data-original-title="' . trans('admin/action.actionButtion.show') . '"  data-placement="top"><i class="fa fa-search"></i></a>';
			}
			return '';
		}
		return '';
	}
	/**
	 * 修改按钮
	 * @author 晚黎
	 * @date   2016-10-31T18:13:50+0800
	 * @return [type]
	 */
	public function getEditActionButton()
	{
		if (Auth::user()->can(config('admin.permissions.'.$this->action.'.edit'))) {
			return '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'" class="btn btn-xs btn-primary tooltips" data-original-title="' . trans('admin/action.actionButtion.edit') . '"  data-placement="top"><i class="fa fa-pencil"></i></a>';
		}
		return '';
	}

	/**
	 * 彻底删除按钮
	 * @author 晚黎
	 * @date   2016-10-31T18:14:39+0800
	 * @param  boolean
	 * @return [type]
	 */
	public function getDestroyActionButton($showType = true)
	{
		if (($this->status == config('admin.global.status.trash')) || $showType == false) {
			if (Auth::user()->can(config('admin.permissions.'.$this->action.'.destory'))) {
				return '<a href="javascript:;" onclick="return false" class="btn btn-xs btn-danger tooltips" data-original-title="' . trans('admin/action.actionButtion.destroy') . '"  data-placement="top" id="destory"><i class="fa fa-trash"></i><form action="'.url('admin/'.$this->action.'/'.$this->id).'" method="POST" name="delete_item" style="display:none"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
			}
		}
		return '';
	}
	/**
	 * 修改用户密码
	 * @author 晚黎
	 * @date   2016-10-31T18:14:48+0800
	 * @return [type]
	 */
	public function getResetActionButton()
	{
		if (Auth::user()->can(config('admin.permissions.'.$this->action.'.reset'))) {
			return '<a href="'.url('admin/user/'.$this->id.'/reset').'" class="btn btn-xs btn-danger tooltips" data-container="body" data-original-title="' . trans('crud.reset') . '"  data-placement="top"><i class="fa fa-lock"></i></a>';
		}
		return '';
	}
	
	/**
	 * 获取按钮
	 * @author 晚黎
	 * @date   2016-10-31T18:14:57+0800
	 * @param  boolean
	 * @return [type]
	 */
	public function getActionButtonAttribute($showType = true)
	{
		return $this->getShowActionButton($showType).
				$this->getResetActionButton().
				$this->getEditActionButton().
				$this->getDestroyActionButton($showType);
	}
}