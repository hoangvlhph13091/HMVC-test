<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_post extends Model
{
    use HasFactory;
    protected $table = 'product__posts';
    protected $fillable = ['prod_id', 'post_id'];
}
