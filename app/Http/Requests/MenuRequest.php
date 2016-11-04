<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class MenuRequest extends FormRequest
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
        return [
            'name'      => 'required',
            'language'  => 'required',
            'slug'      => 'required',
        ];
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
            'name'      => trans('admin/menu.model.name'),
            'language'  => trans('admin/menu.model.language'),
            'slug'      => trans('admin/menu.model.slug'),
        ];
    }
}
