@extends('borrowhistory::layouts.master')

@section('title')
    {!! config('borrowhistory.name') !!}
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <a href="{{ route('borrowhistory.addForm') }}">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-l-lg">
                                Đăng Ký Mượn Sách
                            </button>
                        </a>

                    </div>
                    <input id="search" name="search" type="search" style="right: 0" placeholder="search">
                    <br>
                    <br>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="listDataTable w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3 break-all">
                                        <div class="flex items-center">
                                            Tên Bạn Đọc
                                            <a href="#" class="sortbutton" id="reader_name_sort" data-sort="desc"
                                                data-name="reader_name"><svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 320 512">
                                                    <path
                                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Trạng Thái
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Ngày Mượn
                                            <a href="#" class="sortbutton" id="borrow_date_sort" data-sort="desc"
                                                data-name="borrow_date">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                                    <path
                                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Ngày Trả
                                            <a href="#" class="sortbutton" id="return_date_sort" data-sort="desc"
                                                data-name="return_date">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                                    <path
                                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" colspan="2" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Action
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tblLocations">
                                @if (isset($BorrowHistories))
                                    @foreach ($BorrowHistories as $index => $history)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $index + 1 }}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $history->reader_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $history->borrow_status == 1 ? 'Chưa Trả' : 'Đã Trả' }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white truncate	">
                                                {{ $history->borrow_date }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white truncate	">
                                                {{ $history->return_date }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <a href="{{ route('borrowhistory.view', ['id' => $history->id]) }}" id="history_view"
                                                    data-toggle="modal" data-target="#exampleModalCenter"
                                                    data-id="{{ $history->id }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline history_view_btn">Chi
                                                    Tiết</a>
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <a href="{{ route('borrowhistory.return', ['id' => $history->id]) }}"
                                                    onclick="return confirm('Hoàn Trả Sách ??')"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Hoàn
                                                    Trả</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                        </table>
                        <br>
                        @if (isset($BorrowHistories))
                            {!! $BorrowHistories->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="exampleModalCenterBody">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tên Bạn Đọc
                            </label>
                            <p id="reader_name"> </p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                ID
                            </label>
                            <p id="reader_id"> </p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Phân Loại Bạn Đọc
                            </label>
                            <p id="reader_status"> </p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Địa Chỉ
                            </label>
                            <p id="reader_address"> </p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Số Điện Thoại
                            </label>
                            <p id="reader_phone"> </p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Sách Mượn
                            </label>
                            <div id="borrow_book">

                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Ngày Mượn
                            </label>
                            <p id="borrow_date"> </p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Ngày Trả
                            </label>
                            <p id="return_date"> </p>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="Content">
                                Ghi Chú
                            </label>
                            <p id="note"> </p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <a href="#" class="btn btn-primary" id="his_edit_button">Chỉnh Sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ Module::asset('BorrowHistory:js/paginate.js') }}"></script>
<script src="{{ Module::asset('BorrowHistory:js/sort.js') }}"></script>
<script src="{{ Module::asset('BorrowHistory:js/search.js') }}"></script>
<script>
    $('.history_view_btn').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#his_edit_button').attr('href', window.location.href + '/edit/' +id)
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response){
                let data = response.data;
                let books = response.bookData;
                $('#borrow_book').html('');
                $.each( books, function( key, value ) {
                    let html = `<p>Tên Sách : `+value['book_name']+` (Số Lượng : `+value['amount']+`)</p>`
                    $('#borrow_book').append(html);
                })
                $.each( data, function( key, value ) {
                    $('#'+key).html(value);
                    if (key == 'reader_status') {
                        $('#'+key).html(value == 1 ? "Đã Đăng Ký" : "Chưa Đăng Ký");
                    } else if(key == 'return_date') {
                        if (value == '' || value == null) {
                            $('#'+key).html("Chưa Hoàn Trả Sách")
                        } else {
                            $('#'+key).html(value);
                        }
                    }
                });
            }
        })
    })
</script>

@endsection
