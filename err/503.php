<?php

$ecode = "0x1e5ec3b0";
$ehttp = "503";
$espec = "Service Unavailable";
$edesc = "Un serveur distant ou serveur de cluster ne répond pas";

?>
<!DOCTYPE html>

<body>

    <head>

        <title>Oups... [<?= $ecode ?>]</title>
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
        <span id="release" style="font-size:small;opacity:.75;"><?= date("d/m/Y H:i:s") ?><br>v<?= PHP_VERSION ?></span>
        <div id="container" style="position:fixed;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;text-align:center;max-width:100%;">
            <div style="overflow:auto;">
                <h1 style="font-weight:inherit;">Oups... J'ai tout cassé !</h1>
                <p>Une erreur s'est produite, et nous ne parvenons pas à charger la page demandée. Veuillez réessayer ultérieurement.</p>
                <hr style="border-top:0;">
                <div style="text-align:left;">
                    <b>Code erreur interne :</b> <?= $ecode ?><br>
                    <b>Code erreur HTTP :</b> <?= $ehttp ?><br>
                    <b>Spécification :</b> <?= $espec ?><br>
                    <b>Description :</b> <?= $edesc ?><br>
                </div>
                <hr style="border-top:0;">
                <div style="text-align:left;">
                    <details id="technical" style="cursor:pointer;">
                        <summary onclick="if (!document.getElementById('technical').open) { event.target.innerText = 'Masquer les informations de support technique'; } else { event.target.innerText = 'Afficher les informations de support technique'; }">Afficher les informations de support technique</summary>
                        <div style="cursor:text;">
                            <b>Version du préprocesseur :</b> <?= PHP_VERSION ?><br>
                            <b>Version de <?= php_uname('s') ?> (<?= php_uname('m') ?>) :</b> <?= php_uname('r') ?> (<?= php_uname('v') ?>)<br>
                            <b>IPA du préprocesseur :</b> <?= PHP_SAPI ?><br>
                            <b>Client :</b> <?= $_SERVER['HTTP_USER_AGENT'] ?><br>
                            <b>URL :</b> <?= str_replace("<", "&lt;", str_replace(">", "&gt;", $_SERVER['REQUEST_URI'])); ?>
                        </div>
                    </details>
                </div>
                <hr style="border-top:0;">
                <div style="text-align:left;">
                    <ul>
                        <li>Le serveur est peut-être surchargé</li>
                        <li>Le serveur est peut-être en maintenance</li>
                        <li>Vous avez entré une URL incorrecte</li>
                        <li>Vous essayez d'accéder à une page à laquelle vous n'avez pas accès</li>
                    </ul>
                </div>
            </div>
        </div>
    </body>

</body>
