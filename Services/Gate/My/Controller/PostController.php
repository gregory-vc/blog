<?php

namespace My\Controller;

use My\Engine\Response;
use My\Engine\Storage;
use My\Services\Post;

class PostController {

    /**
     * @var Response
     */
    private $response;
    
    public function __construct()
    {
        $this->response = Storage::get('Response');
    }

    public function all()
    {
        $posts = Post::requestGet('all');
        return $this->response->html('posts', $posts);
    }
}