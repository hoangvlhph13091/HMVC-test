@extends('customer::layouts.master')

@section('title')
    {!! config('customer.name') !!}
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
                                Name
                            </label>
                            @if ($errors->has('name'))
                                <span class="text-red-600">{{ $errors->first('name') }}</span>
                            @endif
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" name="name" type="text" placeholder="Name">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Age
                            </label>
                            @if ($errors->has('title'))
                                <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="age" type="number" placeholder="Age">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Sex
                            </label>
                            @if ($errors->has('title'))
                                <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                            <Select name="sex">
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </Select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Date Of Birth
                            </label>
                            @if ($errors->has('title'))
                                <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="date_of_birth" type="text" placeholder="Date Of Birth">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Address
                            </label>
                            @if ($errors->has('title'))
                                <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="address" type="text" placeholder="Address">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Phone Number
                            </label>
                            @if ($errors->has('title'))
                                <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="phone_number" type="number" placeholder="Phone Number">
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
            }
        })
    })
})
    </script>
@endsection

{{-- @section('css')
    <link rel="stylesheet" href="{{ Module::asset('Category:css/viewtree.css') }}">
@endsection --}}
