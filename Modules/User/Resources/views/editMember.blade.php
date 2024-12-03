@extends('user::layouts.master')

@section('title')
    {!! config('user.name') !!}
@endsection


@section('content')
    <div class="card card-primary">
        <a href="{{ route('user') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
            id="back_link">back</a>
        <br>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="UserForm">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên Thành Viên</label>
                    <input class="form-control" id="name" name="name" type="text" placeholder="Tên Thành Viên"
                        value="{{ $user->name }}">
                    <span class="text-red-600 err_text" id="name_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input class="form-control" id="email" name="email" type="text" placeholder="Email"
                        value="{{ $user->email }}">
                    <span class="text-red-600 err_text" id="email_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mật Khẩu</label>
                    <input class="form-control" id="password" name="password" type="password" placeholder="Mật Khẩu"
                        value="********">
                    <span class="text-red-600 err_text" id="password_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Xác Nhận Mật Khẩu</label>
                    <input class="form-control" id="confirm_password" name="confirm_password" type="password"
                        value="********" placeholder="Xác Nhận Mật Khẩu">
                    <span class="text-red-600 err_text" id="confirm_password_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Chức Vụ</label>
                    <Select class="form-control" name="member_role">
                        <option @if ($user->hasRole('admin')) selected @endif value="admin">Quản Trị Viên</option>
                        <option @if ($user->hasRole('member')) selected @endif value="member">Nhân Viên</option>
                    </Select>
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
        $(document).ready(function() {
            $('#UserForm').submit(function(e) {
                e.preventDefault();
                $('.err_text').text('');
                const form = $('#UserForm')[0];
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
        })
    </script>
@endsection
