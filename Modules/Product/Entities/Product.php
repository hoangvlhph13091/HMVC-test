<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Entities\Post;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";

    protected $fillable = ['name', 'content', 'price', 'postID'];

    public function post(){
        // return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
        return $this->belongsTo(Post::class, 'postID', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductFactory::new();
    }
}
