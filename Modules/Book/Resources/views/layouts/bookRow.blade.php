<div class="row book_add_row">
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Tên Sách</label>
            <input type="text" class="form-control" id="name[]" name="name[]" placeholder="Tên Sách">
            <span class="text-red-600 err_text" id="name1_err"></span>
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Giá Bìa</label>
            <input type="text" class="form-control" id="price[]" name="price" placeholder="Giá Bìa">
            <span class="text-red-600 err_text" id="price1_err"></span>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="exampleInputFile">Hình Ảnh</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image"placeholder="Hình Ảnh">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Tác Giả</label>
            <input type="text" class="form-control" id="author[]" name="author[]" placeholder="Tác Giả">
            <span class="text-red-600 err_text" id="author1_err"></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Phân Loại
            </label>
            <select class="select2" name="tag[]" data-placeholder="Select a State" style="width: 100%;">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                @endforeach
            </select>
            <span class="text-red-600 err_text" id="tag_err"></span>
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Khu Vực</label>
            <select id="area" name="area[]" class="form-control">
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->book_area_name }}</option>
                @endforeach
            </select>
            <span class="text-red-600 err_text" id="area1_err"></span>
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Số Lượng</label>
            <input type="number" class="form-control" id="total_amount[]" name="total_amount[]" placeholder="Số Lượng">
            <span class="text-red-600 err_text" id="total_amount1_err"></span>
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <label for="exampleInputPassword1">Tóm Tắt</label>
            <input type="text" class="form-control" id="overview[]" name="overview[]" placeholder="Tóm Tắt">
        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <button style="margin-top: 32px;" class="btn btn-danger btn_delete_row">Xóa Hàng</button>
        </div>
    </div>
</div>
