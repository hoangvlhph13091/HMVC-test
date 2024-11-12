@extends('customer::layouts.master')

@section('title')
    {!! config('book.name') !!}
@endsection


@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a
                    href="{{ route('customer') }}"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="back_link">back</a>
                    <br>
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" id="Customer_Form" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tên Bạn Đọc
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" name="name" type="text" value="{{ $cust->name }}" placeholder="Tên Bạn Đọc">
                                <span class="text-red-600 err_text" id="name_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tuổi
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="age" type="number" value="{{ $cust->age }}" placeholder="Tuổi">
                                <span class="text-red-600 err_text" id="age_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Giới Tính
                            </label>
                            <Select name="sex" class="form-control">
                                <option {{ $cust->sex == 1 ? 'selected' : '' }} value="1">Male</option>
                                <option {{ $cust->sex == 0 ? 'selected' : '' }} value="0">Female</option>
                            </Select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Ngày Sinh
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="date_of_birth" value="{{ $cust->date_of_birth }}" type="date" placeholder="Ngày Sinh">
                                <span class="text-red-600 err_text" id="date_of_birth_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Địa Chỉ
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="address" type="text" value="{{ $cust->address }}" placeholder="Địa Chỉ">
                                <span class="text-red-600 err_text" id="address_err"></span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Số Điện Thoại
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="phone_number" type="number" value="{{ $cust->phone_number }}" placeholder="Số Điện Thoại">
                                <span class="text-red-600 err_text" id="phone_number_err"></span>
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
        $(document).ready(function(){
    $('#Customer_Form').submit(function(e){
        e.preventDefault();
        $('.err_text').text('');
        const form = $('#Customer_Form')[0];
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
})
    </script>
@endsection

{{-- @section('css')
    <link rel="stylesheet" href="{{ Module::asset('Category:css/viewtree.css') }}">
@endsection --}}
