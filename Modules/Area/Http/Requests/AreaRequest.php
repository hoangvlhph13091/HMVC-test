<?php

namespace Modules\Area\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_area_name'=>"required|min:6|max:50|unique:book_area",

        ];
    }

    public function messages()
    {
        return [
            'book_area_name.required'=>'Tên khu vực không được để trống',
            'book_area_name.min'=>'Tên khu vực chứa tối thiểu 6 ký tự',
            'book_area_name.max'=>'Tên khu vực chứa tối đa 50 ký tự',
            'book_area_name.unique'=>'Tên khu vực mục bị trùng',
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
