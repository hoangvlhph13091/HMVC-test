<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Book\Entities\Book;
use Modules\Category\Entities\Category;
use Modules\Book\Http\Requests\BookRequests;
use Modules\Book\Http\Services\BookServices;

class BookController extends Controller
{

    protected $bookServices;

    public function __construct(BookServices $bookServices)
    {
        $this->bookServices = $bookServices;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $sortType = $request->sortBy ? $request->sortBy : 'id';
        $order = $request->order ? $request->order : 'asc';
        $searchValue = $request->searchValue ? $request->searchValue : '';
        $books = Book::where('name','like',"%$searchValue%")->orderBy($sortType, $order)->paginate(5);
        return view('book::index', compact('books') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        $categories = Category::all();
        return view('book::createBook', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function Create(BookRequests $request)
    {
        $data = $request->except(['_token', 'tag']);

        $tagData =  $request->only('tag');
        $newBook = $this->bookServices->saveBookData($data);
        $this->bookServices->saveBookTagData($tagData, $newBook->id);

        return redirect(route('book'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('book::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editForm($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('book::editBook', compact('categories', 'book'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit(BookEditRequests $request, $id)
    {
        $data = $request->except(['_token', 'tag']);
        $tagData =  $request->only('tag');

        $this->bookServices->updateBookData($data, $id);
        $this->bookServices->updateBookTagData($tagData, $id);

        return redirect(route('book'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Book::destroy($id);

        return redirect(route('book'));
    }
}
