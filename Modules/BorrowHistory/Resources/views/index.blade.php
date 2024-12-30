@extends('borrowhistory::layouts.master')

@section('title')
    {!! config('borrowhistory.name') !!}
@endsection

@section('content')

    <div class="card">
        <div class="inline-flex rounded-md shadow-sm" role="group">
            <a href="{{ route('borrowhistory.addForm') }}" class="btn btn-primary">
                Đăng Ký Mượn Sách
            </a>
            <a href="{{ route('borrowhistory.returnBookForm') }}" class="btn btn-primary">
                Trả Sách
            </a>
        </div>
        <div class="card-body">
            <table id="his_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Bạn Đọc</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Mượn</th>
                        <th>Ngày Hẹn Trả</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($BorrowHistories as $history)
                        <tr>
                            <th>{{ $history->id }}</th>
                            <th>{{ $history->reader_name }}</th>
                            <th>@if ($history->borrow_status == 1)
                                    <span class="text-success">Đã Trả</span>
                                @elseif ($history->borrow_status == 0 && date('Y/m/d', strtotime($history->return_date)) < date('Y/m/d'))
                                    <span class="text-danger">Quá Hạn</span>
                                @elseif ($history->borrow_status == 0 && date('Y/m/d', strtotime($history->return_date)) > date('Y/m/d'))
                                    <span class="text-warning">Chưa Trả</span>
                                @endif</th>
                            <th>{{ date('Y/m/d', strtotime($history->borrow_date)) }}</th>
                            <th>{{ date('Y/m/d', strtotime($history->return_date)) }}</th>
                            <th>
                                <a href="{{ route('borrowhistory.editForm', ['id' => $history->id]) }}" class="btn btn-info">Chi Tiết</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tên Bạn Đọc</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Mượn</th>
                        <th>Ngày Hẹn Trả</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $("#his_table").DataTable({
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
            targets: [5]
        }]
    }).buttons().container().appendTo('#his_table_wrapper .col-md-6:eq(0)');

</script>

@endsection
