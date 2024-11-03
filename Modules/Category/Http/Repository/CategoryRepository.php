<?php

namespace Modules\Category\Http\Repository;

use Modules\Category\Entities\Category;

class CategoryRepository
{

    protected $Category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function save($data)
    {
        $category = new $this->category;

        $category->fill($data);

        $category->save();

        return $category->fresh();
    }

    public function getAll()
    {
        return $this->category->get();
    }

    public function searchCategory($key)
    {
        // return $this->category->where('title', 'like', "%$key%")->get();
    }

    public function getOne($id)
    {
        // return $this->category->find($id);
    }

    public function updateCategory($id, $data)
    {
        $category = $this->category->find($id);

        $category->fill($data);

        $category->save();

        return $category->fresh();

    }

}
