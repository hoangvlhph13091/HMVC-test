<?php

namespace Modules\BorrowHistory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowHistory extends Model
{
    use HasFactory;
    protected $table ='borrow_history';

    protected $guarded = ['id'];

    public function historyDetail()
    {
        return $this->hasMany(HistoryDetail::class, 'book_id', 'id');
    }
}
