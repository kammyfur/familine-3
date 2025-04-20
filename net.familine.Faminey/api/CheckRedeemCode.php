<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker2.php";

global $_USER;
if (isset($_USER)) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json")) {
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE) {
            die("PROFILE ERROR");
        }
    } else {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", str_replace("\$\$uid\$\$", rand(111111111111, 999999999999), file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json")));
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE) {
            die("PROFILE ERROR");
        }
    }
}

$profile->credit = (float)number_format((float)$profile->credit, 2, '.', '');

if ($profile->disabled != false || $profile->credit <= -50) {
    die("DISABLED ACCOUNT");
}

if (isset($_POST['c'])) {
    $code = $_POST['c'];
} else {
    die("NO CODE SPECIFIED");
}

$codes = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/codes.json"));

$matched = false;
global $sel;
foreach ($codes as $item) {
    global $sel;

    if ($item->code == $code) {
        $matched = true;
        $sel = $item;
    }
}

if (!$matched) {
    die("in");
}

if ($sel->used) {
    die("us");
}

die("ok|" . $sel->value);