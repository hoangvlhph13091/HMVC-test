@extends('borrowhistory::layouts.master')

@section('title')
    {!! config('borrowhistory.name') !!}
@endsection


@section('content')
    <div class="card card-primary">
        <a href="{{ route('borrowhistory') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
            id="back_link">back</a>
        <br>
        <div class="card">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="quan_ly_sach-tab" data-toggle="pill" href="#quan_ly_sach" role="tab"
                        aria-controls="quan_ly_sach-home" aria-selected="true">Trả theo đầu sách</a>
                </li>
            </ul>

            <div class="tab-content" id="quan_ly_sach-tabContent">
                <div class="tab-pane fade show active" id="quan_ly_sach" role="tabpanel"
                    aria-labelledby="custom-content-below-home-tab">
                    <form action="" id="book_return_form">
                        @csrf
                        <br>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên Bạn Đọc</label>
                                <select id="select_name" class="form-control select_book">
                                    <option value="">Chọn Bạn Đọc</option>
                                    @foreach ($customers as $cust)
                                        <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-red-600 err_text" id="book_id_0_err"></span>
                            </div>
                        </div>
                        <div id="append_book_area" style=" padding: 10px;">

                        </div>
                    </form>
                </div>
            </div>


            <!-- /.card-body -->
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $('#select_name').select2();
        $('#select_name').on('change', function(e) {
            if ($.trim($(this).val()) == '') {
                return;
            }

            let id = $.trim($(this).val())
            let url = "{{ route('borrowhistory.returnBookForm.getUserInfo') }}"
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                success: function(response) {
                    $('#append_book_area').html('').change();
                    $('#append_book_area').html(response).change();
                }
            })
        })

        $('#book_return_form').on('submit', function(e) {
            e.preventDefault();
            const form = $('#book_return_form')[0];
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
                success: function(response) {
                    window.location.replace(backurl);
                }
            })
        })

        $(document).on("change", "input.checkbox_status", function() {
            var index = $(this).attr('data-index');
           if ($(this).is(":checked")) {
                $("#status_"+index).val(1).change()
           } else(
                $("#status_"+index).val(0).change()
           )
        })
    </script>
@endsection
