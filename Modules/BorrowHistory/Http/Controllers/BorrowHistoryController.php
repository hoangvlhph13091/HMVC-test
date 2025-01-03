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
use Illuminate\Support\Facades\DB;

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
        $val = $request->value;
        $type = $request->type;
        $customer = Customer::Where($type, $val)->first();
        $total = 0;
        $late = false;
        $lateReturnTime = 0;
        $now = date("Y-m-d");
        if ($customer == NULL) {
            return response()->json( array('success' => true, 'customer'=>[], 'late' => $late, 'borrowed' => $total, 'lateReturnTime' => $lateReturnTime) );
        }
        $histories = BorrowHistory::with('historyDetail')->where('reader_id', $customer->id)->get();
        foreach ($histories as $key => $his) {
            if ($his->return_date < $now && $his->borrow_status == 0) {
                $late = true;
            }
            foreach ($his->historyDetail as $key => $value) {
                if ($value->status == 0) {
                    $total += $value->amount;
                }
            }

            $lateCount = HistoryDetail::where('history_id', $his->id)->where('return_status', 2)->get();
            $lateCount = count($lateCount);
            $lateReturnTime += $lateCount;
        }
        return response()->json( array('success' => true, 'customer'=>$customer, 'late' => $late, 'borrowed' => $total, 'lateReturnTime' => $lateReturnTime) );
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

    public function returnBookForm(){
        $customers = DB::table('borrow_history')
            ->select('reader_name AS name', 'reader_id AS id')
            ->distinct()->get();
        return view('borrowhistory::returnBook', compact('customers'));
    }

    public function getUserInfo(Request $request){
        $id = $request->id;
        $name = $request->name;

        $history = DB::table('borrow_detail')
        ->join('borrow_history', 'borrow_history.id', '=', 'borrow_detail.history_id')
        ->where('borrow_history.reader_id', '=', $id)
        ->where('borrow_history.reader_name', '=', $name)
        ->select('borrow_detail.*', 'borrow_history.borrow_date', 'borrow_history.return_date', 'borrow_history.id AS his_id')
        ->get();

        return view('borrowhistory::component.bookReturnList', compact('history'));
    }

    public function returnBook(Request $request){
        $idArr = $request->only('id');
        $noteArr = $request->only('note');
        $statusArr = $request->only('status');
        $returnTime = date('Y/m/d', strtotime('now'));
        $history_id_arr = [];
        $history_id_arr_unreturn = [];
        foreach ($idArr['id'] as $key => $value) {
            $detail = HistoryDetail::find($value);
            $detail->note = $noteArr['note'][$key];
            $detail->status = $statusArr['status'][$key];
            $his = BorrowHistory::find($detail->history_id);
            if ($statusArr['status'][$key] == 1) {
                $detail->return_date = $returnTime;
                if ($returnTime < $his->return_date) {
                    $detail->return_status = 1;
                } else {
                    $detail->return_status = 2;
                }
            } else {
                $detail->return_date = NULL;
                if ($returnTime < $his->return_date) {
                    $detail->return_status = 0;
                } else {
                    $detail->return_status = 2;
                }
            }
            if (!in_array($detail->history_id, $history_id_arr) && $statusArr['status'][$key] == 1) {
                array_push($history_id_arr, $detail->history_id);
            }
            else if(!in_array($detail->history_id, $history_id_arr_unreturn) && $statusArr['status'][$key] == 0) {
                array_push($history_id_arr_unreturn, $detail->history_id);
            }
            $detail->save();
        }

        foreach ($history_id_arr as $key => $value) {
            $his = BorrowHistory::find($value);
            $count = HistoryDetail::Where('history_id', $value)->where('status', 0)->get();

            $count = count($count);

            if ($count == 0) {
                $his->borrow_status = 1;
                $his->save();
            }
        }

        foreach ($history_id_arr_unreturn as $key => $value) {
            $his = BorrowHistory::find($value);
            $his->borrow_status = 0;
            $his->save();
        }

        return;
    }

    public function getBookRealAmount(Request $request){
        $bookID = $request->id;

        $bookTotal = Book::where('id', $bookID)->pluck('total_amount')->first();

        $borrowed = 0;

        $borrowedAmountArr = HistoryDetail::Where('book_id', $bookID)->pluck('amount');

        foreach ($borrowedAmountArr as $key => $value) {
            $borrowed += $value;
        }

        $realAmount = 0;

        $realAmount = $bookTotal - $borrowed;

        return ['realAmount' => $realAmount];
    }
}
