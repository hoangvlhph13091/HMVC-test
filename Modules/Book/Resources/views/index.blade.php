@extends('book::layouts.master')

@section('title')
    {!! config('book.name') !!}
@endsection

@section('content')
    <div class="card">
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="quan_ly_sach-tab" data-toggle="pill"
                    href="#quan_ly_sach" role="tab" aria-controls="quan_ly_sach-home"
                    aria-selected="true">Sách</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="form_nhap_sach-tab" data-toggle="pill"
                    href="#form_nhap_sach" role="tab" aria-controls="form_nhap_sach"
                    aria-selected="false">Đơn Nhập</a>
            </li>
        </ul>
        <div class="tab-content" id="quan_ly_sach-tabContent">
            <div class="tab-pane fade show active" id="quan_ly_sach" role="tabpanel"
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
                                <th>Tên sách</th>
                                <th>Ảnh Bìa</th>
                                <th>Tác Giả</th>
                                <th>Giá Bìa</th>
                                <th>Tóm Tắt</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <th>{{ $book->id }}</th>
                                    <th>{{ $book->name }}</th>
                                    <th><img style="height: 100px" src="{{ asset('storage/image/book/'.$book->image) }}" alt=""></th>
                                    <th>{{ $book->author }}</th>
                                    <th>{{ $book->price }}</th>
                                    <th>{{ $book->overview }}</th>
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
                                <th>Tên sách</th>
                                <th>Ảnh Bìa</th>
                                <th>Tác Giả</th>
                                <th>Giá Bìa</th>
                                <th>Tóm Tắt</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="form_nhap_sach" role="tabpanel"
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
                targets: [6]
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
        }).buttons().container().appendTo('#receipt_table_wrapper .col-md-6:eq(0)');
    </script>
@endsection
