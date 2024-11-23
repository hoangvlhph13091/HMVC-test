<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\CategoryRequests;
use Modules\Category\Http\Requests\CategoryEditRequests;
use Modules\Category\Http\Services\CategoryService;
use Modules\Category\Http\Resource\CategoryCollection;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::with('hasChild')->get();
        return view('category::index', compact('categories'));
    }

  /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        return view('category::createForm');
    }

     /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function create(CategoryRequests $request)
    {
        $data = $request->except('_token');
        try {
            $data = $this->categoryService->saveCategoryData($data);
            return response()->json();
        } catch (Exception $e) {
            return $e->getMessage();
        };
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        $category = Category::find($request->id);
        return response()->json(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(CategoryEditRequests $request, $id)
    {
        $data = $request->except('_token');
        try {
            $data = $this->categoryService->editCategoryData($data, $id);
            return response()->json();
        } catch (Exception $e) {
            return $e->getMessage();
        };
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public static function tree_view($categories, $parent_id = null)
    {
            foreach ($categories as $cate) {
                if($cate->parent_id === $parent_id){
                    if(count($cate->hasChild) != 0){
                        echo('<li id="'.$cate->id.'" ><span class="caret" id="'.$cate->id.'"></span><span style="width:100%"  >'.$cate->name.'</span>
                            <button  id="'.$cate->id.'" data-toggle="modal" data-target="#exampleModalCenter" data-action="add" class="hide btn-action bg-gradient-primary rounded">add</button>
                            <button  id="'.$cate->id.'" data-toggle="modal" data-target="#exampleModalCenter" data-action="edit"class="hide btn-action bg-gradient-primary rounded">edit</button>
                            <button  id="'.$cate->id.'" data-action="del"class="hide btn-action bg-gradient-primary rounded">del</button>');
                        echo('</li>');
                            echo ('<ul class="nested" id="'.$cate->id.'">');
                                self::tree_view($categories, $cate->id);
                            echo('</ul>');
                    } else {
                        echo('<li id="'.$cate->id.'"><span >'.$cate->name.'</span>
                            <button  id="'.$cate->id.'" data-toggle="modal" data-target="#exampleModalCenter" data-action="add" class="hide btn-action bg-gradient-primary rounded">add</button>
                        <button  id="'.$cate->id.'" data-toggle="modal" data-target="#exampleModalCenter" data-action="edit"class="hide btn-action bg-gradient-primary rounded">edit</button>
                        <button  id="'.$cate->id.'" data-action="del"class="hide btn-action bg-gradient-primary rounded">del</button>
                        </li>');
                    }
                }
            };
    }

    public static function tree_view_selection($categories, $parent_id = null)
    {
            foreach ($categories as $cate) {
                if($cate->parent_id == $parent_id){
                    if(count($cate->hasChild) != 0){
                        echo('<li id="'.$cate->id.'" ><span class="caret" id="'.$cate->id.'"></span><input type="checkbox" id="check_box" data-value="'.$cate->name.'" data-id="'.$cate->id.'"><span style="width:100%"  >'.$cate->name.'</span>');
                        echo('</li>');
                            echo ('<ul class="nested" id="'.$cate->id.'">');
                                self::tree_view_selection($categories, $cate->id);
                            echo('</ul>');
                    } else {
                        echo('<li id="'.$cate->id.'"><input type="checkbox" id="check_box" name="" data-value="'.$cate->name.'" data-id="'.$cate->id.'"><span >'.$cate->name.'</span>
                        </li>');
                    }
                }
            };
    }
}
