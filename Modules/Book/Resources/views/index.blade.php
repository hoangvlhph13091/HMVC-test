@extends('book::layouts.master')

@section('title')
    {!! config('book.name') !!}
@endsection

@section('content')
    <div class="card">
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
                                <a href="{{ route('book.editForm', ['id' => $book->id]) }}" class="btn btn-info">Edit</a>
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
    </script>
@endsection
