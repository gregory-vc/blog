<?php

namespace My\Service;

use My\Model\User;

class Auth {

    public function login($user, $password) {
        $hash = hash('sha256', $password);
        $user = User::findBy([
            'login' => $user,
            'password' => $hash
        ]);
        if (!empty($user) && is_array($user)) {
            $user = current($user);
            $user['token'] = bin2hex(random_bytes(30));
            User::save($user);
            return [
                'login' => $user['login'],
                'token' => $user['token']
            ];
        } else {
            throw new \Exception('Not found user');
        }
    }
    
    public function validate($token)
    {
        $user = User::findBy([
            'token' => $token,
        ]);
        if (!empty($user) && is_array($user)) {
            $user = current($user);
            return [
                'login' => $user['login'],
                'validate_result' => true
            ];
        } else {
            throw new \Exception('Not found user');
        }
        return $user;
    }
}
