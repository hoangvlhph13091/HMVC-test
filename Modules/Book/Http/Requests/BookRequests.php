<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"required|min:6|max:50|unique:books"
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Title không đc để trống',
            'name.min'=>'Title chứa tối thiểu 6 ký tự',
            'name.max'=>'Title chứa tối đa 50 ký tự',
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
