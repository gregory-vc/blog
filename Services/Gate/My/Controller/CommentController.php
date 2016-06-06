<?php

namespace My\Controller;

use My\Services\Comment;
use My\Engine\Redirect;

class CommentController extends MainController{

    public function add()
    {
        Comment::post('comment_add', $this->request->post);
        Redirect::go('/post/?id='.$this->request->post['post_id']);
    }
}