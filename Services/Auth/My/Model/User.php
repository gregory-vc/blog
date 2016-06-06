<?php

namespace My\Model;

use My\Engine\Model;

class User extends Model{
    
    public $table = 'user';
    
    public $key = 'user_id';
    
    public $attributes = [
        'user_id',
        'login',
        'password',
        'token'
    ];
}
