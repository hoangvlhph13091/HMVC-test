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

                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="historyFrom" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tên Bạn Đọc
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_name" name="reader_name" type="text" placeholder="Tên Bạn Đọc">
                                <span class="text-red-600 err_text" id="reader_name_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                ID
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_id" name="reader_id" type="text" placeholder="id">
                                <span class="text-red-600 err_text" id="reader_id_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Phân Loại Bạn Đọc
                            </label>
                            <Select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="reader_status" id="reader_status">
                                <Option class="reder_register" id="reader_registed" value="1">Đã Đăng Ký</Option>
                                <Option class="reder_register" id="reader_not_resgisterd" value="0">Chưa Đăng Ký</Option>
                            </Select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Địa Chỉ
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_address" name="reader_address" type="text" placeholder="Địa Chỉ">
                                <span class="text-red-600 err_text" id="reader_address_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Số Điện Thoại
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reader_tel" name="reader_phone" type="text" placeholder="Số Điện Thoại">
                                <span class="text-red-600 err_text" id="reader_phone_err"></span>
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

                                    <tr>
                                        <td class="col-sm-8" style="padding-left: 0">
                                              <select id="select-state" class="form-control" name="book_id[]">
                                                <option value="">Select a state...</option>
                                                @foreach ($books as $book)
                                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                                @endforeach
                                              </select>
                                        </td>
                                        <td class="col-sm-2" style="padding-left: 0">
                                            <input type="text" name="amount[]"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                        </td>
                                        <td class="col-sm-2"><a class="deleteRow"></a>
                                        </td>
                                    </tr>
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
                            <p class="text-red-600 err_text" id="book_id_err"></p>
                            <p class="text-red-600 err_text" id="amount_err"></p>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="Content">
                                Ghi Chú
                            </label>
                            <textarea id="Content" name="note" rows="3"
                                class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"
                                placeholder="insert content here"></textarea>
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
        $(document).on('change','#reader_status',function(){
            $('#reader_name').val('').change();
            $('#reader_id').val('').change();
            $('#reader_address').val('').change();
            $('#reader_tel').val('').change();
            $('.reder_register').each(function(){
                if ($(this).is(':selected')) {
                    if ($(this).attr('id') == "reader_registed") {
                        $('#reader_name').prop('readonly', true).change();
                        $('#reader_id').prop('readonly', false).change();
                        $('#reader_tel').prop('readonly', true).change();
                        $('#reader_address').prop('readonly', true).change();
                    } else if ($(this).attr('id') == "reader_not_resgisterd") {
                        $('#reader_name').prop('readonly', false).change();
                        $('#reader_id').prop('readonly', true).change();
                        $('#reader_tel').prop('readonly', false).change();
                        $('#reader_address').prop('readonly', false).change();
                    }
                }
            })
        });
        $('#reader_id').on('blur', function() {
            if ($.trim($(this).val()) == '' ) {
                return;
            }
            let id = $.trim($(this).val())
            let url = "{{ route('borrowhistory.findUser') }}"
            $.ajax({
                type: 'GET',
                url: url,
                data: { id: id },
                success: function(response){
                    let cust = response.customer
                    $('#reader_name').val(cust.name);
                    $('#reader_address').val(cust.address);
                    $('#reader_tel').val(cust.phone_number);
                }
            })
        })
        $(document).ready(function() {
            var counter = 0;
            $('#select-state').selectize({
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

            $('.reder_register').each(function(){
                if ($(this).is(':selected')) {
                    if ($(this).attr('id') == "reader_registed") {
                        $('#reader_name').prop('readonly', true).change();
                        $('#reader_id').prop('readonly', false).change();
                        $('#reader_tel').prop('readonly', true).change();
                        $('#reader_address').prop('readonly', true).change();
                    } else if ($(this).attr('id') == "reader_not_resgisterd") {
                        $('#reader_name').prop('readonly', false).change();
                        $('#reader_id').prop('readonly', true).change();
                        $('#reader_tel').prop('readonly', false).change();
                        $('#reader_address').prop('readonly', false).change();
                    }
                }
            })

            $("#book_borrow_list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1
            });
        });

        $('#historyFrom').submit(function(e) {
                e.preventDefault();
                $('.err_text').text('');
                const form = $('#historyFrom')[0];
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
                    success: function() {
                        window.location.replace(backurl);
                    },
                    error: function(response){
                        let errors = response.responseJSON.errors;
                        console.log(errors);
                        $.each( errors, function( key, value ) {
                            if (key.includes('book_id')) {
                                $('#book_id_err').text(value[0]);
                            } else if(key.includes('amount')){
                                $('#amount_err').text(value[0]);
                            } else {
                                $('#'+key+'_err').text(value[0]);
                            }
                        })
                    }
                })
            })

    </script>
@endsection
