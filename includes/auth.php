<?php

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

function send_request()
{
    try {
        $token = JWT::encode(
            [
                'sub' => $_SERVER['Remote-Name'] ?? $_SERVER['Remote-User'] ?? 'unknown',
                'nbf' => time() - 5,
                'exp' => time() + 5
            ],
            $_ENV['JWT_KEY'],
            'HS256'
        );

        echo $token;
        exit;

        $guzzle = new Client(['timeout'  => 2.0]);

        $guzzle->get('https://vosstraat.external.castelnuovo.xyz', [
            'headers' => [
                'Authorization' => $token
            ],
        ]);

        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
