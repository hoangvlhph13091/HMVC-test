<?php

namespace Modules\BorrowHistory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryDetail extends Model
{
    use HasFactory;
    protected $table ='borrow_detail';

    protected $guarded = ['id'];
}
