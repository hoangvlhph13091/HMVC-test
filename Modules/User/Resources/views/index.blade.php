@extends('user::layouts.master')

@section('title')
{!! config('user.name') !!}
@endsection

@section('content')
    <div class="card">
        <div class="inline-flex rounded-md shadow-sm" role="group">
            <a href="{{ route('user.addForm') }}" class="btn btn-primary">
                Thêm Thành Viên
            </a>
        </div>
        <div class="card-body">
            <table id="user_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Nhân Viên</th>
                        <th>Email</th>
                        <th>Chức Vụ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->email }}</th>
                            <th>{{ $user->hasRole('admin') ? 'Quản Trị Viên' : 'Nhân Viên' }}</th>
                            <th>
                                <a href="{{ route('user.editForm', ['id' => $user->id]) }}" class="btn btn-info">Chỉnh Sửa</a>
                                <a href="{{ route('user.del', ['id' => $user->id]) }}" onclick="return confirm('Xóa Thành Viên??')" class="btn btn-danger">Xóa</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tên Nhân Viên</th>
                        <th>Email</th>
                        <th>Chức Vụ</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $("#user_table").DataTable({
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
            targets: [4]
        }]
    }).buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');

</script>
@endsection
