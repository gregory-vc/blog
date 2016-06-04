<?php

namespace My\Controller;

use My\Engine\Response;
use My\Engine\Storage;

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
        return $this->response->html('posts', [
            'data' => 1324234
        ]);
    }
}