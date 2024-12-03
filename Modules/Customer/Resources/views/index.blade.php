@extends('customer::layouts.master')

@section('title')
    {!! config('customer.name') !!}
@endsection

@section('content')
    <div class="card">
        <div class="inline-flex rounded-md shadow-sm" role="group">
            <a href="{{ route('customer.addForm') }}" class="btn btn-primary">
                Thêm Bạn Đọc
            </a>
        </div>
        <div class="card-body">
            <table id="cust_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Bạn Đọc</th>
                        <th>Giới Tính</th>
                        <th>Tuổi</th>
                        <th>Ngày Sinh</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $cust)
                        <tr>
                            <th>{{ $cust->id }}</th>
                            <th>{{ $cust->name }}</th>
                            <th>{{ $cust->sex == 1 ? 'male' : 'female' }}</th>
                            <th>{{ $cust->date_of_birth }}</th>
                            <th>{{ $cust->address }}</th>
                            <th>{{ $cust->phone_number }}</th>
                            <th>
                                <a href="{{ route('customer.editForm', ['id' => $cust->id]) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('customer.del', ['id' => $cust->id]) }}" class="btn btn-danger">Del</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tên Bạn Đọc</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#cust_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                extend: 'excel',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }],
            "columnDefs": [{
                orderable: false,
                targets: [7]
            }]
        }).buttons().container().appendTo('#cust_table_wrapper .col-md-6:eq(0)');

    </script>
@endsection
