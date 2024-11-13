@extends('book::layouts.master')

@section('title')
    {!! config('book.name') !!}
@endsection


@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('book') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                        id="back_link">back</a>
                    <br>
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="BookForm" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tên Sách
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" name="name" type="text" value="{{ $book->name }}"
                                placeholder="Tên Sách">
                            <span class="text-red-600 err_text" id="name_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Giá Tiền
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="price" type="number" value="{{ $book->price }}"
                                placeholder="Giá Tiền">
                            <span class="text-red-600 err_text" id="price_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Hình Ảnh
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="image" name="image" type="text" placeholder="Hình Ảnh" value="{{ $book->image }}">
                            <span class="text-red-600 err_text" id="image_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tác Giả
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="author" name="author" type="text" placeholder="Tác Giả" value="{{ $book->author }}">
                            <span class="text-red-600 err_text" id="author_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Khu Vực
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="area" name="area" type="text" placeholder="Khu Vực" value="{{ $book->area }}">
                            <span class="text-red-600 err_text" id="area_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Post ID
                            </label>
                            <div id="tag_warp">
                                <p id="tag_target_list"></p>
                                <input type="text" class="tag_target" name="" readonly placeholder="click_me"
                                    id="tag_target">
                            </div>
                            <div id="actuall_input">

                            </div>
                            <div id="nested_list_warp" class="hide">
                                <ul id="myUL">
                                    {!! Modules\Category\Http\Controllers\CategoryController::tree_view_selection($categories) !!}
                                </ul>
                            </div>
                            <span class="text-red-600 err_text" id="tag_err"></span>
                        </div>
                        @foreach ($book->bookCategory as $item)
                            <input type="hidden" class="book_tag_value" value="{{ $item->category_id }}">
                        @endforeach
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Số Lượng
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="total_amount" name="total_amount" type="number" placeholder="Số Lượng" value="{{ $book->total_amount }}">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="Content">
                                Tóm Tắt
                            </label>
                            <textarea id="overview" name="overview" rows="3"
                                class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"
                                placeholder="insert content here">{{ $book->overview }}</textarea>
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
    <script src="{{ Module::asset('Category:js/viewTree.js') }}"></script>
    <script>
        $('#tag_target').click(function() {
            $('#nested_list_warp').toggle('hide');
        })

        $('input[id^="check_box"]').each(function() {
            $(this).click(function() {
                if ($(this).is(':checked')) {
                    $('#tag_target_list').append(
                        `<span class="tag_bagde" data-id="${$(this).data('id')}" >${$(this).data('value')} <span class="tag_close" data-id="${$(this).data('id')}" >x</span> </span>`
                        )
                    $('#actuall_input').append(
                        `<input type="text" hidden name="tag[]" id="tag_no_${$(this).data('id')}" value="${$(this).data('id')}">`
                        )
                } else if ($(this).not(':checked')) {
                    $(`span[data-id^="${$(this).data('id')}"]`).remove()
                    $(`input[id^="tag_no_${$(this).data('id')}"]`).remove()
                }
            })
        })

        $(document).on("click", "span.tag_close", function() {
            $(this).parent().remove();
            $(`input[id^="tag_no_${$(this).data('id')}"]`).remove()
            $(`input[data-id^="${$(this).data('id')}"]`).prop('checked', false);
        });

        $(document).ready(function() {
            var listCate = [];
            $('input[class^="book_tag_value"]').each(function() {
                listCate.push($(this).val());
            })
            $('input[id^="check_box"]').each(function() {
                if (listCate.includes($(this).attr('data-id'))) {
                    $(this).prop("checked", true).change();
                }
            })

            $('input[id^="check_box"]').each(function() {
                if ($(this).is(':checked')) {
                    $('#tag_target_list').append(
                        `<span class="tag_bagde" data-id="${$(this).data('id')}" >${$(this).data('value')} <span class="tag_close" data-id="${$(this).data('id')}" >x</span> </span>`
                        )
                    $('#actuall_input').append(
                        `<input type="text" hidden name="tag[]" id="tag_no_${$(this).data('id')}" value="${$(this).data('id')}">`
                        )
                } else if ($(this).not(':checked')) {
                    $(`span[data-id^="${$(this).data('id')}"]`).remove()
                    $(`input[id^="tag_no_${$(this).data('id')}"]`).remove()
                }
            })
        });

        $('#BookForm').submit(function(e){
            e.preventDefault();
            $('.err_text').text('');
            const form = $('#BookForm')[0];
            const data = new FormData(form);
            const curenturl = window.location.href;
            const backurl = $('#back_link').attr('href');
            $.ajax({
                type: 'POST',
                enctype: "multipart/form-data",
                url: curenturl,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(){
                    window.location.replace(backurl);
                },
                error: function(response){
                    let errors = response.responseJSON.errors;
                    console.log(errors);
                    $.each( errors, function( key, value ) {
                        console.log(key);
                        console.log(value[0]);
                        $('#'+key+'_err').text(value[0])
                    })
                }
            })
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ Module::asset('Category:css/viewtree.css') }}">
@endsection

