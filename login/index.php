<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/ddos/session.php";

/*

TODO: Re-enable this

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

*/

if (isset($_GET['r'])) {
    if ($_GET['r'] == "fwk") {
        $rstr = "Famiwiki";
        $rstr2 = "Famiwiki";
        $rstr3 = "Famiwiki";
        $logo = "/logos/famiwiki/famiwiki128.png";
        $ret = "/fwk";
    }
    if ($_GET['r'] == "pass") {
        $rstr = "Chgmt. mot de p.";
        $rstr2 = "le changement de mot de passe";
        $rstr3 = "Confirmation";
        $logo = "/uii/auth-alt.svg";
        $ret = "/fwk/#/index.php/Spécial:ChangeCredentials";
    }
    if ($_GET['r'] == "frt") {
        $rstr = "Famirity";
        $rstr2 = "Famirity";
        $rstr3 = "Famirity";
        $logo = "/logos/famirity/famirity128.png";
        $ret = "/frt";
    }
    if ($_GET['r'] == "fns") {
        $rstr = "Faminews";
        $rstr2 = "Faminews";
        $rstr3 = "Faminews";
        $logo = "/logos/faminews/faminews128.png";
        $ret = "/fns";
    }
    if ($_GET['r'] == "pun") {
        $rstr = "Famipun";
        $rstr2 = "le service client Famipun";
        $rstr3 = "Service Client Famipun";
        $logo = "/logos/famipun/famipun128.png";
        $ret = "/pun";
    }
    if ($_GET['r'] == "cloud") {
        $rstr = "Editors Cloud";
        $rstr2 = "Familine Editors Cloud";
        $rstr4 = "Editors Cloud";
        $logo = "/logos/cloud/cloud128.png";
        $ret = "/fcd";
    }
    if ($_GET['r'] == "home") {
        $rstr = "Familine";
        $rstr2 = "l'espace accueil";
        $rstr3 = "Connexion";
        $logo = "/uii/home.svg";
        $ret = "/home";
    }
    if ($_GET['r'] == "plus") {
        $rstr = "Familine Plus";
        $rstr2 = "Familine Plus";
        $rstr3 = "Familine Plus";
        $logo = "/logos/plus/plus128.png";
        $ret = "/plus";
    }
    if ($_GET['r'] == "mobile") {
        $rstr = "Familine Mobile";
        $rstr2 = "l'application mobile";
        $rstr3 = "Familine Mobile";
        $logo = "/uii/mobile.svg";
        $ret = "/mobile.php";
    }
    if ($_GET['r'] == "client") {
        if (isset($_GET['v'])) {
            $_GET['v'] = trim(str_replace("<", "", str_replace(">", "", $_GET['v'])));
            $rstr = "Client Familine " . $_GET['v'];
            $rstr2 = "le client de bureau";
            $rstr3 = "Client Familine " . $_GET['v'];
            $logo = "/uii/desktop.svg";
            $ret = "/client.php";
        } else {
            header("Location: /login/?r=client&v=2020");
            die();
        }
    }
    if ($_GET['r'] == "pun1") {
        $rstr = "Famipun";
        $rstr2 = "la page de récupération des identifiants Famipun";
        $rstr3 = "Service Client Famipun";
        $logo = "/logos/famipun/famipun128.png";
        $ret = "/pun/#/credentials";
    }
    if ($_GET['r'] == "gepi") {
        $rstr = "Gepi";
        $rstr2 = "l'instance Gepi de Famipun";
        $rstr3 = "Gepi";
        $logo = "/logos/famipun/famipun128.png";
        $ret = "/gepi";
    }
    if ($_GET['r'] == "ney") {
        $rstr = "Faminey";
        $rstr2 = "Faminey";
        $rstr3 = "Faminey";
        $logo = "/logos/faminey/faminey128.png";
        $ret = "/fpn";
    }
    if ($_GET['r'] == "fps") {
        $rstr = "Famiprods.net";
        $rstr2 = "Famiprods.net";
        $rstr3 = "Famiprods.net";
        $logo = "/logos/prodsnet/prodsnet128.png";
        $ret = "/fps";
    }
    if ($_GET['r'] == "cinema") {
        $rstr = "Faminema";
        $rstr2 = "Faminema";
        $rstr3 = "Faminema";
        $logo = "https://faminema.ddns.net/favicon.png";
        $ret = "/net.familine.Faminema.oauth";
    }
    if ($_GET['r'] == "share") {
        $rstr = "Famishare";
        $rstr2 = "Famishare";
        $rstr3 = "Famishare";
        $logo = "about:blank";
        $ret = "/net.familine.Famishare.oauth";
    }
    if ($_GET['r'] == "migrator") {
        $rstr = "JetBrains Space";
        $rstr2 = "l'assistant Migration vers JetBrains Space";
        $rstr3 = "Assistant Migration";
        $logo = "about:blank";
        $ret = "/migrate";
    }
    if ($_GET['r'] == "photo") {
        $rstr = "Famiphoto";
        $rstr2 = "Famiphoto";
        $rstr3 = "Famiphoto";
        $logo = "about:blank";
        $ret = "/net.familine.Famiphoto.oauth";
    }
    if ($_GET['r'] == "nmb") {
        $rstr = "NMb";
        $rstr2 = "NMb";
        $rstr3 = "NMb";
        $logo = "/logos/familine/familine128.png";
        $ret = "/nmb";
    }
    if (!isset($rstr)) {
        header("Location: /login/?r=home");
        die();
    }
} else {
    header("Location: /login/?r=home");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $rstr3 ?> | Familine</title>
    <script src="login.js"></script>
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="common.css">
    <link rel="shortcut icon" href="/logos/familine/familine48.png" type="image/png">
    <script>

    goBackTo = "<?= $ret ?>";
    goBackName = "<?= $rstr2 ?>";

    </script>
</head>
<body>
    <div id="container">
        <div id="image"></div>
        <div id="box">
            <center>
                <img src="/logos/familine/familine128.png" class="logo"> &nbsp; <span class="title">Familine</span> <span class="separator">+</span> <img src="<?= $logo ?>" class="logo"> &nbsp; <span class="title"><?= $rstr ?></span>

                <h1>Connexion</h1>
                <p id="tagline">Continuer vers <?= $rstr2 ?></p>

                <input type="text" name="username" id="lguser" placeholder="Nom d'utilisateur"><br>
                <input type="password" name="password" id="lgpass" placeholder="Mot de passe"><br>

                <button onclick="login();">Se connecter</button>
                <p><small><a href="/fwk/#/index.php/Spécial:Demander_un_compte" class="link">demander un compte</a> | <a href="/fwk/#/index.php/Spécial:Réinitialisation_du_mot_de_passe" class="link">mot de passe oublié</a> | <a href="mailto:freeziv.ytb+familine-bugs-offline@gmail.com" class="link">signaler un bug</a></small></p>
            </center>
        </div>
    </div>
    <div id="loggingin" style="display: none;">
        <center>
            <h1>Connexion en cours...</h1>
            <p id="state">Initialisation du système d'authentification...</p>
            <progress max="5" value="1" id="status"></progress><br>
            <button id="errorbtn" onclick="document.getElementById('loggingin').style.display = 'none';" style="display: none;">Retour</button>
        </center>
    </div>
</body>
</html>
