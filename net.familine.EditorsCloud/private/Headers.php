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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Familine Editors Cloud</title>
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="/net.familine.EditorsCloud/styles/main.css">
    <link rel="stylesheet" href="/net.familine.EditorsCloud/fonts/stylesheet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pushbar.js@1.0.0/src/pushbar.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
</head>
<body>
