<?php

namespace Modules\Post\Http\Services;

use Modules\Post\Http\Repository\PostRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Post\Http\Resource\PostCollection;
use InvalidArgumentException;

class PostService
{
    /**
     * @var $postRepository
     */
    // protected $postRepository;

    /**
     * PostService constructor
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $PostRepository)
    {
        $this->PostRepository = $PostRepository;
    }

    public function savePostData($data)
    {
          return $result = $this->PostRepository->save($data);
            // return $result;

    }

    public function updatePostData($id, $data)
    {
        // $validator = Validator::make($data,[
        //     'title' => 'required',
        //     'content' => 'required'
        // ],[
        //     'title.required'=>'Tên Không Được Để Trống',
        //     'content.required'=>'content Không Được Để Trống'
        // ]);
        // if ($validator->fails()){
        //     $result =[
        //         'status' => 'failed',
        //         'error' => $validator->errors()->first(),
        //     ];
        //     return $result;
        // } else {
        //     $result = $this->postRepository->updatePost($id, $data);

        //     return $result;
        // }

    }

    public function getAll()
    {
        return $this->PostRepository->getAll();
    }

    public function searchPost($key)
    {
        return $this->PostRepository->searchPost($key);
    }

    public function getOne($id)
    {
        return $this->PostRepository->getOne($id);
    }
}

