<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerAlt.php"; ?>
<?php

if ($_USER == null) {
    header("Location: /login/?r=home");
    die();
}

if ($_USER == "Administrateur" && isset($_GET['user'])) {
    $_USER = $_GET['user'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[EOL] Familine : Des technologies fiables pour la famille</title>
    <link rel="shortcut icon" href="familine.png" type="image/png">
    <script src="/fwk/jquery.js"></script>
    <link rel="stylesheet" href="/home.css">
    <script>

        function fail() {
            location.reload();
        }

        function logout() {
            $("#logout").fadeIn(200);
            $.ajax("/net.familine.Famiwiki/api.php?action=query&meta=tokens&type=csrf&format=json", {
                cache: false,
                method: "GET",
                dataType: "html",

                error: (error) => {
                    console.error(error);
                    fail();
                },
                success: (data) => {
                    try {
                        tdata = JSON.parse(data);
                    } catch (e) {
                        console.warn("json error");
                        console.error(e);
                        console.error(data);
                        fail();
                        return;
                    }

                    if (tdata.batchcomplete == "") {
                        token = tdata.query.tokens.csrftoken;
                        $.ajax("/net.familine.Famiwiki/api.php?action=logout&format=json", {
                            cache: false,
                            data: {
                                token: token
                            },
                            processData: true,
                            method: "POST",
                            dataType: "html",

                            error: (error) => {
                                console.warn("ajax error");
                                console.error(error);
                                fail();
                            },
                            success: (data) => {
                                document.getElementById('logout').innerHTML = "Déconnexion terminée, redirection...";
                                location.reload();
                            },
                            timeout: 10000,

                        })
                    } else {
                        console.warn("api error");
                        console.error(data);
                        console.error(tdata);
                        fail();
                    }
                },
                timeout: 10000,

            })
        }

        function refreshClock() {
            el = document.getElementById('clock');

            date = new Date();
            days = date.getDate();
            weekday = date.getDay();
            month = date.getMonth() + 1;
            year = date.getFullYear();
            hours = date.getHours();
            minutes = date.getMinutes();

            switch (weekday) {
                case 1:
                    wdstr = "Lundi";
                    break;

                case 2:
                    wdstr = "Mardi";
                    break;

                case 3:
                    wdstr = "Mercredi";
                    break;

                case 4:
                    wdstr = "Jeudi";
                    break;

                case 5:
                    wdstr = "Vendredi";
                    break;

                case 6:
                    wdstr = "Samedi";
                    break;

                case 0:
                    wdstr = "Dimanche";
                    break;

                default:
                    wdstr = "Jour";
                    break;
            }

            switch (month) {
                case 1:
                    cmstr = "janvier";
                    break;

                case 2:
                    cmstr = "février";
                    break;

                case 3:
                    cmstr = "mars";
                    break;

                case 4:
                    cmstr = "avril";
                    break;

                case 5:
                    cmstr = "mai";
                    break;

                case 6:
                    cmstr = "juin";
                    break;

                case 7:
                    cmstr = "juillet";
                    break;

                case 8:
                    cmstr = "août";
                    break;

                case 9:
                    cmstr = "septembre";
                    break;

                case 10:
                    cmstr = "octobre";
                    break;

                case 11:
                    cmstr = "novembre";
                    break;

                case 12:
                    cmstr = "décembre";
                    break;

                default:
                    cmstr = "mois";
                    break;
            }

            if (days == 1) {
                mdstr = "1<sup>er</sup>";
            } else {
                mdstr = days;
            }

            if (minutes < 10) {
                tmstr = "0" + minutes;
            } else {
                tmstr = minutes;
            }

            el.innerHTML = wdstr + " " + mdstr + " " + cmstr + " " + hours + ":" + tmstr;
        }

    </script>
</head>
<body>
    <?php if ($_USER == null): ?>
        <center style="height:calc(100% - 38px);display:flex;justify-content:center;align-items:center;">
            <div id="loginrq">
                <h1>Connexion requise</h1>
                <p>Familine est un réseau privé. De ce fait, vous devez vous authentifier auprès du serveur d'authentification Familine avant d'accéder à l'intégralité du réseau<small>*</small></p>
                <p>Si vous avez oublié votre mot de passe, que vous voulez faire une demande de compte, ou que vous avez besoin d'aide, toutes les informations sont sur la page de connexion.</p>
                <?php if (isset($_COOKIE['mobileUI'])): ?>
                    <button onclick="location.href='/login/?r=mobile'">Se connecter</button>
                <?php else: ?>
                    <button onclick="location.href='/login/?r=home'">Se connecter</button>
                <?php endif; ?>
            </div>
        </center>
        <br>
        <small><small>*</small> Certains services ne sont accessibles uniquement par l'achat d'un abonnement optionnel</small>
    <?php else: ?>
        <div id="background" style="background-image:url('/lgimages/<?php

        switch (date('H')) {
            case '0':
                echo("night");
                break;

            case '1':
                echo("night");
                break;

            case '2':
                echo("night");
                break;

            case '3':
                echo("night");
                break;

            case '4':
                echo("night");
                break;

            case '5':
                echo("night");
                break;

            case '6':
                echo("night");
                break;

            case '7':
                echo("night");
                break;

            case '8':
                echo("morning");
                break;

            case '9':
                echo("morning");
                break;

            case '10':
                echo("morning");
                break;

            case '11':
                echo("morning");
                break;

            case '12':
                echo("afternoon");
                break;

            case '13':
                echo("afternoon");
                break;

            case '14':
                echo("afternoon");
                break;

            case '15':
                echo("afternoon");
                break;

            case '16':
                echo("afternoon");
                break;

            case '17':
                echo("afternoon");
                break;

            case '18':
                echo("evening");
                break;

            case '19':
                echo("evening");
                break;

            case '20':
                echo("evening");
                break;

            case '21':
                echo("evening");
                break;

            case '22':
                echo("night");
                break;

            case '23':
                echo("night");
                break;

            default:
                echo("demo");
                break;
        }

        ?>.jpg');"></div>
        <br id="background-escape">
        <center><h1><?php

        switch (date('H')) {
            case '0':
                echo("Bonne nuit");
                break;

            case '1':
                echo("Dormez bien");
                break;

            case '2':
                echo("Dormez bien");
                break;

            case '3':
                echo("Dormez bien");
                break;

            case '4':
                echo("Dormez bien");
                break;

            case '5':
                echo("Dormez bien");
                break;

            case '6':
                echo("Bon début de matinée");
                break;

            case '7':
                echo("Bon matin");
                break;

            case '8':
                echo("Bonne journée");
                break;

            case '9':
                echo("Bonne journée");
                break;

            case '10':
                echo("Bonne journée");
                break;

            case '11':
                echo("Bonne fin de matinée");
                break;

            case '12':
                echo("Bon appétit");
                break;

            case '13':
                echo("Bon début d'après-midi");
                break;

            case '14':
                echo("Bonne après-midi");
                break;

            case '15':
                echo("Bonne après-midi");
                break;

            case '16':
                echo("Bonne fin d'après-midi");
                break;

            case '17':
                echo("Bonne fin d'après-midi");
                break;

            case '18':
                echo("Bonne fin d'après-midi");
                break;

            case '19':
                echo("Bon appétit");
                break;

            case '20':
                echo("Bonne soirée");
                break;

            case '21':
                echo("Bonne soirée");
                break;

            case '22':
                echo("Bonne nuit");
                break;

            case '23':
                echo("Bonne nuit");
                break;

            default:
                echo("Salut");
                break;
        }
        echo(" " . $_USER . " !");

        ?></h1><p id="clock">Lundi 1<sup>er</sup> janvier 00:00</p></center><script>refreshClock()</script>
        <hr>
        <div id="banner">
            <center>
                <h1 style="margin:0;"><img src="/familine.png" width="64px" style="vertical-align: middle;"> Familine</h1>
                <small style="padding-bottom:10px;display:block;"><a class="alink" onclick="logout();">Déconnexion</a> ­— <a class="alink" onclick="location.href='/plus'">Gérer l'abonnement Familine Plus</a><br><span style="color:red;background:yellow;"><b>Prochains changements, RECHERCHE DE TESTEURS :</b> <a class="alink" onclick="location.href='/fwk_new'" style="color:red;">Nouvelle IU de navigation</a>, <a class="alink" onclick="location.href='/search/?q=XXX'" style="color:red;">Moteur de recherche</a>, <a class="alink" onclick="location.href='/home'" style="color:red;">Tableau de bord</a>, <a class="alink" onclick="location.href='mailto:XXX@protonmail.com'" style="color:red;">Signaler un bug (TRÈS IMPORTANT)</a></span></small>
            </center>
        </div>
        <div id="content">
            <h2>Services accessibles immédiatement</h2>
            <div class="service">
                <img src="/net.familine.Famiwiki/logo.svg" width="128px" class="service-logo">
                <div class="service-info">
                    <h3>Famiwiki <button onclick="location.href='/fwk'">Ouvrir</button></h3>
                    <p>Partagez, apprenez et communiquez sur les membres, projets, événements et bien plus au sein de notre famille. Famiwiki compte actuellement plus de 300 personnes des années 1700 à aujourd'hui.</p>
                </div>
            </div>
            <div class="service">
                <img src="/net.familine.Faminews/logo.png" width="128px" class="service-logo">
                <div class="service-info">
                    <h3>Faminews <button onclick="location.href='/fns'">Ouvrir</button></h3>
                    <p>Le journal d'informations sur Familine et notre famille. Obtenez chaque jour de brêves nouvelles sur l'état de Familine ainsi que de notre famille, rédigé par vous pour vous.</p>
                </div>
            </div>
            <div class="service">
                <img src="/net.familine.Famiprods/favicon.png" width="128px" class="service-logo">
                <div class="service-info">
                    <h3>Famiprods <button onclick="location.href='/fps'">Ouvrir</button></h3>
                    <p>Studio de films de renommée familiale, Famiprods écrit, tourne, réalise, monte et produit de nombreux films, que vous pouvez voir ou revoir à tout moment sur leur site officiel.</p>
                </div>
            </div>
            <div class="service">
                <img src="/net.familine.Faminey/logo.png" width="128px" class="service-logo">
                <div class="service-info">
                    <h3>Faminey <button onclick="location.href='/fpn'">Ouvrir</button></h3>
                    <p>Créditez votre compte bancaire virtuel avec de l'argent réel afin d'acheter des produits et services proposés par Familine, tels que l'abonnement Famiwiki Premium : une exclusivité Faminey.</p>
                </div>
            </div>

            <hr class="nom">

            <h2>Services demandant une connexion supplémentaire</h2>
            <div class="service">
                <img src="/net.familine.Famipun/public/logo.png" width="128px" class="service-logo">
                <div class="service-info">
                    <h3>Famipun<small> (réquiert un compte sur l'instance PRONOTE de Familine)</small> <button onclick="location.href='/pun'">Ouvrir</button></h3>
                    <p>Gestion informatique des membres de la famille. Invitations, incidents, sanctions, punitions, discussions et bien plus en un seul endroit, propulsé par des technologies françaises.</p>
                </div>
            </div>
            <div class="service">
                <img src="/net.familine.EditorsCloud/flstatus.png" width="128px" class="service-logo">
                <div class="service-info">
                    <h3>Editors Cloud<small> (réquiert une autorisation et/ou un abonnement Famiwiki Premium)</small> <button onclick="location.href='/fcd'">Ouvrir</button></h3>
                    <p>Un espace de stockage privé, fiable et sécurisé. Stockez sereinement vos fichiers personnels et accédez-y depuis n'importe quel appareil, en utilisant un gestionnaire de fichiers compatible CIFS ou simplement un navigateur Internet <small>(support du navigateur Internet en lecture seule)</small>.</p>
                </div>
            </div>
        </div>
        <div id="footer">
            <p>
                Bannière par <?= !isset($hideLinks) ? '<a class="link" href="https://twitter.com/TalkingTadPol" target="_blank">' : '' ?>Brabbit<?= !isset($hideLinks) ? '</a>' : '' ?>, Kit et Jade sont des personnages créés par <a class="link" href="httpss://twitter.com/TalkingTadPol" target="_blank">Brabbit</a>, © <a class="link" href="httpss://twitter.com/TalkingTadPol" target="_blank">Brabbit</a><br>
                Logos et charte graphique de Familine et des services associés par Familine, © Familine, Tous droits réservés
            </p>
            <p>
                © <?= date('Y') == '2020' ? "2020" : "2020-" . date('Y') ?> Familine<br>
                © 2019-<?= date('Y') ?> <?= !isset($hideLinks) ? '<a class="link" href="https://minteck-projects.alwaysdata.net">' : '' ?>Minteck Projects Private Family Services<?= !isset($hideLinks) ? '</a>' : '' ?><br>
                © 2013-<?= date('Y') ?> <?= !isset($hideLinks) ? '<a class="link" href="https://minteck-projects.alwaysdata.net">' : '' ?>Minteck Projects<?= !isset($hideLinks) ? '</a>' : '' ?>
            </p>
            <p>Toutes les informations présentes sur les services de Familine sont confidentielles et doivent le rester. Toute divulgation des informations personnelles pour une quelconque raison peut mener à des poursuites judiciaires.</p>
            <p>Merci de ne pas faire de lien entre Minteck Projects et la famille XXX.</p>
        </div>
        <div id="logout" style="display:none;">
            Déconnexion en cours... Veuillez patienter
        </div>
        <script>
            setInterval(refreshClock, 200)
        </script>
    <?php endif; ?>
</body>
</html>
