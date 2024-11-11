<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookTag extends Model
{
    use HasFactory;
    protected $table ='book_category';

    protected $guarded = ['id'];
}
