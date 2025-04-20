<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aperçu avant impression</title>

    <style>
    
    html, body {
        overflow: hidden;
        margin: 0;
        height: 100%;
    }

    iframe {
        width: 100%;
        height: 100%;
    }

    small {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        max-width: calc(100% - 300px);
        display: inline-block;
    }

    </style>

    <script>
    
    function print() {
        try {
            window.frames["preview"].focus();
            window.frames["preview"].contentWindow.print()
            setTimeout(() => {
                window.close();
            }, 500)
        } catch (e) { // Alternative
            alert(e);
        }
    }

    function about() {
        alert("Famiwiki Aperçu avant impression 1.0\nGère l'impression de pages sur Famiwiki\n\nCopyright © 2020-<?= date('Y') ?> Famiwiki, Tous droits réservés\n\nL'utilisation de ce programme en dehors du cadre de la suite Famiwiki est interdite.\nL'impression de documents externes est interdite et enregistrée et sera signalée au détenteur du document externe.");
    }

    function clause() {
        alert(" - Qualité non garantie\n - Certaines polices peuvent ne pas apparaître exactement telles qu'à l'écran\n - Famiwiki ne peut être tenu responsable de documents imprimés incorrectement")
    }
    
    </script>
</head>
<body>
    <button onclick="print();">Imprimer</button> <button onclick="window.close()">Fermer</button> <button onclick="about()">À propos</button> <button onclick="clause()">Non responsabilité</button>
    <iframe id="preview" src="<?php
    
    if (isset($_GET['u'])) {
        echo($_GET['u']);
    } else {
        if (isset($_GET['t'])) {
            echo("/index.php?title=" . urlencode($_GET['t']) . "&printable=yes&useskin=timeless");
        } else {
            echo("about:blank");
        }
    }
    
    ?>" frameborder="0"></iframe>
</body>
</html>