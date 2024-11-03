<?php

namespace Modules\Category\Http\Services;

use Modules\Category\Http\Repository\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Category\Http\Resource\CategoryCollection;
use InvalidArgumentException;

class CategoryService
{
    /**
     * @var $categoryRepository
     */
    // protected $categoryRepository;

    /**
     * CategoryService constructor
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function saveCategoryData($data)
    {
        return $result = $this->categoryRepository->save($data);

    }

    public function editCategoryData($data, $id)
    {

            $result = $this->categoryRepository->updateCategory($id, $data);

            return $result;

    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function searchCategory($key)
    {
        return $this->categoryRepository->searchCategory($key);
    }

    public function getOne($id)
    {
        return $this->categoryRepository->getOne($id);
    }
}

