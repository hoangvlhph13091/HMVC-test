@extends('borrowhistory::layouts.master')

@section('title')
    {!! config('borrowhistory.name') !!}
@endsection


@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('borrowhistory') }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="back_link">back</a>

                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="BookForm" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tên Bạn Đọc
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_name" name="reader_name" disabled type="text" placeholder="Name" value="{{ $history->reader_name }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                ID
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_id" name="reader_id" disabled type="text" placeholder="id" value="{{ $history->reader_id }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Phân Loại Bạn Đọc
                            </label>
                            <Select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="reader_status" id="reader_status">
                                <Option @if ($history->reader_status == 1) selected @endif class="reder_register" id="reader_registed" value="1">Đã Đăng Ký</Option>
                                <Option @if ($history->reader_status == 0) selected @endif class="reder_register" id="reader_not_resgisterd" value="0">Chưa Đăng Ký</Option>
                            </Select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Địa Chỉ
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_address" disabled name="reader_address" type="text" placeholder="address" value="{{ $history->reader_address }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Số Điện Thoại
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_tel" name="reader_phone" type="text" placeholder="phone" value="{{ $history->reader_phone }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Sách Mượn
                            </label>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Tên Sách</td>
                                        <td>Số Lượng</td>
                                    </tr>
                                </thead>
                                <tbody id="book_borrow_list">
                                    @foreach ($history->historyDetail as $item)
                                        <tr>
                                            <td class="col-sm-8" style="padding-left: 0">
                                                <select id="" class="select-book form-control" name="book_id[]">
                                                    <option value="">Select a book</option>
                                                    @foreach ($books as $book)
                                                        <option @if ($item->book_id == $book->id) selected @endif value="{{ $book->id }}">{{ $book->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="col-sm-2" style="padding-left: 0">
                                                <input type="text" name="amount[]"
                                                    value="{{ $item->amount }}"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                            </td>
                                            <td class="col-sm-2"><a class="deleteRow"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding-top: 10px">
                                            <input type="button" class="btn btn-primary" id="addrow"
                                                value="Add Row" />
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="Content">
                                Ghi Chú
                            </label>
                            <textarea id="Content" name="note" rows="3"
                                class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"
                                placeholder="insert content here">{{ $history->note }}</textarea>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center rounded-md bg-blue-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var counter = 0;
            $('.select-book').selectize({
                sortField: 'text'
            });

            $("#addrow").on("click", function() {
                var newrow =    `<tr>
                                    <td class="col-sm-8" style="padding-left: 0; padding-top: 10px">
                                       <select id="select_book_input_`+counter+`" name="book_id[]" placeholder="Pick a state...">
                                                <option value="">Select a state...</option>
                                                @foreach ($books as $book)
                                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                                @endforeach
                                        </select>
                                    </td>
                                    <td class="col-sm-2" style="padding-left: 0; padding-top: 10px">
                                        <input type="mail" name="amount[]"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                    </td>
                                    <td class="col-sm-2"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></a>
                                    </td>
                                </tr>`;
                $("#book_borrow_list").append(newrow);
                $('#select_book_input_'+counter).selectize({
                    sortField: 'text'
                });
                counter++;
            });

            $("#book_borrow_list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1
            });
        });
    </script>
@endsection
