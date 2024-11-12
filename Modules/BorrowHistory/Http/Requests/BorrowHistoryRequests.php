<?php

namespace Modules\BorrowHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowHistoryRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reader_name'=>"required",
            'reader_phone'=>"required",
            'reader_address'=>"required",
            'book_id'=>"required|array",
            'book_id.*'=>"required|distinct",
            'amount'=>"required|array",
            'amount.*'=>"required",
        ];
    }

    public function messages()
    {
        return [
            'reader_name.required'=>'Tên bạn đọc không được để trống',
            'reader_address.required'=>'Hãy nhập địa chỉ',
            'reader_phone.required'=>'Hãy nhập số điện thoại',
            'book_id.required'=>'Hãy chọn ít nhất 1 tựa sách',
            'book_id.*.required'=>'Hãy chọn ít nhất 1 tựa sách',
            'book_id.*.distinct'=>'Các tựa sách được lựa chọn đang có trùng lặp',
            'amount.*.required'=>'Hãy nhập số lượng sách mượn',
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
