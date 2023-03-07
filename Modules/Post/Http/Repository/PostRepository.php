<?php

namespace Modules\Post\Http\Repository;

use Modules\Post\Entities\Post;

class PostRepository
{

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function save($data)
    {
        $post = new $this->post;

        $post->title = $data['title'];
        $post->content = $data['content'];

        $post->save();

        return $post->fresh();
    }

    public function getAll()
    {
        // return $this->post->get();
    }

    public function searchPost($key)
    {
        // return $this->post->where('title', 'like', "%$key%")->get();
    }

    public function getOne($id)
    {
        // return $this->post->find($id);
    }

    public function updatePost($id, $data)
    {
        // $post = $this->post->find($id);

        // $post->title = $data['title'];
        // $post->content = $data['content'];

        // $post->save();

        // return $post->fresh();

    }

}
