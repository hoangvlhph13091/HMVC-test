@extends('book::layouts.master')

@section('title')
    {!! config('book.name') !!}
@endsection

@section('content')
    <div class="card">
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                    href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                    aria-selected="true">Sách</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                    href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                    aria-selected="false">Đơn Nhập</a>
            </li>
        </ul>
        <div class="tab-content" id="custom-content-below-tabContent">
            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
                aria-labelledby="custom-content-below-home-tab">
                <br>
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <a href="{{ route('book.addForm') }}" class="btn btn-primary">
                        Thêm sách
                    </a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thêm sách</th>
                                <th>Tóm Tắt</th>
                                <th>Giá Bìa</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <th>{{ $book->id }}</th>
                                    <th>{{ $book->name }}</th>
                                    <th>{{ $book->overview }}</th>
                                    <th>{{ $book->price }}</th>
                                    <th>
                                        <a href="{{ route('book.editForm', ['id' => $book->id]) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ route('book.del', ['id' => $book->id]) }}"
                                            onclick="return confirm('Xóa đầu sách??')"class="btn btn-danger">Del</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Thêm sách</th>
                                <th>Tóm Tắt</th>
                                <th>Giá Bìa</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                aria-labelledby="custom-content-below-profile-tab">
                <br>
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <a href="{{ route('book.receipt.addForm') }}" class="btn btn-primary">
                        Tạo Đơn Mới
                    </a>
                </div>
                <div class="card-body">
                    <table id="receipt_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ngày Nhập</th>
                                <th>Nguồn Nhập</th>
                                <th>Người Nhập</th>
                                <th>Ghi Chú</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $receipt)
                                <tr>
                                    <th>{{ $receipt->receipt_unique_id }}</th>
                                    <th>{{ $receipt->receipt_date }}</th>
                                    <th>{{ $receipt->receipt_source }}</th>
                                    <th>{{ $receipt->receipt_person }}</th>
                                    <th>{{ $receipt->receipt_note }}</th>
                                    <th>
                                        <a href="{{ route('book.receipt.editForm', ['id' => $receipt->id]) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ route('book.del', ['id' => $receipt->id]) }}"
                                            onclick="return confirm('Xóa đầu sách??')"class="btn btn-danger">Del</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Ngày Nhập</th>
                                <th>Nguồn Nhập</th>
                                <th>Người Nhập</th>
                                <th>Ghi Chú</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


        <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
    <script>
        $("#example1").DataTable({
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
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#receipt_table").DataTable({
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
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
@endsection
