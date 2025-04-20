<?php

if (isset($_GET['r'])) {
    $cb = str_replace("'", "-", str_replace("<", "-", str_replace(">", "-", str_replace("\"", "&quot;", base64_decode($_GET['r'])))));
} else {
    header("Location: /");
    die();
}

?>
<!DOCTYPE html>

<html>

    <head>

        <title>Changement de nom de domaine</title>
        <meta charset="utf-8">
        <style>
        
        :root {
            --font: url("http://famcdn.serveftp.com/font.ttf");
        }
        
        @font-face {
            src: var(--font);
            font-family: "Ubuntu Light";
        }
        
        </style>

    </head>
    
    <body style="background-color:#333333;color:white;font-family:'Ubuntu Light', sans-serif;font-weight:lighter;">
        <div id="container" style="position:fixed;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;text-align:center;max-width:100%;">
            <div style="overflow:auto;">
                <h1 style="font-weight:inherit;">Familine change de nom de domaine</h1>
                <p>Vous avez accédé à cette page via l'ancien nom de domaine (<b>familine.ddns.net</b>). Ce dernier sera désactivé à partir de septembre 2021. Vous devez donc mettre à jour vos favoris pour utiliser le nom <b>legacy.familine.mooo.com</b> à la place avant septembre 2021.</p>
                <button onclick="location.href='https://legacy.familine.mooo.com/'+atob('<?= base64_encode($cb); ?>');">Continuer</button>
            </div>
        </div>
    </body>

</html>
