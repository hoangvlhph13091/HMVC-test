<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $table ='books';

    protected $guarded = ['id'];

    public function bookCategory()
    {
        return $this->hasOne(BookTag::class, 'book_id', 'id');
    }

    public function bookBorrowed()
    {
        return $this->hasMany(HistoryDetail::class, 'book_id', 'id');
    }
}
