<?php

namespace Modules\Product\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{

    public function toArray($request)

    {   /**
        * Transform the resource into an array.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
        */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'price' => $this->price,
            'post' => $this->post->title,
        ];
        // return parent::toArray($request);
    }
}
