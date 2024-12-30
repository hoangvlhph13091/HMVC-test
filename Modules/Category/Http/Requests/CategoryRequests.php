<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"required|min:6|max:50|unique:categories"
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên phân loại không đc để trống',
            'name.min'=>'Tên phân loại chứa tối thiểu 6 ký tự',
            'name.max'=>'Tên phân loại chứa tối đa 50 ký tự',
            'name.unique'=>'Tên hạng mục bị trùng',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
