<?php

namespace My\Controller;

use My\Engine\Request;
use My\Engine\Response;
use My\Engine\Storage;

class MainController {

    /**
     * @var Response
     */
    public $response;

    /**
     * @var Request
     */
    public $request;

    public function __construct()
    {
        $this->response = Storage::get('Response');
        $this->request = Storage::get('Request');
    }
}