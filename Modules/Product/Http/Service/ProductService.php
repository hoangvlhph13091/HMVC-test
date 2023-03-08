<?php

namespace Modules\Product\Http\Services;

use Modules\Product\Http\Repository\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Http\Resource\ProductCollection;
use InvalidArgumentException;

class ProductService
{
    /**
     * @var $ProductRepository
     */
    // protected $ProductRepository;

    /**
     * PostService constructor
     *
     * @param ProductRepository $ProductRepository
     */
    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function savePostData($data)
    {
          return $result = $this->ProductRepository->save($data);
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
        //     $result = $this->ProductRepository->updatePost($id, $data);

        //     return $result;
        // }

    }

    public function getAll()
    {
        return $this->ProductRepository->getAll();
    }

    public function searchPost($key)
    {
        return $this->ProductRepository->searchPost($key);
    }

    public function getOne($id)
    {
        return $this->ProductRepository->getOne($id);
    }
}

