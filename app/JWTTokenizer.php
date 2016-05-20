<?php

use Firebase\JWT\JWT;

class JWTTokenizer
{
    public function encode($key, $secret)
    {
        $token = array(
            "iss"   => $key
        );

        return JWT::encode($token, $secret);
    }

    public function decode($jwt, $secret)
    {
        return JWT::decode($jwt, $secret, ['HS256']);
    }
}
