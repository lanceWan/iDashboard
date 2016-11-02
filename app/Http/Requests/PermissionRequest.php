<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['name'] = 'required';
        // 添加权限
        if (request()->isMethod('POST')) {
            $rules['slug'] = 'required|unique:permissions,slug';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['slug'] = 'required|unique:permissions,slug,'.$this->id;
            $rules['id'] = 'numeric|required';
        }
        return $rules;
    }
    /**
     * 验证信息
     * @author 晚黎
     * @date   2016-11-02T10:25:59+0800
     * @return [type]                   [description]
     */
    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
            'unique'    => trans('validation.unique'),
            'numeric'   => trans('validation.numeric'),
        ];
    }
    /**
     * 字段名称
     * @author 晚黎
     * @date   2016-11-02T10:28:52+0800
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'id'    => trans('admin/permission.model.id'),
            'name'  => trans('admin/permission.model.name'),
            'slug'  => trans('admin/permission.model.slug'),
        ];
    }
}
