<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookEditRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"required|min:6|max:50|unique:books,name,".$this->id,
            'tag'=>"required",
            // 'tag.*'=>"required|distinct",
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên sách không được để trống',
            'name.min'=>'Tên sách chứa tối thiểu 6 ký tự',
            'name.max'=>'Tên sách chứa tối đa 50 ký tự',
            'name.unique'=>'Tên sách mục bị trùng',
            // 'tag.required'=>'Hãy Chọn Ít Nhất 1 Hạng Mục Phân Loại',
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
