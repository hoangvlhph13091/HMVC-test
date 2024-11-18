<?php

namespace Modules\BorrowHistory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BorrowHistory\Entities\BorrowHistory;
use Modules\BorrowHistory\Entities\HistoryDetail;
use Modules\Book\Entities\Book;
use Modules\Customer\Entities\Customer;
use Modules\BorrowHistory\Http\Requests\BorrowHistoryRequests;
use Modules\BorrowHistory\Http\Requests\BorrowHistoryEditRequests;

class BorrowHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $sortType = $request->sortBy ? $request->sortBy : 'id';
        $order = $request->order ? $request->order : 'asc';
        $searchValue = $request->searchValue ? $request->searchValue : '';
        $BorrowHistories = BorrowHistory::where('reader_name','like',"%$searchValue%")->orderBy($sortType, $order)->paginate(5);
        return view('borrowhistory::index', compact('BorrowHistories') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        $books = Book::all();
        return view('borrowhistory::addHistory', compact('books'));
    }

    public function AddNewRow()
    {
        $books = Book::all();
        $returnHTML = view('borrowhistory::component.bookInput', compact('books'))->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function findUser(Request $request)
    {
        $id = $request->id;
        $customer = Customer::find($id);

        return response()->json( array('success' => true, 'customer'=>$customer) );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function create(BorrowHistoryRequests $request)
    {
        $data = $request->except(['_token', 'book_id']);
        $history = new BorrowHistory();
        $history->fill($data);
        $history->save();
        $his =  $history->fresh();


        $book_ids = $request->only(['book_id']);
        $amount = $request->only(['amount']);


        foreach ($book_ids['book_id'] as $key => $id) {
            $book = Book::where('id', $id)->first();
            $detail = new HistoryDetail();
            $detail->book_id = $id;
            $detail->book_name = $book->name;
            $detail->history_id = $his->id;
            $detail->amount = $amount['amount'][$key];
            $detail->save();
        }

        return redirect(route('borrowhistory'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function view($id)
    {
        $history = BorrowHistory::with('historyDetail')->find($id);

        $bookData = $history->historyDetail;

        return response()->json(['status' => 200, 'data' => $history, 'bookData' => $bookData]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function edit(BorrowHistoryEditRequests $request, $id)
    {
        $data = $request->except(['_token', 'book_id']);
        $history = BorrowHistory::find($id);
        $history->fill($data);
        $history->save();

        $book_ids = $request->only(['book_id']);
        $amount = $request->only(['amount']);
        HistoryDetail::Where('history_id', $id)->delete();
        foreach ($book_ids['book_id'] as $key => $book_id) {
            $book = Book::where('id', $book_id)->first();
            $detail = new HistoryDetail();
            $detail->book_id = $book_id;
            $detail->book_name = $book->name;
            $detail->history_id = $id;
            $detail->amount = $amount['amount'][$key];
            $detail->save();
        }

        return redirect(route('borrowhistory'));
    }

     /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function editForm($id)
    {
        $books = Book::all();
        $history = BorrowHistory::with('historyDetail')->find($id);
        return view('borrowhistory::editHistory', compact('books', 'history'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function return(Request $request, $id)
    {
        $history = BorrowHistory::find($id);

        $history->borrow_status = 0;
        $history->return_date = now();

        $history->save();

        $details = HistoryDetail::Where('history_id', $id)->get();

        foreach ($details as $key => $detail) {
            $detail->status = 1 ;
            $detail->save();
        }

        return redirect(route('borrowhistory'));
    }
}
