<?php

require '../vendor/autoload.php';

use My\Engine\DI;
use My\Engine\Storage;

try {
    DI::start();
    $router = Storage::get('Router');
    $router->get('/posts/', 'PostController@all');
    $router->get('/post/', 'PostController@get');
    $router->post('/post/add/', 'PostController@add');
    $router->get('/404', 'SystemController@notFound');
    $app = Storage::get('App');
    $app->run();
} catch (\Exception $e) {
    echo json_encode([
       'error' => $e->getMessage() 
    ]);
}
