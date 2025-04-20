<?php

$_u_def_fb = "\$default";

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_u_def_fb . ".json")) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_u_def_fb . ".json", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/\$default.json"));
}

$_PROFILE = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_u_def_fb . ".json"));
if (json_last_error() != JSON_ERROR_NONE) {
    die("Profil corrompu, erreur " . json_last_error() . " : " . json_last_error_msg());
}