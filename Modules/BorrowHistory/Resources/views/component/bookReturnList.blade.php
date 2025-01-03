@foreach ($history as $his)
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Tên Sách</label>
            <input class="form-control" type="text" readonly value="{{ $his->book_name }}">
            <input type="hidden" value="{{ $his->id }}" name="id[{{ $his->id }}]">
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Số Lượng</label>
            <input type="text" class="form-control" readonly value="{{ $his->amount }}">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputPassword1">Ngày Mượn</label>
            <input type="text" class="form-control" readonly value="{{ date("y/m/d", strtotime( $his->borrow_date )) }}">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputPassword1">Ngày Hẹn Trả</label>
            <input type="text" class="form-control" readonly value="{{ date("y/m/d", strtotime( $his->return_date )) }}">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputPassword1">Mã Đơn Mượn</label>
            <input type="text" readonly name="his_id[{{ $his->id }}]" value="{{  $his->his_id }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputPassword1">Trạng Thái</label>
            <input type="text" readonly
            @if (strtotime( $his->return_date ) < strtotime('now'))
                value="Quá Hạn" style="color: red; font-weight: 700; background: #d7d7d7"
            @elseif (strtotime( $his->return_date ) > strtotime('now'))
                value="Còn Hạn" style="color: Yellow; font-weight: 700; background: #d7d7d7"
            @elseif ($his->status == 1 && strtotime( $his->return_date ) > strtotime('now'))
                value="Đã Trả" style="color: Green; font-weight: 700; background: #d7d7d7"
            @endif  class="form-control">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Ghi Chú</label>
            <input type="text" name="note[{{ $his->id}}]" value="{{  $his->note }}" class="form-control">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Tiền Phạt</label>
            <input type="text"
            @if (strtotime( $his->return_date ) < strtotime('now'))
                value="50000"
            @else
                value="0"
            @endif
            class="form-control">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group" style="padding-top: 12%">
            <input class="checkbox_status" data-index="{{ $his->id }}" type="checkbox" @if ($his->status == 1) checked @endif>
            <label class="">Hoàn Trả</label>
            <input type="hidden" id="status_{{ $his->id }}" name="status[{{ $his->id }}]" value="0">
        </div>
    </div>
</div>

<hr>
@endforeach

<input class="btn btn-primary" type="submit" id="sunmit_return_book_form">
