@extends('customer::layouts.master')

@section('title')
    {!! config('customer.name') !!}
@endsection

@section('content')
    <div class="card card-primary">
        <a href="{{ route('customer') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
            id="back_link">back</a>
        <br>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="Customer_Form" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên Bạn Đọc</label>
                    <input type="text" class="form-control" id="name" name="name" type="text"
                        placeholder="Tên Bạn Đọc">
                    <span class="text-red-600 err_text" id="name_err"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Giới Tính</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="0">Nữ</option>
                        <option value="1">Nam</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Ngày Sinh:</label>
                            <div class="input-group date" id="date_of_birth" data-target-input="nearest">
                                <input type="text" name="date_of_birth" id="date_of_birth_input" class="form-control datetimepicker-input"
                                    data-target="#date_of_birth" />
                                <div class="input-group-append" data-target="#date_of_birth" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <span class="text-red-600 err_text" id="date_of_birth_err"></span>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <label for="exampleInputPassword1"> Tuổi</label>
                            <input type="text" class="form-control" readonly id="age" name="age" type="number"
                                placeholder=" Tuổi">
                            <span class="text-red-600 err_text" id="age_err"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Địa Chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" type="text"
                        placeholder="Địa Chỉ">
                    <span class="text-red-600 err_text" id="address_err"></span>
                </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1"> Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        placeholder=" Số Điện Thoại">
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
        $('#date_of_birth').datetimepicker({
            format: 'DD/MM/YYYY',
            maxDate: new Date()
        });

        $('#date_of_birth').on('change.datetimepicker', function(e){

            let birthDate = $('#date_of_birth_input').val();
            let dob = birthDate.split('/');
            let dob_str = dob[1]+'/'+dob[0]+'/'+dob[2];

            if ($.trim($('#date_of_birth_input').val()) == '' || isNaN(Date.parse(dob_str))) {
                return;
            }

            let curDate = new Date();

            let d = curDate.getDate();
            let m = curDate.getMonth() + 1;
            let y = curDate.getFullYear();

            let age = parseInt(y) - parseInt(dob[2]);

            if (parseInt(dob[2]) <= parseInt(y)) {
                if (parseInt(dob[1]) < parseInt(m)) {
                    if (age > 0) {
                        age = age - 1
                    }
                } else if (parseInt(dob[1]) == parseInt(m)) {
                    if (parseInt(dob[0]) < parseInt(d)) {
                        if (age > 0) {
                            age = age - 1
                        }
                    }
                }
            }

            $('#age').val(age).change();
        })

        $('#date_of_birth_input').on('blur', function(e){
            e.preventDefault();

            let birthDate = $('#date_of_birth_input').val();
            let dob = birthDate.split('/');
            let dob_str = dob[1]+'/'+dob[0]+'/'+dob[2];

            if ($.trim($('#date_of_birth_input').val()) == '' || isNaN(Date.parse(dob_str))) {
                return;
            }

            let curDate = new Date();

            let d = curDate.getDate();
            let m = curDate.getMonth() + 1;
            let y = curDate.getFullYear();

            let age = parseInt(y) - parseInt(dob[2]);

            if (parseInt(dob[2]) <= parseInt(y)) {
                if (parseInt(dob[1]) < parseInt(m)) {
                    if (age > 0) {
                        age = age - 1
                    }
                } else if (parseInt(dob[1]) == parseInt(m)) {
                    if (parseInt(dob[0]) < parseInt(d)) {
                        if (age > 0) {
                            age = age - 1
                        }
                    }
                }
            }

            $('#age').val(age).change();
        })


        $(document).ready(function() {
            $('#Customer_Form').submit(function(e) {
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
                    success: function() {
                        window.location.replace(backurl);
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_err').text(value[0])
                        })
                    }
                })
            })
        })
    </script>
@endsection
