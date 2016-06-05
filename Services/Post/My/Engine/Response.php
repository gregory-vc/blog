<?php

namespace My\Engine;

class Response {

    /**
     * @var string
     */
    public $content;

    public function json($data) {
        $this->content = json_encode($data);
        return $this;
    }

    public function render()
    {
        header('Content-Type: application/json');
        echo $this->content;
    }
}
