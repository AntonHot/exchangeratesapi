<?php

namespace Libs;

use Libs\Exceptions\ValidateException;

class Validator {

    private static $_userName = 'Ivan Ivanov';

    public static function validate($jwt) {
        $user = self::decode($jwt);
        
        if ($user['body']->name !== self::$_userName) {
            throw new ValidateException('There is no such user');
        }
        
        if ($user['body']->iat < time()) {
            throw new ValidateException('The key has expired');
        }
    }

    public static function decode($jwt) {
        $jwtExploded = explode('.', $jwt);

        if (count($jwtExploded) !== 3) {
            throw new ValidateException('Wrong key');
        }

        list($headb64, $bodyb64, $cryptob64) = $jwtExploded;

        $head = json_decode(base64_decode($headb64, true));
        $body = json_decode(base64_decode($bodyb64, true));
        $crypto = json_decode(base64_decode($cryptob64, true));

        return [
            'head' => $head,
            'body' => $body,
            'crypto' => $crypto
        ];
    }
}
