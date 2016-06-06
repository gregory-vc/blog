<?php

namespace My\Engine;

use My\App;
use My\Service\Auth;

class DI {
    
    static public function start()
    {
        Storage::set('Request', new Request());
        Storage::set('Router', new Router());
        Storage::set('App', new App());
        Storage::set('Response', new Response());
        Storage::set('Auth', new Auth());
    }
}
