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
            'name'=>"required|min:6|max:50"
        ];
    }

    public function message()
    {
        return [
            'name.required'=>'Title không đc để trống',
            'name.min'=>'Title chứa tối thiểu 6 ký tự',
            'name.max'=>'Title chứa tối đa 50 ký tự',
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
