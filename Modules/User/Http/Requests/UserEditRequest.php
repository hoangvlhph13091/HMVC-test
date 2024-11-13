<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"required|min:6|max:50|unique:users,name,".$this->id,
            'email'=>"required|min:6|max:50|unique:users,email,".$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên Người Dùng không được để trống',
            'name.min'=>'Tên Người Dùng chứa tối thiểu 6 ký tự',
            'name.max'=>'Tên Người Dùng chứa tối đa 50 ký tự',
            'name.unique'=>'Tên Người Dùng bị trùng',

            'email.required'=>'Email Người Dùng không được để trống',
            'email.min'=>'Email Người Dùng chứa tối thiểu 6 ký tự',
            'email.max'=>'Email Người Dùng chứa tối đa 50 ký tự',
            'email.unique'=>'Email Người Dùng bị trùng',
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
