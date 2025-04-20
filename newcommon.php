<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerAlt.php";
if (isset($_USER)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/loader.php";
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/loader.fb.php";
}

if (isset($_USER)) {
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json")) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/\$default.json"));
    }

    $_PLUS = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/" . $_USER . ".json"));
    if (json_last_error() != JSON_ERROR_NONE) {
        $_PLUS = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/plus/profiles/\$default.json");
    }
}

if (isset($_USER)) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json")) {
        $_MONEY = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE) {
            $_MONEY = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json"));
        }
    } else {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", str_replace("\$\$uid\$\$", rand(111111111111, 999999999999), file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json")));
        $_MONEY = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE) {
            $_MONEY = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json"));
        }
    }
}

$_MONEY->credit = (float)number_format((float)$_MONEY->credit, 2, '.', '');

if ($_MONEY->disabled != false || $_MONEY->credit <= -50) {
    header("Location: /net.familine.Faminey/disabled/");
    die();
}

$config = [
    "active" => $conf,
    "sites" => [
        "famiwiki" => [
            "www" => "/net.familine.Famiwiki/",
            "icon" => "/logos/famiwiki/famiwiki64.png",
            "name" => "Famiwiki",
            "root" => "/fwk"
        ],
        "faminews" => [
            "www" => "/net.familine.Faminews/",
            "icon" => "/logos/faminews/faminews64.png",
            "name" => "Faminews",
            "root" => "/fns"
        ],
        "famiprods" => [
            "www" => "/net.familine.Famiprods/",
            "icon" => "/logos/prodsnet/prodsnet64.png",
            "name" => "Famiprods.net",
            "root" => "/fps"
        ],
        "faminey" => [
            "www" => "/net.familine.Faminey/",
            "icon" => "/logos/faminey/faminey64.png",
            "name" => "Faminey",
            "root" => "/fpn"
        ],
        "famipun" => [
            "www" => "/net.familine.Famipun/",
            "icon" => "/logos/famipun/famipun64.png",
            "name" => "Famipun",
            "root" => "/pun"
        ],
        "gepi" => [
            "www" => "/net.familine.gepi/",
            "icon" => "/logos/famipun/famipun64.png",
            "name" => "Gepi",
            "root" => "/gepi"
        ],
        "editors_cloud" => [
            "www" => "/net.familine.EditorsCloud/",
            "icon" => "/logos/cloud/cloud64.png",
            "name" => "Familine Editors Cloud",
            "root" => "/fcd"
        ],
    ]
];

