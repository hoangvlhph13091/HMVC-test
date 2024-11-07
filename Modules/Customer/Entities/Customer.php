<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table ='customer';

    protected $guarded = ['id'];
}
