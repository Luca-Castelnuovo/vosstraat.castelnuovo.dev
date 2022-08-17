<?php

require '../vendor/autoload.php';
require '../includes/auth.php';

$success = null;

if (isset($_GET['open'])) {
    $success = send_request();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="/favicon.png" />
    <link rel="apple-touch-icon" href="/favicon.png">
    <title>Vosstraat Deur</title>
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
