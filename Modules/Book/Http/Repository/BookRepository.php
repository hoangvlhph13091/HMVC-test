<?php

namespace Modules\Book\Http\Repository;

use Modules\Book\Entities\Book;
use Modules\Book\Entities\BookTag;
use Illuminate\Support\Facades\DB;

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
        foreach ($tag['tag'] as $key => $value) {
            DB::statement("INSERT INTO book_tag (book_id, category_id, created_at, updated_at) VALUES ({$id}, {$value}, CURRENT_TIMESTAMP , CURRENT_TIMESTAMP );");
        }
    }

    public function getAll()
    {
        return $this->category->get();
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
