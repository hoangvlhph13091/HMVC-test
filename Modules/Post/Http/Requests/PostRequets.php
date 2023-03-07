<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequets extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>"required|min:6|max:50"
        ];
    }

    public function message()
    {
        return [
            'title.required'=>'Title không đc để trống',
            'title.min'=>'Title chứa tối thiểu 6 ký tự',
            'title.max'=>'Title chứa tối đa 50 ký tự',
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
