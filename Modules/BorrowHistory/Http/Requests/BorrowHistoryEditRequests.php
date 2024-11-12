<?php

namespace Modules\BorrowHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowHistoryEditRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_id'=>"required|array",
            'book_id.*'=>"required|distinct",
            'amount'=>"required|array",
            'amount.*'=>"required",
        ];
    }

    public function messages()
    {
        return [
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
