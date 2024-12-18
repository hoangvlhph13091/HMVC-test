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
        <form id="BookForm" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên Sách</label>
                    <input type="text" class="form-control" id="name" name="name" type="text" placeholder="Tên Sách">
                    <span class="text-red-600 err_text" id="name_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Giá Bìa</label>
                    <input type="text" class="form-control" id="price" name="price" type="number" placeholder="Giá Tiền">
                    <span class="text-red-600 err_text" id="price_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tác Giả</label>
                    <input type="text" class="form-control" id="author" name="author" type="text" placeholder="Tác Giả">
                    <span class="text-red-600 err_text" id="author_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Khu Vực</label>
                    <select id="area" name="area" class="form-control">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->book_area_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-red-600 err_text" id="area_err"></span>
                </div>
                <div class="form-group">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Phân Loại
                    </label>
                    <select class="select2" name="tag" data-placeholder="Select a State" style="width: 100%;">
                        @foreach ($categories as $cate)
                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-red-600 err_text" id="tag_0_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Số Lượng</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount" type="number" placeholder="Số Lượng">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tóm Tắt</label>
                    <textarea id="overview" name="overview" rows="3"
                                class="form-control"
                                placeholder="Tóm Tắt...."></textarea>
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
    <script src="{{ Module::asset('Category:js/viewTree.js') }}"></script>
    <link rel="stylesheet" href="{{ Module::asset('Category:css/viewtree.css') }}">
    <script>
        $(document).ready(function(){
            $('.select2').select2()
        });

        $('#BookForm').submit(function(e) {
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
                success: function() {
                    window.location.replace(backurl);
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    console.log(errors);
                    $.each(errors, function(key, value) {
                        console.log(key);
                        console.log(value[0]);
                        $('#' + key + '_err').text(value[0])
                    })
                }
            })
        })
    </script>
@endsection
