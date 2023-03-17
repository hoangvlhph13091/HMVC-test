<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table ='posts';

    protected $fillable = ['title', 'content'];

    protected static function newFactory()
    {
        return \Modules\Post\Database\factories\PostFactory::new();
    }
    public function hasChild(){
        return $this->hasMany(Post::class, 'parent_id', 'id');
    }
}
