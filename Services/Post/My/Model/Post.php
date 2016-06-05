<?php

namespace My\Model;

use My\Engine\Model;

class Post extends Model{
    
    public $table = 'post';
    
    public $key = 'post_id';
    
    public $attributes = [
        'post_id',
        'header',
        'body'
    ];
}
