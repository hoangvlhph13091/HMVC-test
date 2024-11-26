<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookReceiptDetail extends Model
{
    use HasFactory;
    protected $table ='book_import_receipt_detail';

    protected $guarded = ['id'];
}
