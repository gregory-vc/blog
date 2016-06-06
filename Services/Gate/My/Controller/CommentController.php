<?php

namespace My\Controller;

use My\Engine\Request;
use My\Engine\Storage;
use My\Services\Comment;
use My\Engine\Redirect;

class CommentController {

    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->request = Storage::get('Request');
    }

    public function add()
    {
        Comment::post('comment_add', $this->request->post);
        Redirect::go('/post/?id='.$this->request->post['post_id']);
    }
}