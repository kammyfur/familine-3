<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/judy/private/preproc.php";

if (isset($_GET['t'])) {
    $text = str_replace("\"", "'", urldecode(base64_decode($_GET['t'])));
    $text = str_replace(">", "", $text);
    $text = str_replace("<", "", $text);
    $text = str_replace("|", "", $text);
    $text = str_replace("$", "", $text);
    $text = str_replace("Judy", "Djoudie", $text);
    $text = str_replace("Familine", "Familaïne", $text);
    $text = str_replace("Famiprods", "Famiprodse", $text);
    $text = str_replace("Michael", "Mickael", $text);
    $text = str_replace("Ledeuil", "Le deuil", $text);
    $text = str_replace("COVID-19", "COVID 19", $text);
    $text = str_replace("coronavirus", "coronavirusse", $text);
    //die($text);
    $name = "/tmp/" . uniqid() . ".wav";
    
    exec("pico2wave -l fr-FR -w {$name} \"{$text}\"");

    header("Content-Type: " . mime_content_type($name));
    header("Content-Length: " . filesize($name));

    echo file_get_contents($name);
    unlink($name);
    exit;
} else {
    die();
}