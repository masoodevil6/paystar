<?php

namespace App\Http\Services\onTimeService\Keys;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class KeysService{


    public function generateJWT($payload , $secret)
    {
        return JWT::encode($payload, $secret, 'HS256');
    }

    public function getDecodeJwt($jwt , $secret){
        JWT::$leeway = 60;
        $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
        return (array) $decoded;
    }


    public function generateHmacSha512($string , $secret){
        return hash_hmac('SHA512', $string, $secret);
    }

}
