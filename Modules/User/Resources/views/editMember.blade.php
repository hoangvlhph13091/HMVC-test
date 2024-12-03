@extends('user::layouts.master')

@section('title')
    {!! config('user.name') !!}
@endsection


@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a
                        href="{{ route('user') }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="back_link">back</a>
                    <br>
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="UserForm" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tên Thành Viên
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" name="name" type="text" placeholder="Tên Thành Viên" value="{{ $user->name }}">
                            <span class="text-red-600 err_text" id="name_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Email
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" name="email" type="text" placeholder="Email" value="{{ $user->email }}">
                            <span class="text-red-600 err_text" id="email_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Mật Khẩu
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="password" name="password" type="password" placeholder="Mật Khẩu" value="********">
                            <span class="text-red-600 err_text" id="password_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Xác Nhận Mật Khẩu
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="confirm_password" name="confirm_password" type="password" placeholder="Xác Nhận Mật Khẩu" value="********">
                            <span class="text-red-600 err_text" id="confirm_password_err" ></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Chức Vụ
                            </label>
                            <Select class="form-control" name="member_role">
                                <option @if ($user->hasRole('admin')) selected @endif value="admin">Quản Trị Viên</option>
                                <option @if ($user->hasRole('member')) selected @endif value="member">Nhân Viên</option>
                            </Select>
                            <span class="text-red-600 err_text" id="name_err"></span>
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
    })
</script>
@endsection