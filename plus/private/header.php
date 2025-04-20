<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker6.php";

if ($_USER == "Administrateur" && isset($_GET['user'])) {
    $_USER = $_GET['user'];
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json")) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/\$default.json"));
}

$_PROFILE = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json"));
if (json_last_error() != JSON_ERROR_NONE) {
    die("Profil corrompu, erreur " . json_last_error() . " : " . json_last_error_msg());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_TITLE ?> — Familine Plus</title>
    <link rel="shortcut icon" href="/logos/plus/plus64.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/plus/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="/plus">
            <img src="/logos/plus/plus128.png" alt="Logo" style="width:40px;">
            Familine Plus
        </a>
        <ul class="navbar-nav">
            <li class="nav-item active" style="float:right;">
                <a class="nav-link" href="<?php
        
                if (isset($_COOKIE['mobileUI'])) {
                    echo("/mobile.php");
                } else {
                    echo("/");
                }
                
                ?>">par Familine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/plus/#compare">Comparer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/plus/remove">Résilier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/plus/status">État</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/plus/refund">Remboursement</a>
            </li>
        </ul>
    </nav>
