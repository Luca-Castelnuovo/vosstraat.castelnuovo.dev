<?php

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

function send_request()
{
    try {
        $token = JWT::encode(
            [
                'sub' => $_SERVER['Remote-Name'] ?? $_SERVER['Remote-User'] ?? 'unknown',
                'nbf' => time() - 10,
                'exp' => time() + 10
            ],
            $_ENV['JWT_KEY'],
            'HS256'
        );

        $guzzle = new Client(['timeout'  => 5]);
        $guzzle->get('https://vosstraat.castelnuovo.xyz', [
            'headers' => [
                'Authorization' => $token
            ],
        ]);

        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
