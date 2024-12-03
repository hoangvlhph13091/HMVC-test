@extends('borrowhistory::layouts.master')

@section('title')
    {!! config('borrowhistory.name') !!}
@endsection


@section('content')
    <div class="card card-primary">
        <a href="{{ route('borrowhistory') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
            id="back_link">back</a>
        <br>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="historyFrom">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Bạn Đọc</label>
                            <input class="form-control" id="reader_name" name="reader_name" type="text"
                                placeholder="Tên Bạn Đọc">
                            <span class="text-red-600 err_text" id="reader_name_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1"> ID</label>
                            <input class="form-control" id="reader_id" name="reader_id" type="text" placeholder="id">
                            <span class="text-red-600 err_text" id="reader_id_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phân Loại Bạn Đọc</label>
                            <Select class="form-control" name="reader_status" id="reader_status">
                                <Option class="reder_register" id="reader_registed" value="1">Đã Đăng Ký</Option>
                                <Option class="reder_register" id="reader_not_resgisterd" value="0">Chưa Đăng Ký
                                </Option>
                            </Select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa Chỉ</label>
                            <input class="form-control" id="reader_address" name="reader_address" type="text"
                                placeholder="Địa Chỉ">
                            <span class="text-red-600 err_text" id="reader_address_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Điện Thoại</label>
                            <input class="form-control" id="reader_tel" name="reader_phone" type="text"
                                placeholder="Số Điện Thoại">
                            <span class="text-red-600 err_text" id="reader_phone_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phí Mượn Sách (VNĐ)</label>
                            <input class="form-control" id="reader_fee" name="reader_fee" type="number"
                                placeholder="Phí Mượn Sách" value="0">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ngày Mượn</label>
                            <div class="input-group date" id="borrow_date" data-target-input="nearest">
                                <input type="text" name="borrow_date" id="borrow_date_input" class="form-control datetimepicker-input"
                                    data-target="#borrow_date" value="{{ date('Y/m/d') }}" />
                                <div class="input-group-append" data-target="#borrow_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <span class="text-red-600 err_text" id="borrow_date_err"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ngày Hẹn Trả</label>
                            <div class="input-group date" id="return_date" data-target-input="nearest">
                                <input type="text" name="return_date" id="return_date_input" class="form-control datetimepicker-input"
                                    data-target="#return_date" value="{{ date('Y/m/d', strtotime( now(). ' + 1 months')); }}" />
                                <div class="input-group-append" data-target="#return_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <span class="text-red-600 err_text" id="return_date_err"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Sách Mượn
                </label>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Sách</label>
                            <select id="select_book" class="form-control select_book" name="book_id[0]">
                                <option value="">Chọn Sách</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-600 err_text" id="book_id_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng</label>
                            <input type="text" class="form-control" id="amount[0]" name="amount[0]">
                            <span class="text-red-600 err_text" id="amount_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-2">

                    </div>
                </div>
                <div id="book_borrow_list">

                </div>
                <div class="form-group" style="text-align: center">
                    <button id="addrow" class="btn btn-primary">Thêm Sách</button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ghi Chú</label>
                    <textarea id="note" name="note" rows="3" class="form-control" placeholder="Ghi Chú"></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('change', '#reader_status', function() {
            $('#reader_name').val('').change();
            $('#reader_id').val('').change();
            $('#reader_address').val('').change();
            $('#reader_tel').val('').change();
            $('.reder_register').each(function() {
                if ($(this).is(':selected')) {
                    if ($(this).attr('id') == "reader_registed") {
                        $('#reader_name').prop('readonly', true).change();
                        $('#reader_id').prop('readonly', false).change();
                        $('#reader_tel').prop('readonly', true).change();
                        $('#reader_address').prop('readonly', true).change();
                        $('#reader_fee').val(0).change();
                    } else if ($(this).attr('id') == "reader_not_resgisterd") {
                        $('#reader_name').prop('readonly', false).change();
                        $('#reader_id').prop('readonly', true).change();
                        $('#reader_tel').prop('readonly', false).change();
                        $('#reader_address').prop('readonly', false).change();
                        $('#reader_fee').val(20000).change();
                    }
                }
            })
        });
        $('#reader_id').on('blur', function() {
            if ($.trim($(this).val()) == '') {
                return;
            }
            let id = $.trim($(this).val())
            let url = "{{ route('borrowhistory.findUser') }}"
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                success: function(response) {
                    let cust = response.customer
                    $('#reader_name').val(cust.name);
                    $('#reader_address').val(cust.address);
                    $('#reader_tel').val(cust.phone_number);
                }
            })
        })

        $(document).ready(function() {
            $('#borrow_date').datetimepicker({
                format: 'YYYY/MM/DD',
                maxDate: new Date()
            });

            $('#return_date').datetimepicker({
                format: 'YYYY/MM/DD',
                minDate: new Date()
            });

            $('.select_book').select2();

            var counter = 1;

            $("#addrow").on("click", function(e) {
                e.preventDefault();
                var newrow = `<div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Sách</label>
                            <select id="select_book_` + counter + `" class="form-control select_book" name="book_id[` + counter + `]">
                                <option value="">Chọn Sách</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-600 err_text" id="book_id_` + counter + `_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng</label>
                            <input type="text" class="form-control" id="amount[` + counter + `]" name="amount[` + counter + `]
                                placeholder="Giá Bìa">
                            <span class="text-red-600 err_text" id="amount_` + counter + `_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="button" style="margin-top: 32px;" class="btn btn-md btn-danger ibtnDel"  value="Delete">
                    </div>
                </div>`;
                $("#book_borrow_list").append(newrow);
                $('#select_book_'+counter).select2();
                counter++;
            });

            $('.reder_register').each(function() {
                if ($(this).is(':selected')) {
                    if ($(this).attr('id') == "reader_registed") {
                        $('#reader_name').prop('readonly', true).change();
                        $('#reader_id').prop('readonly', false).change();
                        $('#reader_tel').prop('readonly', true).change();
                        $('#reader_address').prop('readonly', true).change();
                        $('#reader_fee').val(0).change();
                    } else if ($(this).attr('id') == "reader_not_resgisterd") {
                        $('#reader_name').prop('readonly', false).change();
                        $('#reader_id').prop('readonly', true).change();
                        $('#reader_tel').prop('readonly', false).change();
                        $('#reader_address').prop('readonly', false).change();
                        $('#reader_fee').val(20000).change();
                    }
                }
            })

            $("#book_borrow_list").on("click", ".ibtnDel", function(event) {
                $(this).closest(".row").remove();
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
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        let keyArr = key.split(".");
                        if (keyArr[1] != undefined) {
                            $('#' + keyArr[0] + '_' + keyArr[1] + '_err').text(value[0])
                        } else {
                            $('#' + key + '_err').text(value[0])
                        }
                    })
                }
            })
        })
    </script>
@endsection
