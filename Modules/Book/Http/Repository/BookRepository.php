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
        DB::statement("INSERT INTO book_category (book_id, category_id, created_at, updated_at) VALUES ({$id}, {$tag['tag']}, CURRENT_TIMESTAMP , CURRENT_TIMESTAMP );");
    }

    public function updateBookData($id, $data)
    {
        $book = $this->book->find($id);

        $book->fill($data);

        $book->save();

        return $book->fresh();

    }

    public function updateBookTagData($id, $tag)
    {
        DB::statement("DELETE FROM book_category WHERE book_id = {$id}");

        DB::statement("INSERT INTO book_category (book_id, category_id, created_at, updated_at) VALUES ({$id}, {$tag['tag']}, CURRENT_TIMESTAMP , CURRENT_TIMESTAMP );");
    }

}
