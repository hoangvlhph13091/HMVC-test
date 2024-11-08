<?php

namespace Modules\Book\Http\Services;

use Modules\Book\Http\Repository\BookRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class BookServices
{
    /**
     * @var $categoryRepository
     */
    // protected $categoryRepository;

    /**
     * CategoryService constructor
     *
     * @param BookRepository $categoryRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function saveBookData($data)
    {
        return $result = $this->bookRepository->save($data);

    }

    public function saveBookTagData($tag, $id)
    {
        return $result = $this->bookRepository->saveTag($tag, $id);
    }

    public function updateBookData($data, $id)
    {

        return $result = $this->bookRepository->updateBookData($id, $data);
    }

    public function updateBookTagData($data, $id)
    {
        return $this->bookRepository->updateBookTagData($id, $data);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->categoryRepository->getOne($id);
    }
}

