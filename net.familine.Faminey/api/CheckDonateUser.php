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

if (isset($_POST['u'])) {
    $u2 = $_POST['u'];
} else {
    die("NO USER SPECIFIED");
}

$u2 = trim($u2);

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $u2 . ".json")) {
    $destination = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $u2 . ".json"));

    if (json_last_error() != JSON_ERROR_NONE) {
        die("in");
    }
} else {
    die("no");
}

if ($profile->disabled != false || $profile->credit <= -50) {
    die("DISABLED ACCOUNT");
}

if ($destination->disabled != false || $destination->credit <= -50) {
    die("di");
}

if ($u2 == $_USER) {
    die("su");
}

die("ok");