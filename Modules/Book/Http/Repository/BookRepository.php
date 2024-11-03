<?php

namespace Modules\Book\Http\Repository;

use Modules\Book\Entities\Book;
use Modules\Book\Entities\BookTag;

class BookRepository
{

    protected $book;
    protected $book_tag;

    public function __construct(Book $book, BookTag $book_tag)
    {
        $this->book = $book;
        $this->book_tag = $book_tag;
    }

    public function save($data)
    {
        $book = new $this->book;

        $book->fill($data);

        $book->save();

        return $book->fresh();
    }

    public function saveTag($tag, $id)
    {
        foreach ($tag as $key => $value) {
            $book_tag = new $this->book_tag;

            $book_tag->book_id = $id;

            $book_tag->category_id = $id;

            $book_tag->save();
        }
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
