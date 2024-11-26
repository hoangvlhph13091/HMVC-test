<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookReceipt extends Model
{
    use HasFactory;
    protected $table ='book_import_receipt';

    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(BookReceiptDetail::class, 'receipt_unique_id', 'receipt_unique_id');
    }
}
