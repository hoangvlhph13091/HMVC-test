<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Book\Entities\Book;
use Modules\Book\Entities\BookReceipt;
use Modules\Book\Entities\BookReceiptDetail;
use Modules\Book\Entities\BookTag;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Book\Http\Requests\BookRequests;
use Modules\Book\Http\Services\BookServices;
use Modules\Book\Http\Requests\BookEditRequests;
use Modules\Book\Http\Requests\ReceiptRequests;
use Modules\Area\Entities\Area;
use Exception;

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
    public function index()
    {
        $books = Book::all();
        $receipts =  BookReceipt::all();
        return view('book::index', compact('books', 'receipts') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        $areas = Area::all();
        $categories = Category::all();
        return view('book::createBook', compact('categories', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function Create(BookRequests $request)
    {

        $data = $request->except(['_token', 'tag']);
        if ($request->has('image')) {
            $imgPath = $request->file('image')->store('public/image');
            $data['image'] = $imgPath;
        }
        $tagData =  $request->only('tag');
        $newBook = $this->bookServices->saveBookData($data);
        $this->bookServices->saveBookTagData($tagData, $newBook->id);

        return redirect(route('book'));
    }

    public function createReceiptForm()
    {
        $areas = Area::all();
        $categories = Category::all();
        return view('book::createReceiptForm', compact('categories', 'areas'));
    }

    public function searchBook(Request $request)
    {
        $name = $request->name;
        try {
            $book_id = Book::where('name', $name)->pluck('id');
            return $book_id[0];
        } catch (\Throwable $th) {
            return NULL;
        }
    }

    public function createReceipt (ReceiptRequests $request){
        $data = $request->except(['_token', 'name','price', 'author', 'total_amount', 'overview', 'tag']);

       try {
        DB::beginTransaction();
        $name = $request->only(['name']);
        $price = $request->only(['price']);
        $author = $request->only(['author']);
        $total_amount = $request->only(['total_amount']);
        $overview = $request->only(['overview']);
        $tag = $request->only(['tag']);
        $area = $request->only(['area']);
        $book_id_list = $request->only(['book_id']);

        $receipt = new BookReceipt();
        $receipt->fill($data);
        $receipt->save();

        $rec = $receipt->fresh();

        foreach ($name['name'] as $key => $val) {
            if (isset($book_id_list['book_id'][$key]) && $book_id_list['book_id'][$key] !='') {
                $b = Book::find($book_id_list['book_id'][$key]);
                $b->name = $val;
                $b->price = $price['price'][$key];
                $b->author = $author['author'][$key];
                $b->area = $area['area'][$key];
                $b->overview = $overview['overview'][$key];
                $b->total_amount = $b->total_amount + $total_amount['total_amount'][$key];
                $b->save();

                BookTag::where('book_id', $book_id_list['book_id'][$key])->delete();
             } else {
                $book = new Book();
                $book->name = $val;
                $book->price = $price['price'][$key];
                $book->author = $author['author'][$key];
                $book->area = $area['area'][$key];
                $book->overview = $overview['overview'][$key];
                $book->total_amount = $total_amount['total_amount'][$key];
                $book->save();

                $b = $book->fresh();
             }

            $recDetail = new BookReceiptDetail();
            $recDetail->receipt_unique_id = $rec->receipt_unique_id;
            $recDetail->book_id = $b->id;
            $recDetail->save();

            $bookCate = new BookTag();

            $bookCate->book_id = $b->id;
            $bookCate->category_id = $tag['tag'][$key];

            $bookCate->save();

            DB::commit();
        }
       } catch (\Exception $e) {
        DB::rollBack();

        throw new Exception($e->getMessage());
       }
    }

    public function editReceiptForm($id)
    {
        $receipt = BookReceipt::Where('id',$id)->with('detail')->first();
        $categories = Category::all();
        $areas = Area::all();

        $book_ids = [];

        foreach ($receipt->detail as $key => $value) {
            array_push($book_ids, $value->book_id);
        }

        $books = Book::Wherein('id', $book_ids)->with('bookCategory')->get();

        return view('book::editReceiptForm', compact('receipt', 'categories', 'areas', 'books'));
    }

    public function editReceipt(Request $request, $id)
    {
        $data = $request->except(['_token', 'name','price', 'author', 'total_amount', 'overview', 'tag']);

        try {
         DB::beginTransaction();
         $name = $request->only(['name']);
         $price = $request->only(['price']);
         $author = $request->only(['author']);
         $total_amount = $request->only(['total_amount']);
         $overview = $request->only(['overview']);
         $tag = $request->only(['tag']);
         $area = $request->only(['area']);
         $book_id_list = $request->only(['book_id']);

         $receipt = BookReceipt::find($id);
         $receipt->fill($data);
         $receipt->save();

         $rec = $receipt->fresh();

         BookReceiptDetail::Where('receipt_unique_id', $rec->receipt_unique_id)->delete();

         foreach ($name['name'] as $key => $val) {
             if (isset($book_id_list['book_id'][$key]) && $book_id_list['book_id'][$key] !='') {
                $b = Book::find($book_id_list['book_id'][$key]);
                $b->name = $val;
                $b->price = $price['price'][$key];
                $b->author = $author['author'][$key];
                $b->area = $area['area'][$key];
                $b->overview = $overview['overview'][$key];
                $b->total_amount = $book->total_amount + $total_amount['total_amount'][$key];
                $b->save();

                BookTag::where('book_id', $book_id_list['book_id'][$key])->delete();
             } else {
                $book = new Book();
                $book->name = $val;
                $book->price = $price['price'][$key];
                $book->author = $author['author'][$key];
                $book->area = $area['area'][$key];
                $book->overview = $overview['overview'][$key];
                $book->total_amount = $total_amount['total_amount'][$key];
                $book->save();

                $b = $book->fresh();
             }


             $recDetail = new BookReceiptDetail();
             $recDetail->receipt_unique_id = $rec->receipt_unique_id;
             $recDetail->book_id = $b->id;
             $recDetail->save();

             $bookCate = new BookTag();

             $bookCate->book_id = $b->id;
             $bookCate->category_id = $tag['tag'][$key];

             $bookCate->save();

             DB::commit();
         }
        } catch (\Exception $e) {
         DB::rollBack();

         throw new Exception($e->getMessage());
        }
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
        $areas = Area::all();
        $book = Book::find($id);
        $categories = Category::all();
        return view('book::editBook', compact('categories', 'book', 'areas'));
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
