<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table ='categories';

    protected $guarded = ['id'];

    public function hasChild(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
