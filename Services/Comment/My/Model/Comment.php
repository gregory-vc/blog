<?php

namespace My\Model;

use My\Engine\Model;

class Comment extends Model{
    
    public $table = 'comment';
    
    public $key = 'comment_id';
    
    public $attributes = [
        'comment_id',
        'name',
        'text'
    ];
}
