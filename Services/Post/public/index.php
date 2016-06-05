<?php

require '../vendor/autoload.php';

use My\Engine\DI;
use My\Engine\Storage;

DI::start();

$router = Storage::get('Router');

$router->get('/posts/', 'PostController@all');
$router->get('/post/', 'PostController@get');
$router->get('/404', 'SystemController@notFound');
$router->post('/404', 'SystemController@notFound');

$app = Storage::get('App');
$app->run();