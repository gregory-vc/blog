<?php

namespace My\Controller;

use My\Engine\Response;
use My\Engine\Storage;
use My\Engine\Request;
use My\Model\Comment;
use My\Model\Post;

class CommentController {

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
        $post_id = $this->request->getIntParam('post_id');
        $comments = Comment::find($post_id, 'post_id');
        return $this->response->json($comments);
    }

    public function add()
    {
        $post_id = Post::add($this->request->post);
        return $this->response->json([
            'post_id' => $post_id
        ]);
    }
}