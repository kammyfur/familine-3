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
    $cred = $_POST['c'];
} else {
    die("NO CREDIT SPECIFIED");
}

if (isset($_POST['r'])) {
    $reas = $_POST['r'];
} else {
    die("NO REASON SPECIFIED");
}

if ($profile->credit < $cred) {
    die("ze");
}

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

if ($destination->disabled != false || $destination->credit <= -50) {
    die("di");
}

if ($u2 == $_USER) {
    die("su");
}

$doel_dest = [];
$doel_dest["to"] = $u2;
$doel_dest["cost"] = $cred;
$doel_dest["date"] = date("d/m/Y");
$doel_dest["type"] = "donate";
if (trim($reas) == "") {
    $doel_dest["name"] = "Don de " . $_USER;
} else {
    $doel_dest["name"] = "Don de " . $_USER . " : " . $reas;
}

$doel_srce = [];
$doel_srce["to"] = $u2;
$doel_srce["cost"] = (int)("-" . $cred);
$doel_srce["date"] = date("d/m/Y");
$doel_srce["type"] = "donate";
if (trim($reas) == "") {
    $doel_srce["name"] = "Don sans raison";
} else {
    $doel_srce["name"] = $reas;
}

array_unshift($profile->history, $doel_srce);
$profile->credit = $profile->credit - $cred;

file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", json_encode($profile, JSON_PRETTY_PRINT));

array_unshift($destination->history, $doel_dest);
$destination->credit = $destination->credit + $cred;

file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $u2 . ".json", json_encode($destination, JSON_PRETTY_PRINT));

if ($profile->credit <= 0) {
    die("em");
} else {
    die("ok");
}