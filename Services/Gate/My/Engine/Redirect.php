<?php

namespace My\Engine;

use My\App;

class Redirect {

    static public function go($path)
    {
        header('Location: '.$path);
    }
}

