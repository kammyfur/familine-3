<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerPhoto.php";

$token = openssl_random_pseudo_bytes(32);
$token = bin2hex($token);

$data = [
    "familine" => true,
    "username" => $_USER
];

file_put_contents("/data-new/private/tokens/" . str_replace(".", "", str_replace("/", "", $token)) . ".json", json_encode($data));
header("Location: https://newfamiline.ddns.net/photo/?u=" . $token);
