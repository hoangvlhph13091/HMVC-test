@extends('category::layouts.master')

@section('title')
    {!! config('category.name') !!}
@endsection


@section('content')
    <div class="container-fluid">
        <a href="{{ route('category') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
            id="back_link">back</a>
        <br>
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Phân Loại</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Phân Loại <sup style="color: red">*</sup></label>
                        <input type="text" class="form-control" id="name" name="name" type="text"
                            placeholder="Title">
                        <span class="err_text" style="font-size: 80%; color: #dc3545;" id="name_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ghi chú</label>
                        <input type="text" class="form-control" id="Content" name="comment">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ Module::asset('Category:js/formPost.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
