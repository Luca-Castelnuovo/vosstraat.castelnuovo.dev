<?php

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

function send_request()
{
    try {
        if (!str_contains($_SERVER['HTTP_REMOTE_GROUPS'], 'vosstraat')) {
            return false;
        }

        $token = JWT::encode(
            [
                'sub' => $_SERVER['HTTP_REMOTE_USER'] ?? $_SERVER['HTTP_REMOTE_NAME'] ?? 'unknown',
                'nbf' => time() - 10,
                'exp' => time() + 10
            ],
            $_ENV['JWT_KEY'],
            'HS256'
        );

        $guzzle = new Client(['timeout'  => 10]);
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
