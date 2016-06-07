<?php

namespace My\Controller;

class SystemController extends MainController {

    public function notFound()
    {
        return $this->response->html('404', [
            'data' => 1324234
        ]);
    }
}