@extends('area::layouts.master')

@section('title')
    {!! config('area.name') !!}
@endsection


@section('content')
    <div class="card card-primary">
        <a href="{{ route('area') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
            id="back_link">back</a>
        <br>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="AreaForm">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên Khu Vực</label>
                    <input class="form-control" id="book_area_name" name="book_area_name" type="text" value="{{ $area->book_area_name }}"
                        placeholder="Tên Khu Vực">
                    <span class="text-red-600 err_text" id="book_area_name_err"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ghi Chú</label>
                    <textarea id="book_area_note" name="book_area_note" rows="3" class="form-control" placeholder="Ghi Chú">{{ $area->book_area_note }}</textarea>
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
        $('#AreaForm').submit(function(e) {
            e.preventDefault();
            $('.err_text').text('');
            const form = $('#AreaForm')[0];
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
