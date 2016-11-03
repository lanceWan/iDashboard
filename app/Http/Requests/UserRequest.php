<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules['name']      = 'required';
        $rules['email']     = 'email';
        // 添加权限
        if (request()->isMethod('POST')) {
            $rules['username'] = 'required|unique:users,username';
            $rules['password']  = 'required';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['username'] = 'required|unique:users,username,'.$this->id;
            $rules['id'] = 'numeric|required';
        }
        return $rules;
    }

    /**
     * 验证信息
     * @author 晚黎
     * @date   2016-11-03T14:52:55+0800
     * @return [type]                   [description]
     */
    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
            'unique'    => trans('validation.unique'),
            'numeric'   => trans('validation.numeric'),
            'email'     => trans('validation.email'),
        ];
    }
    /**
     * 字段名称
     * @author 晚黎
     * @date   2016-11-03T14:52:38+0800
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'id'        => trans('admin/user.model.id'),
            'name'      => trans('admin/user.model.name'),
            'username'  => trans('admin/user.model.username'),
            'email'     => trans('admin/user.model.email'),
        ];
    }
}
