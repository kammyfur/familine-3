<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/judy/private/preproc.php";

if (isset($_GET['_'])) {
    if (strpos($_GET['_'], "..") === false) {
        $name = $_SERVER['DOCUMENT_ROOT'] . "/judy/resources/" . $_GET['_'];
        $fp = fopen($name, 'rb');

        header("Content-Type: " . mime_content_type($name));
        header("Content-Length: " . filesize($name));

        fpassthru($fp);
        exit;
    }
} else {
    die();
}
