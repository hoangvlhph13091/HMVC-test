<?php

namespace Modules\Post\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCollection extends JsonResource
{

    public function toArray($request)

    {   /**
        * Transform the resource into an array.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
        */
        // return [
        //     'id' => $this->id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ];
        return parent::toArray($request);
    }
}
