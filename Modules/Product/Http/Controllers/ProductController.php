<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Post\Entities\Post;
use Modules\Product\Http\Resource\ProductCollection;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $sortType = $request->sortBy ? $request->sortBy : 'id';
        $order = $request->order ? $request->order : 'asc';
        // dd($request);
        $products = Product::with('post:id,title')->orderBy($sortType, $order)->paginate(5);
        return view('product::index', compact('products') );
    }

    public function trashedItem(Request $request)
    {
        $sortType = $request->sortBy ? $request->sortBy : 'id';
        $order = $request->order ? $request->order : 'asc';
        // dd($request);
        $products = Product::with('post:id,title')->orderBy($sortType, $order)->onlyTrashed()->paginate(5);
        return view('product::index', compact('products') );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::createProduct');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delRes( Request $request)
    {

        if ($request->action == 'delete') {
            $prod = Product::find($request->id)->delete();
            $sortType = $request->sortBy ? $request->sortBy : 'id';
            $order = $request->order ? $request->order : 'asc';
            $products = Product::with('post:id,title')->orderBy($sortType, $order)->paginate(5);
            return view('product::index', compact('products') );
        } else {
            Product::withTrashed()->find($request->id)->restore();
            $sortType = $request->sortBy ? $request->sortBy : 'id';
            $order = $request->order ? $request->order : 'asc';
            $products = Product::with('post:id,title')->orderBy($sortType, $order)->onlyTrashed()->paginate(5);
            return view('product::index', compact('products') );
        }
    }

    public function res( Request $request, $id)
    {


    }
}
