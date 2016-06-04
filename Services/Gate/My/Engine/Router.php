<?php

namespace My\Engine;

class Router {

    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->request = Storage::get('Request');
    }

    /**
     * @var array request map
     */
    private $map = [];

    public function get($path, $params)
    {
        $this->map['GET'][$path] = $params;
    }

    public function post($path, $params)
    {
        $this->map['POST'][$path] = $params;
    }

    public function getCurrent()
    {
        if (empty($this->map[$this->request->request_method])) {
            throw new \Exception('Not found method');
        }
        $current_map = $this->map[$this->request->request_method];

        if (empty($current_map[$this->request->uri])) {
            $current_route = $current_map['/404'];
        } else {
            $current_route = $current_map[$this->request->uri];
        }
        $this->request->setRoute($current_route);
        return $this->request;
    }
}
