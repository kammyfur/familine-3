<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker8.php";

?>
<!DOCTYPE html>

<html>

    <head>
        <title><?php

            if (isset($_TITLE)) {
                echo($_TITLE . " | Famiload");
            } else {
                echo("Famiload");
            }

            ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="/media/resources/main.js"></script>
    </head>

    <body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/media/includes/Navigation.php"; ?>