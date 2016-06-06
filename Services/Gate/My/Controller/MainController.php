<?php

namespace My\Controller;

use My\Engine\Request;
use My\Engine\Response;
use My\Engine\Storage;
use My\Engine\Session;

class MainController {

    /**
     * @var Response
     */
    public $response;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var Session
     */
    public $session;

    public function __construct()
    {
        $this->response = Storage::get('Response');
        $this->request = Storage::get('Request');
        $this->session = Storage::get('Session');
    }
}