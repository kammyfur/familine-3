<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker4.php";
$udb = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/users.json"));

$registered = array_keys((array)$udb);
if ($_USER == "Administrateur" && isset($_GET['user'])) {
        $_USER = $_GET['user'];
    }
if (!in_array($_USER, $registered)) {
    header("Location: /net.familine.EditorsCloud/none");
    die();
}
$_PROFILE = $udb->$_USER;

?>
