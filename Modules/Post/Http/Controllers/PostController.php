<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Post;
use Modules\Post\Http\Requests\PostRequets;
use Modules\Post\Http\Services\PostService;
use Modules\Post\Http\Resource\PostCollection;

class PostController extends Controller
{

    protected $postService;
    /**
     * Display a listing of the resource.
     */

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::with('hasChild')->get();
        return view('post::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        return view('post::createForm');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function create(PostRequets $request)
    {
        $data = $request->except('_token');
        try {
            $data = $this->postService->savePostData($data);
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
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('post::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public static function tree_view($posts, $parent_id = null)
    {
            foreach ($posts as $post) {
                if($post->parent_id == $parent_id){
                    if(count($post->hasChild) != 0){
                        echo('<li id="'.$post->id.'" ><span class="caret" id="'.$post->id.'"></span><span style="width:100%"  >'.$post->title.'</span>
                            <a  id="'.$post->id.'" href="#" class="hide btn-action bg-blue-500 hover:bg-blue-700 text-white font-bold  px-1 rounded">+</a>
                            <a  id="'.$post->id.'" href="#" class="hide btn-action bg-blue-500 hover:bg-blue-700 text-white font-bold  px-1 rounded">-</a>
                            <a  id="'.$post->id.'" href="#" class="hide btn-action bg-blue-500 hover:bg-blue-700 text-white font-bold  px-1 rounded">?</a>');
                        echo('</li>');
                            echo ('<ul class="nested" id="'.$post->id.'">');
                                self::tree_view($posts, $post->id);
                            echo('</ul>');
                    } else {
                        echo('<li id="'.$post->id.'"><span >'.$post->title.'</span>
                            <a  id="'.$post->id.'" href="#" class="hide btn-action bg-blue-500 hover:bg-blue-700 text-white font-bold  px-1 rounded">+</a>
                            <a  id="'.$post->id.'" href="#" class="hide btn-action bg-blue-500 hover:bg-blue-700 text-white font-bold  px-1 rounded">-</a>
                            <a  id="'.$post->id.'" href="#" class="hide btn-action bg-blue-500 hover:bg-blue-700 text-white font-bold  px-1 rounded">?</a>
                        </li>');
                    }
                }
            };
    }

    public static function tree_view_selection($posts, $parent_id = null)
    {
            foreach ($posts as $post) {
                if($post->parent_id == $parent_id){
                    if(count($post->hasChild) != 0){
                        echo('<li id="'.$post->id.'" ><span class="caret" id="'.$post->id.'"></span><input type="checkbox" id="check_box" data-value="'.$post->title.'" data-id="'.$post->id.'"><span style="width:100%"  >'.$post->title.'</span>');
                        echo('</li>');
                            echo ('<ul class="nested" id="'.$post->id.'">');
                                self::tree_view_selection($posts, $post->id);
                            echo('</ul>');
                    } else {
                        echo('<li id="'.$post->id.'"><input type="checkbox" id="check_box" name="" data-value="'.$post->title.'" data-id="'.$post->id.'"><span >'.$post->title.'</span>
                        </li>');
                    }
                }
            };
    }
}
