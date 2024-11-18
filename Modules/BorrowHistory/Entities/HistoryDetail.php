<?php

namespace Modules\BorrowHistory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Book\Entities\Book;

class HistoryDetail extends Model
{
    use HasFactory;
    protected $table ='borrow_detail';

    protected $guarded = ['id'];

    public function Book()
{
    return $this->belongsTo(Book::class, 'book_id', 'id');
}
}
