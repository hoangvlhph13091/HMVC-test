@extends('area::layouts.master')

@section('title')
{!! config('area.name') !!}
@endsection

@section('content')

    <div class="card">
        <div class="inline-flex rounded-md shadow-sm" role="group">
            <a href="{{ route('area.addForm') }}" class="btn btn-primary">
                Thêm Khu Vực
            </a>
        </div>
        <div class="card-body">
            <table id="area_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khu Vực</th>
                        <th>Ghi Chú</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <th>{{ $area->id }}</th>
                            <th>{{ $area->book_area_name }}</th>
                            <th>{{ $area->book_area_note }}</th>
                            <th>
                                <a href="{{ route('area.editForm', ['id' => $area->id]) }}" class="btn btn-info">Chỉnh Sửa</a>
                                <a href="{{ route('area.del', ['id' => $area->id]) }}" onclick="return confirm('Xóa Khu Vực??')" class="btn btn-info">Xóa</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Khu Vực</th>
                        <th>Ghi Chú</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $("#area_table").DataTable({
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
            targets: [3]
        }]
    }).buttons().container().appendTo('#area_table_wrapper .col-md-6:eq(0)');

</script>
@endsection
