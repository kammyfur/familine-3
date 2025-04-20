<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerAlt.php"; ?>
<?php

if ($_USER == "Administrateur" && isset($_GET['user'])) {
        $_USER = $_GET['user'];
    }

?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/private/navigation.php"; ?>
