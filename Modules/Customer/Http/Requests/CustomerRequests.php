<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"required|unique:customer",
            'date_of_birth'=>"required",
            'address'=>"required",
            'phone_number'=>"required|numeric",
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên bạn đọc không được để trống',
            'name.unique'=>'Tên bạn đọc đã tồn tại',
            'date_of_birth.required'=>'Hãy nhập ngày sinh',
            'address.required'=>'Hãy nhập địa chỉ',
            'phone_number.required'=>'Hãy nhập số điện thoại',
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