$data = $config["sites"][$config["active"]];
$name = $data["name"];
$root = $data["www"];
$favicon = $data["icon"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?></title>
    <link rel="stylesheet" href="/common.css">
    <script src="/jquery.js"></script>
    <link rel="shortcut icon" href="<?= $favicon ?>"/>
    <script>

    config = JSON.parse("<?= str_replace("\"", "\\\"", json_encode($config)); ?>");
    assocs = {};

    Object.keys(config.sites).forEach((key) => {
        site = config.sites[key]
        assocs[site.root] = key;
    });

    </script>
</head>
<body>
    <div id="topbar">
        <a title="Changer de service" onclick="activities();" id="link-activities" class="link"><img id="activities-logo" class="link-logo" src="/uii/apps.svg"> <span class="link-text">Activités</span></a>
        <span id="currentapp">
            <img id="currentapp-logo" src="<?= $favicon ?>"> <span id="currentapp-name"><?= $name ?></span>
        </span><span id="clock"><form action="/search" id="fl-searchfrm">
            <input id="fl-searchbox" name="q" placeholder="Rechercher sur Familine" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <button type="submit" id="fl-searchsmb"><img src="https://familine.ddns.net/cdn/material/ic_search_24px.svg"></button>
        </form></span>
        <?php if ($_USER != null): ?>
            <a title="Voir des informations sur votre compte" onclick="account();" id="link-user" class="link link-right"><img id="user-logo" class="link-logo" src="/uii/menu.svg"> <span class="link-text"><?= $_USER ?></span></a>
        <?php else: ?>
            <a title="Se connecter à un compte Familine" onclick="login();" id="link-login" class="link link-right"><img id="login-logo" class="link-logo" src="/uii/login.svg"> <span class="link-text">Connexion</span></a>
        <?php endif; ?>
    </div>
    <div id="loadbar">
        <span id="loadbar-title"><?= $name ?></span>
        <span id="loadbar-logo"><img id="loader-inner" src="/uii/working.svg" width="24px" height="24px" class="load"></img></span>
    </div>
    <?php if (isset($inject)) { require $inject; } ?>
    <iframe id="content" src="<?= $root ?>" frameborder="0" <?= isset($_COOKIE['mobileUI']) ? 'style="height:calc(100% - 35px) !important;"' : '' ?>></iframe>
    <div id="loader"></div>
    <div id="view-activities" class="view" style="display:none;">
        <a title="Fermer cette vue et retourner à l'écran précédent" onclick="closeview();" id="close-activities" class="link link-close"><img id="close-activities-logo" class="link-logo" src="/uii/close.svg"> <span class="link-text">Fermer</span></a>

        <div id="view-activities-inner" class="view-inner">
            <center id="view-activities-content" class="view-content">
                <span id="acthead">
                    <img src="/uii/apps.svg" id="acthead-image" class="img-revert"></img> <span id="acthead-text">Activités</span>
                </span>

                <div id="appgrid">
                    <div onclick="location.href='/home';" class="app" id="app-home">
                        <img src="/uii/home.svg" width="36px" height="36px" class="app-image img-revert" id="app-home-image"></img>
                        <span class="app-text" id="app-home-text">Tableau de bord</span>
                        <span class="app-tagline" id="app-home-tagline">Retourner à la page d'accueil principale de Familine et accéder à votre espace d'accueil personnel.</span>
                    </div>
                
                    <div onclick="switchActivity('famiwiki');" class="app" id="app-famiwiki">
                        <img src="/logos/famiwiki/famiwiki128.png" width="36px" height="36px" class="app-image" id="app-famiwiki-image"></img>
                        <span class="app-text" id="app-famiwiki-text">Famiwiki</span>
                        <span class="app-tagline" id="app-famiwiki-tagline">Partagez, apprenez et communiquez sur des personnes, des projets, des événements et bien plus.</span>
                    </div>
                    
                    <div class="app" id="app-faminews">
                        <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-faminews-image"></img>
                        <span class="app-text" id="app-faminews-text">Indisponible</span>
                        <span class="app-tagline" id="app-faminews-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                    </div>
                    
                    <div class="app" id="app-faminews">
                        <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-faminews-image"></img>
                        <span class="app-text" id="app-faminews-text">Indisponible</span>
                        <span class="app-tagline" id="app-faminews-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                    </div>
                    
                    <div class="app" id="app-faminews">
                        <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-faminews-image"></img>
                        <span class="app-text" id="app-faminews-text">Indisponible</span>
                        <span class="app-tagline" id="app-faminews-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                    </div>
                    
                    <div class="app" id="app-faminews">
                        <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-faminews-image"></img>
                        <span class="app-text" id="app-faminews-text">Indisponible</span>
                        <span class="app-tagline" id="app-faminews-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                    </div>
                    
                    <div class="app" id="app-faminews">
                        <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-faminews-image"></img>
                        <span class="app-text" id="app-faminews-text">Indisponible</span>
                        <span class="app-tagline" id="app-faminews-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                    </div>
                    
                    <div onclick="location.href='/plus';" class="app" id="app-plus">
                        <img src="/logos/plus/plus128.png" width="36px" height="36px" class="app-image" id="app-plus-image"></img>
                        <span class="app-text" id="app-plus-text">Familine Plus</span>
                        <span class="app-tagline" id="app-plus-tagline">Étendez les possibilités des services de Familine et soutenez financièrement le développement et la maintenance du réseau.</span>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <?php if ($_USER != null): ?>
    <div id="view-account" class="view" style="display:none;">
        <a title="Fermer cette vue et retourner à l'écran précédent" onclick="closeview();" id="close-account" class="link link-close"><img id="close-account-logo" class="link-logo" src="/uii/close.svg"> <span class="link-text">Fermer</span></a>

        <div id="view-account-inner" class="view-inner">
            <center id="view-account-content" class="view-content">
                <span id="user">
                    <img src="/uii/user.svg" id="user-image" class="img-revert"></img> <span id="user-name"><?= $_USER ?></span>
                </span>

                <div id="categories">
                    <div class="category" id="category-wiki">
                        <h2>Famiwiki</h2>
                        <div onclick="closeview();location.href='/fwk/#/index.php/Utilisateur:<?= $_USER ?>'" class="element" id="element-page">
                            <img src="/uii/userpage.svg" width="36px" height="36px" class="element-image img-revert" id="element-page-image"></img>
                            <span class="element-text" id="element-page-text">Page utilisateur</span>
                        </div>
                        <div onclick="closeview();location.href='/fwk/#/index.php/Discussion utilisateur:<?= $_USER ?>'" class="element" id="element-chat">
                            <img src="/uii/chat.svg" width="36px" height="36px" class="element-image img-revert" id="element-chat-image"></img>
                            <span class="element-text" id="element-chat-text">Page de discussion</span>
                        </div>
                        <div onclick="closeview();location.href='/fwk/#/index.php/Spécial:Liste de suivi'" class="element" id="element-watch">
                            <img src="/uii/watchlist.svg" width="36px" height="36px" class="element-image img-revert" id="element-watch-image"></img>
                            <span class="element-text" id="element-watch-text">Liste de suivi</span>
                        </div>
                        <div onclick="closeview();location.href='/fwk/#/index.php/Spécial:Contributions/<?= $_USER ?>'" class="element" id="element-edits">
                            <img src="/uii/edits.svg" width="36px" height="36px" class="element-image img-revert" id="element-edits-image"></img>
                            <span class="element-text" id="element-edits-text">Contributions</span>
                        </div>
                    </div>
                    <div class="category" id="category-money">
                        <h2>Monétaire</h2>
                        <?php

                        switch ($_PLUS->subscription) {
                            case 0:
                                $message = "Acheter Familine Plus";
                                $free = true;
                                break;

                            case 1:
                                $message = "Familine Plus Lite";
                                $free = false;
                                break;

                            case 2:
                                $message = "Familine Plus Pro";
                                $free = false;
                                break;

                            case 3:
                                $message = "Familine Plus Ultimate";
                                $free = false;
                                break;

                            case 4:
                                $message = "Familine Plus Dreams";
                                $free = false;
                                break;

                            default:
                                $message = "Familine Unknown";
                                $free = false;
                                break;
                        }

                        if (!$free) {
                            if ($_PLUS->last != null) {
                                $parts = explode("-", $_PLUS->last);
                                $rnv = (int)$parts[2];
                                if ($rnv == date('d')) {
                                $message = "Renouv. auto. aujourd'hui";
                                    $alert = true;
                                } else if ($rnv == (date('d') + 1)) {
                                    $message = "Renouv. auto. demain";
                                    $alert = true;
                                } else {
                                    $alert = false;
                                }
                            }
                        } else {
                            $alert = false;
                        }

                        ?>
                        <div onclick="closeview();location.href='/plus/status'" class="element" id="element-plus">
                            <img src="/uii/<?php

                            if ($alert) {
                                echo("sub-note");
                            } else if (!$free) {
                                echo("sub-ok");
                            } else {
                                echo("sub-ad");
                            }

                            ?>.svg" width="36px" height="36px" class="element-image img-revert" id="element-plus-image"></img>
                            <span class="element-text" id="element-plus-text"><?= $message ?></span>
                        </div>
                        <div onclick="closeview();location.href='/fpn/#/'" class="element" id="element-credit">
                            <img src="/uii/money.svg" width="36px" height="36px" class="element-image img-revert" id="element-credit-image"></img>
                            <span class="element-text" id="element-credit-text"><?= str_replace(".", ",", $_MONEY->credit) ?> €</span>
                        </div>
                        <div onclick="closeview();location.href='/fpn/#/credit'" class="element" id="element-give">
                            <img src="/uii/credit.svg" width="36px" height="36px" class="element-image img-revert" id="element-give-image"></img>
                            <span class="element-text" id="element-give-text">Créditer le compte</span>
                        </div>
                        <div onclick="closeview();location.href='/fpn/#/donate'" class="element" id="element-donate">
                            <img src="/uii/donate.svg" width="36px" height="36px" class="element-image img-revert" id="element-donate-image"></img>
                            <span class="element-text" id="element-donate-text">Faire un don</span>
                        </div>
                    </div>
                    <div class="category" id="category-main">
                        <h2>Compte</h2>
                        <div onclick="closeview();location.href='/fwk/#/index.php/Spécial:Préférences'" class="element" id="element-prefs">
                            <img src="/uii/settings.svg" width="36px" height="36px" class="element-image img-revert" id="element-prefs-image"></img>
                            <span class="element-text" id="element-prefs-text">Paramètres</span>
                        </div>
                        <div onclick="closeview();location.href='/login/?r=pass'" class="element" id="element-pass">
                            <img src="/uii/auth.svg" width="36px" height="36px" class="element-image img-revert" id="element-pass-image"></img>
                            <span class="element-text" id="element-pass-text">Changer de mot de passe</span>
                        </div>
                        <div onclick="closeview();location.href='mailto:freeziv.ytb+bugs@gmail.com'" class="element" id="element-bugs">
                            <img src="/uii/report.svg" width="36px" height="36px" class="element-image img-revert" id="element-bugs-image"></img>
                            <span class="element-text" id="element-bugs-text">Signaler un bug</span>
                        </div>
                        <div onclick="closeview();logout();" class="element" id="element-logout">
                            <img src="/uii/logout.svg" width="36px" height="36px" class="element-image img-revert" id="element-logout-image"></img>
                            <span class="element-text" id="element-logout-text">Déconnexion</span>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <div id="logout" style="display:none;">
        Déconnexion en cours... Veuillez patienter
    </div>
    <?php endif; ?>
</body>

<script>
    redirect = true;
    fullpath = "<?= $root ?>";

    ot = document.title;

        function notif() {

            $.ajax({
                url: '/net.familine.Famiwiki/api.php?action=query&meta=notifications&notprop=count&format=json',
                dataType: 'html',
                cache: false,
                success: function (data) {
                    js = JSON.parse(data);
                    cnt = js.query.notifications.count;

                    if (cnt <= 0) {
                        document.title = ot;
                    }
                    if (cnt == 1) {
                        document.title = "(1) " + ot;
                    }
                    if (cnt > 1) {
                        document.title = "(" + cnt + ") " + ot;
                    }
                }
            });
        }

        notif();

        setInterval(() => {
            notif();
        }, 60000)

    oldpn = "<?= $config["sites"][$config["active"]]["root"] ?>";
    setInterval(() => {
        newpn = location.pathname.substr(0, location.pathname.length - 1);
        if (newpn != oldpn && redirect) {
            matched = false;
            Object.keys(assocs).forEach((key) => {
                matched = true;
                assoc = assocs[key];
                if (newpn == key) {
                    if (location.hash.substr(1).trim() != "") {
                        switchActivity(assoc, location.hash.substr(1).trim());
                    } else {
                        switchActivity(assoc);
                    }
                }
            })
            if (!matched) {
                location.href = newpn;
            }
            oldpn = newpn;
        } else {
            oldpn = newpn;
        }
    }, 200)

    function iframeURLChange(iframe, callback) {
        var unloadHandler = function () {
            setTimeout(function () {
                callback(iframe.contentWindow.location.href);
            }, 0);
        };

        function attachUnload() {
            iframe.contentWindow.removeEventListener("pagehide", unloadHandler);
            iframe.contentWindow.addEventListener("pagehide", unloadHandler);
            iframe.contentWindow.removeEventListener("unload", unloadHandler);
            iframe.contentWindow.addEventListener("unload", unloadHandler);
        }

        iframe.addEventListener("load", attachUnload);
        attachUnload();
    }

    iframeURLChange(document.getElementById("content"), function (newURL) {
        $("#loader").fadeIn(200);
        $("#loadbar").fadeIn(200);
        $("#loadbar-logo").fadeIn(200);
        els2 = document.getElementById('content').contentWindow.location.href.split("/");

        els2.shift();
        els2.shift();
        els2.shift();

        url = "/" + els2.join("/");
        if (!url.startsWith(fullpath)) {
            if (url.includes("/login/")) {
                location.href = url;
            } else {
                match = false;
                Object.keys(assocs).forEach((key) => {
                    assoc = assocs[key];
                    if (url.includes(key) && redirect) {
                        match = true;
                        document.getElementById('content').contentWindow.history.back();
                        switchActivity(assoc, url.substr(key.length + 2));
                    }
                })
                if (!match && redirect) {
                    window.open(url);
                    document.getElementById('content').contentWindow.history.back();
                }
            }
        }
    });

    function unload() {
        {
        $("#loader").fadeIn(200);
        $("#loadbar").fadeIn(200);
        $("#loadbar-logo").fadeIn(200);
        els2 = document.getElementById('content').contentWindow.location.href.split("/");

        els2.shift();
        els2.shift();
        els2.shift();

        url = "/" + els2.join("/");
        if (!url.startsWith(fullpath)) {
            if (url.includes("/login/")) {
                location.href = url;
            } else {
                match = false;
                Object.keys(assocs).forEach((key) => {
                    assoc = assocs[key];
                    if (url.includes(key) && redirect) {
                        match = true;
                        document.getElementById('content').contentWindow.history.back();
                        switchActivity(assoc, url.substr(key.length + 2));
                    }
                })
                if (!match && redirect) {
                    window.open(url);
                    document.getElementById('content').contentWindow.history.back();
                }
            }
        }
    }
    }

    document.getElementById('content').onbeforeunload = unload

    function loaded () {

    {
    redirect = true;
        $("#loader").fadeOut(200);
        $("#loadbar-logo").fadeOut(200);

        setTimeout(() => {
            $("#loader").fadeOut(200);
        }, 300)

        setTimeout(() => {
            $("#loader").fadeOut(200);
            $("#loadbar").fadeOut(200);
        }, 1500);

        Array.from(document.getElementById('content').contentWindow.document.getElementsByTagName("a")).forEach((el) => {
            el.addEventListener('click', function (event) {
                if (event.altKey || event.ctrlKey || event.metaKey) {
                    console.log(event.target);
                    if (typeof event.target.href != "undefined" && typeof event.target.href != "null") {
                        if (event.target.href.includes(fullpath)) {
                            arr = event.target.href.split("/");
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            window.open(location.pathname + "#/" + arr.join("/"));
                            window.focus();
                            event.preventDefault();
                        }
                    } else if (typeof event.target.parentElement.href != "undefined" && typeof event.target.parentElement.href != "null") {
                        if (event.target.parentElement.href.includes(fullpath)) {
                            arr = event.target.parentElement.href.split("/");
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            window.open(location.pathname + "#/" + arr.join("/"));
                            window.focus();
                            event.preventDefault();
                        }
                    } else if (typeof event.target.parentElement.parentElement.href != "undefined" && typeof event.target.parentElement.parentElement.href != "null") {
                        if (event.target.parentElement.parentElement.href.includes(fullpath)) {
                            arr = event.target.parentElement.parentElement.href.split("/");
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            window.open(location.pathname + "#/" + arr.join("/"));
                            window.focus();
                            event.preventDefault();
                        }
                    } else if (typeof event.target.parentElement.parentElement.parentElement.href != "undefined" && typeof event.target.parentElement.parentElement.parentElement.href != "null") {
                        if (event.target.parentElement.parentElement.parentElement.href.includes(fullpath)) {
                            arr = event.target.parentElement.parentElement.parentElement.href.split("/");
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            arr.shift();
                            window.open(location.pathname + "#/" + arr.join("/"));
                            window.focus();
                            event.preventDefault();
                        }
                    }
                }
            }, false);
        })

        els2 = document.getElementById('content').contentWindow.location.href.split("/");

        els2.shift();
        els2.shift();
        els2.shift();

        url = "/" + els2.join("/");
        if (!url.startsWith(fullpath)) {
            if (url.includes("/login/")) {
                location.href = url;
            } else {
                match = false;
                Object.keys(assocs).forEach((key) => {
                    assoc = assocs[key];
                    if (url.includes(key) && redirect) {
                        match = true;
                        document.getElementById('content').contentWindow.history.back();
                        switchActivity(assoc, url.substr(key.length + 2));
                    }
                })
                if (!match) {
                    window.open(url);
                    document.getElementById('content').contentWindow.history.back();
                }
            }
        }

        els = document.getElementById('content').contentWindow.location.href.split("/");

        els.shift();
        els.shift();
        els.shift();
        els.shift();

        oldu = "/" + els.join("/");

        window.history.replaceState(config.sites[config.active].name, config.sites[config.active].name, "#/" + els.join("/"));
        console.log(fullpath + els.join("/"));

        document.title = document.getElementById('content').contentWindow.document.title;
        ot = document.title;
        notif()
        document.getElementById('loadbar-title').innerHTML = document.getElementById('content').contentWindow.document.title;
    }
    }

    document.getElementById('content').onload = loaded;
    document.getElementById('content').onabort = loaded;

    oldu = null;
    setInterval(() => {
        hash = location.hash.substr(1);

        if (hash == "" && hash != oldu) {
            document.getElementById('content').src = fullpath;
            console.log(fullpath);
            $("#loader").fadeIn(200);
            $("#loadbar").fadeIn(200);
            $("#loadbar-logo").fadeIn(200);

            oldu = hash;
        } else if (hash != oldu) {
            if (hash.startsWith("/") && (hash.substr(1, 1) != "/")) {
                document.getElementById('content').src = fullpath + hash;
                console.log(fullpath + hash);
                $("#loader").fadeIn(200);
                $("#loadbar").fadeIn(200);
                $("#loadbar-logo").fadeIn(200);
            } else {
                document.getElementById('content').src = fullpath;
                console.log(fullpath);
                $("#loader").fadeIn(200);
                $("#loadbar").fadeIn(200);
                $("#loadbar-logo").fadeIn(200);
            }

            oldu = hash;
        }
    }, 200)

    function login() {
        location.href = "/login";
    }

    function account() {
        $('#view-account').fadeIn(200);
    }

    function activities() {
        $('#view-activities').fadeIn(200);
    }

    function closeview() {
        $('#view-activities').fadeOut(200);
        $('#view-account').fadeOut(200);
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

        radioInterrupted = false;

        document.addEventListener('visibilitychange', function(){
            try {if (document.hidden) {
                if (!document.getElementById('radio-inner').contentDocument.getElementById('audio').muted && !radioInterrupted) {
                    radioInterrupted = true;
                    oldTitle = document.title;
                    document.title = document.getElementById('radio-inner').contentDocument.getElementById('info').title;
                    ot = document.title;
                    notif()
                }
            } else {
                if (radioInterrupted) {
                    radioInterrupted = false;
                    document.title = oldTitle;
                    ot = document.title;
                    notif()
                }
            }} catch (e) {}
        })

        window.onblur = () => {
            try {if (!document.getElementById('radio-inner').contentDocument.getElementById('audio').muted) {
                radioInterrupted = true;
                oldTitle = document.title;
                ot = document.title;
                document.title = document.getElementById('radio-inner').contentDocument.getElementById('info').title;
                ot = document.title;
                notif()
            }} catch (e) {}
        }

        window.onfocus = () => {
            try {if (radioInterrupted) {
                radioInterrupted = false;
                document.title = oldTitle;
                ot = document.title;
                notif()
            }} catch (e) {}
        }

        function switchActivity(activity, page) {
            if (typeof page == "undefined") {
                page = "/";
            }

            closeview();
            if (typeof config.sites[activity] == "undefined") {
                throw new Error("Activity not found");
            }

            config.active = activity;
            document.getElementById('loadbar-title').innerText = config.sites[activity].name;

            $("#loader").fadeIn(200);
            $("#loadbar").fadeIn(200);
            $("#loadbar-logo").fadeIn(200);

            setTimeout(() => {
                document.getElementById('currentapp-name').innerText = config.sites[activity].name;
                document.title = config.sites[activity].name;
                ot = document.title;
                notif()
                document.getElementById('currentapp-logo').src = config.sites[activity].icon;
                document.querySelector('link[rel="shortcut icon"]').href = config.sites[activity].icon;
                window.history.pushState(config.sites[activity].name, config.sites[activity].name, config.sites[activity].root + "/#" + page);
                fullpath = config.sites[activity].www;
                redirect = false;
                document.getElementById('content').src = config.sites[activity].www + page;
            }, 300)
        }
</script>

</html>
