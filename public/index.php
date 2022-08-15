<?php

require '../vendor/autoload.php';

use Dotenv\Dotenv;
use CQ\Crypto\Helpers\Token;
use GuzzleHttp\Client;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$success = null;

if (isset($_GET['open'])) {
    try {
        $token = Token::encrypt(
            key: $_ENV['TOKEN_KEY'],
            data: [
                'name' => $_SERVER['Remote-Name'] ?? $_SERVER['Remote-User'] ?? 'unknown',
                'exp' => time() + 10,
            ]
        );

        $guzzle = new Client(['timeout'  => 2.0]);

        $response = $guzzle->get('https://vosstraat.external.castelnuovo.xyz', [
            'headers' => [
                'Authorization' => $token
            ],
        ]);

        $success = true;
    } catch (\Throwable $th) {
        $success = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vosstraat Deur</title>
    <link href="./style.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <p class="title">Vosstraat 2, 6511VH</p>

        <?php if ($success === true) : ?>
            <a href="#" type="button" class="btn btn-success">Success, deur open</a>
        <?php endif ?>

        <?php if ($success === false) : ?>
            <a href="#" type="button" class="btn btn-error">Error, probeer opnieuw</a>
        <?php endif; ?>

        <?php if ($success !== null) : ?>
            <br><br>
        <?php endif ?>

        <a href="/?open" type="button" class="btn btn-primary">Open de deur</a>
    </div>
</body>

</html>
