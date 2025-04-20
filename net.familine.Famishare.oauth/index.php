<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerShare.php";

$token = openssl_random_pseudo_bytes(32);
$token = bin2hex($token);

$data = [
    "familine" => true,
    "username" => $_USER
];

file_put_contents("/mnt/famishare/private/tokens/" . str_replace(".", "", str_replace("/", "", $token)) . ".json", json_encode($data));
header("Location: https://share.familine.minteck.org/callback/?u=" . $token);
