@extends('setting::layouts.master')

@section('content')
    <div class="card card-primary">
        <br>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="setting_form">
            @csrf
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <label for="">Chọn Ảnh Hệ Thống</label>
                        <div class="custom-file">
                            <input type="file"  name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            bsCustomFileInput.init();
        });

        $('#setting_form').submit(function(e) {
            e.preventDefault();
            const form = $('#setting_form')[0];
            const data = new FormData(form);
            const curenturl = window.location.href;
            const postUrl = '{{ route('setting.saveImage') }}'
            $.ajax({
                type: 'POST',
                enctype: "multipart/form-data",
                url: postUrl,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function() {
                    window.location.replace(curenturl);
                },
            })
        })
    </script>
@endsection

