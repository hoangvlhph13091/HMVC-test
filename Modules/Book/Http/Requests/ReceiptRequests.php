<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'receipt_unique_id'=>"required|unique:book_import_receipt,receipt_unique_id",
            'receipt_date' => "required",
            'name'=>"required|array",
            'name.*'=>"required|distinct|min:6|max:50",
            'tag'=>"required|array",
            'tag.*'=>"required",
        ];
    }

    public function messages()
    {
        return [
            'name.*.required'=>'Tên sách không được để trống',
            'name.*.min'=>'Tên sách chứa tối thiểu 6 ký tự',
            'name.*.max'=>'Tên sách chứa tối đa 50 ký tự',
            'tag.required'=>'Hãy Chọn Ít Nhất 1 Hạng Mục Phân Loại',
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
