@extends('book::layouts.master')

@section('title')
    {!! config('book.name') !!}
@endsection


@section('content')
    <div class="card card-primary">
        <a
            href="{{ route('book') }}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="back_link">back</a>
        <br>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="receiptForm">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Unique ID</label>
                            <input type="text" class="form-control" id="receipt_unique_id" name="receipt_unique_id" readonly value="{{ uniqid() }}">
                            <span class="text-red-600 err_text" id="receipt_unique_id_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ngày Nhập</label>
                            <input type="date" class="form-control" id="receipt_date" name="receipt_date" placeholder="Ngày Nhập" value="{{ now()->format('Y-m-d')  }}">
                            <span class="text-red-600 err_text" id="receipt_date_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nguồn Nhập</label>
                            <input type="text" class="form-control" id="receipt_source" name="receipt_source" placeholder="Nguồn Nhập">
                            <span class="text-red-600 err_text" id="receipt_source_err"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Người Nhập</label>
                            <input type="text" class="form-control" readonly id="receipt_person" name="receipt_person" placeholder="Tác Giả" value="{{ Auth::user()->name }}">
                            <span class="text-red-600 err_text" id="receipt_person_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ghi Chú</label>
                            <textarea id="receipt_note" name="receipt_note" rows="3"
                                        class="form-control"
                                        placeholder="Ghi Chú...."></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên Sách</label>
                            <input type="text" class="form-control book_name" data-id="0" id="name" name="name[]" placeholder="Tên Sách">
                            <span class="text-red-600 err_text" id="name_0_err"></span>
                            <input type="hidden" name="book_id[0]" id="book_id_0" >
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá Bìa</label>
                            <input type="text" class="form-control" id="price[]" name="price[]" placeholder="Giá Bìa">
                            <span class="text-red-600 err_text" id="price_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tác Giả</label>
                            <input type="text" class="form-control" id="author" name="author[]" placeholder="Tác Giả">
                            <span class="text-red-600 err_text" id="author_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Phân Loại
                            </label>
                            <select class="select2" name="tag[]" data-placeholder="Select a State" style="width: 100%;">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-600 err_text" id="tag_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Khu Vực</label>
                            <select id="area" name="area[]" class="form-control select2">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->book_area_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-red-600 err_text" id="area_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng</label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount[]" placeholder="Số Lượng">
                            <span class="text-red-600 err_text" id="total_amount_0_err"></span>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm Tắt</label>
                            <input type="text" class="form-control" id="overview[]" name="overview[]" placeholder="Tóm Tắt">
                        </div>
                    </div>
                    <div class="col-sm-2">

                    </div>
                </div>
                <div id="Add_book">

                </div>
                <div class="form-group" style="text-align: center">
                    <button id="add_new_row" class="btn btn-primary">Thêm Sách</button>
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
        $(document).ready(function(){
            $('.select2').select2()
        });

        $('#receiptForm').submit(function(e) {
            e.preventDefault();
            $('.err_text').text('');
            const form = $('#receiptForm')[0];
            const data = new FormData(form);
            const curenturl = window.location.href;
            const backurl = $('#back_link').attr('href');
            console.log(data);

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
                    console.log(errors);
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
        let counter = 0;
        $('#add_new_row').on('click', function(e){
            e.preventDefault();
            counter ++
            let html = `<div class="row book_add_row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên Sách</label>
                                    <input type="text" class="form-control book_name" data-id="`+counter+`" id="name" name="name[`+counter+`]" placeholder="Tên Sách">
                                    <span class="text-red-600 err_text" id="name_`+counter+`_err"></span>
                                    <input type="hidden" name="book_id[`+counter+`]" id="book_id_0" >
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giá Bìa</label>
                                    <input type="text" class="form-control" id="price" name="price[`+counter+`]" placeholder="Giá Bìa">
                                    <span class="text-red-600 err_text" id="price_`+counter+`_err"></span>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tác Giả</label>
                                    <input type="text" class="form-control" id="author" name="author[`+counter+`]" placeholder="Tác Giả">
                                    <span class="text-red-600 err_text" id="author_`+counter+`_err"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                        Phân Loại
                                    </label>
                                    <select class="select2" name="tag[`+counter+`]" data-placeholder="Select a State" style="width: 100%;">
                                        @foreach ($categories as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-red-600 err_text" id="tag_`+counter+`_err"></span>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Khu Vực</label>
                                    <select id="area" name="area[`+counter+`]" class="form-control">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->book_area_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-red-600 err_text" id="area_`+counter+`_err"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số Lượng</label>
                                    <input type="number" class="form-control" id="total_amount" name="total_amount[`+counter+`]" placeholder="Số Lượng">
                                    <span class="text-red-600 err_text" id="total_amount_`+counter+`_err"></span>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm Tắt</label>
                                    <input type="text" class="form-control" id="overview" name="overview[`+counter+`]" placeholder="Tóm Tắt">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button style="margin-top: 32px;" class="btn btn-danger btn_delete_row">Xóa Hàng</button>
                                </div>
                            </div>
                        </div>`;
                    $('#Add_book').append(html);
                    $('.select2').select2()

        })

        $(document).on('click', '.btn_delete_row', function(e){
            e.preventDefault()
            $(this).closest(".book_add_row").remove();
        })

        $(document).on('blur', '.book_name', function(e){
            e.preventDefault()
            if ($.trim($(this).val()) == '') {
                return;
            }

            let url = "{{ route('book.search_book') }}"
            let name = $.trim($(this).val());
            let id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    name: name,
                },
                success: function(response) {
                    if (response != '') {
                        $('#book_id_'+id).val(response).change();
                    } else {
                        $('#book_id_'+id).val('').change();
                    }
                }
            })
        })
    </script>
@endsection
