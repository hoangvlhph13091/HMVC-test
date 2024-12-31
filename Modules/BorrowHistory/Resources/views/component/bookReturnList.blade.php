@foreach ($history as $his)
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Tên Sách</label>
            <input class="form-control" type="text" readonly value="{{ $his->book_name }}">
            <input type="hidden" value="{{ $his->id }}" name="id[{{ $loop->index + 1 }}]">
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Số Lượng</label>
            <input type="text" class="form-control" readonly value="{{ $his->amount }}">
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Ngày Mượn</label>
            <input type="text" class="form-control" readonly value="{{ date("y/m/d", strtotime( $his->borrow_date )) }}">
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Ngày Hẹn Trả</label>
            <input type="text" class="form-control" readonly value="{{ date("y/m/d", strtotime( $his->return_date )) }}">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputPassword1">Mã Đơn Mượn</label>
            <input type="text" readonly name="his_id[{{ $loop->index + 1 }}]" value="{{  $his->his_id }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputPassword1">Ghi Chú</label>
            <input type="text" name="note[{{ $loop->index + 1 }}]" value="{{  $his->note }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group" style="padding-top: 15%">
            <input class="checkbox_status" data-index="{{ $loop->index + 1 }}" type="checkbox" @if ($his->status == 1) checked @endif>
            <label class="">Hoàn Trả</label>
            <input type="hidden" id="status_{{ $loop->index + 1 }}" name="status[{{ $loop->index + 1 }}]" value="0">
        </div>
    </div>
</div>
@endforeach

<input class="btn btn-primary" type="submit" id="sunmit_return_book_form">
