<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker2.php";

if (isset($_GET['id'])) {
    if (strpos($_GET['id'], "..") === false) {
        $name = $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/recycle/images/" . $_GET['id'];
        $fp = fopen($name, 'rb');

        header("Content-Type: " . mime_content_type($name));
        header("Content-Length: " . filesize($name));

        fpassthru($fp);
        exit;
    }
} else {
    die();
}