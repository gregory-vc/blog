<?php

namespace My\Controller;

use My\Engine\Request;
use My\Engine\Response;
use My\Engine\Storage;
use My\Services\Post;

class PostController {

    /**
     * @var Response
     */
    private $response;

    /**
     * @var Request
     */
    private $request;
    
    public function __construct()
    {
        $this->response = Storage::get('Response');
        $this->request = Storage::get('Request');
    }

    public function all()
    {
        $posts = Post::requestGet('all');
        return $this->response->html('posts', $posts);
    }

    public function get()
    {
        $id = $this->request->getIntParam('id');
        $post = Post::requestGet('find', [
            'id' => $id
        ]);
        return $this->response->html('post', $post);
    }
}