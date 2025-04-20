<?php if (isset($_GET['elderstab'])) { require_once $_SERVER['DOCUMENT_ROOT'] . "/home/index-eld.php"; die(); } ?>
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
    <title><?= isset($_GET['home']) ? "Nouvel onglet" : "Familine : Des technologies fiables pour la famille" ?></title>
    <link rel="shortcut icon" href="/logos/familine/familine128.png" type="image/png">
    <script src="https://familine.ddns.net/cdn/script/jquery.js"></script>
    <link rel="stylesheet" href="https://familine.ddns.net/cdn/style/home-new.css">
</head>
<body>
    <?php if ($_USER == null): ?>
    <div id="block">
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
    </div>
    <?php else: ?>
        <div id="overlay"></div>
        <div id="weather" style="display:none;z-index:10;border-radius:10px;padding:8px;position:fixed;top:16px;left:16px;color:white;"><div style="text-align:center;" id="weather-overview"></div><table id="weather-details"><tbody><tr><td class="td1"><b>Ressenti</b></td><td id="weather-feel">...</td></tr><tr><td class="td1"><b>Direction du vent</b></td><td id="weather-wind-dir">...</td></tr><tr><td class="td1"><b>Vitesse du vent</b></td><td id="weather-wind-spd">...</td></tr><tr><td class="td1"><b>Humidité</b></td><td id="weather-humidity">...</td></tr><tr><td class="td1"><b>Nuages</b></td><td id="weather-clouds">...</td></tr><tr><td class="td1"><b>Précipitations</b></td><td id="weather-rain">...</td></tr><tr><td colspan="2" style="text-align:center;" id="weather-updated">Chargement...</td></tr></tbody></table></div>
        <div id="location" style="display:none;z-index:10;border-radius:10px;padding:8px;position:fixed;bottom:16px;left:16px;color:white;"><h3 id="city">...</h3><span id="country">...</span></div>
        <div id="tryout" style="z-index:10;border-radius:10px;padding:8px;position:fixed;bottom:36px;right:16px;color:white;"><a class="alink" onclick="location.href = 'https://newfamiline.ddns.net';">S'enregistrer pour Familine Test Pilot ›</a></div>
        <?php if (!isset($_COOKIE['mobileUI']) && !isset($_GET['home'])): ?> <div id="ashome" style="z-index:10;border-radius:10px;padding:8px;position:fixed;bottom:16px;right:16px;color:white;"><a class="alink" onclick="document.getElementById('home').style.display = 'block';">Utiliser Familine comme page d'accueil ›</a></div> <?php endif; ?>
        <div id="user" style="z-index:10;border-radius:10px;padding:8px;position:fixed;top:16px;right:16px;color:white;"><h3 id="username"><?= $_USER ?></h3> <button id="notif-title" onclick="location.href='/fwk/#/index.php/Spécial:Notifications'" title="Notifications (0)" class="userbutton"><img class="userbutton-img" id="notif-icon" src="/mdi/ic_notifications_none_24px.svg"></button> <?php if (!isset($_GET['home'])): ?> <button title="Se déconnecter" class="userbutton"><img class="userbutton-img" onclick="logout();" src="/mdi/ic_power_settings_new_24px.svg"></button> <?php endif; ?></div>
        <div id="container">
            <p><img src="/logos/familine/familine256.png" id="logo"> <span id="title">Familine</span></p>
            <form action="<?php

                if (!isset($_GET['home'])) {
                    echo("/search");
                } else {
                    if (isset($_GET['gs'])) {
                        echo("https://www.google.com/search");
                    } else if (isset($_GET['msb'])) {
                        echo("https://www.bing.com/search");
                    } else if (isset($_GET['qw'])) {
                        echo("https://www.qwant.com/");
                    } else if (isset($_GET['ec'])) {
                        echo("https://www.ecosia.org/search");
                    } else {
                        echo("https://www.duckduckgo.com/");
                    }
                }

                ?>" id="fl-searchfrm">
                <input id="fl-searchbox" name="q" placeholder="Rechercher <?php

                if (!isset($_GET['home'])) {
                    echo("sur Familine");
                } else {
                    if (isset($_GET['gs'])) {
                        echo("avec Google");
                    } else if (isset($_GET['msb'])) {
                        echo("avec Bing");
                    } else if (isset($_GET['qw'])) {
                        echo("avec Qwant");
                    } else if (isset($_GET['ec'])) {
                        echo("avec Ecosia");
                    } else {
                        echo("avec DuckDuckGo");
                    }
                }

                ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <button type="submit" id="fl-searchsmb"><img src="https://familine.ddns.net/cdn/material/ic_search_24px.svg"></button>
            </form>
            <div id="apps">
                <div onclick="location.href='/fwk';" class="app" id="app-famiwiki">
                    <img src="/logos/famiwiki/famiwiki128.png" width="36px" height="36px" class="app-image" id="app-famiwiki-image"></img>
                    <span class="app-text" id="app-famiwiki-text">Famiwiki</span>
                    <span class="app-tagline" id="app-famiwiki-tagline">Partagez, apprenez et communiquez sur des personnes, des projets, des événements et bien plus.</span>
                </div>

                <div class="app" id="app-famiprods">
                    <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-famiprods-image"></img>
                    <span class="app-text" id="app-famiprods-text">Indisponible</span>
                    <span class="app-tagline" id="app-famiprods-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                </div>
                <div class="app" id="app-famiprods">
                    <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-famiprods-image"></img>
                    <span class="app-text" id="app-famiprods-text">Indisponible</span>
                    <span class="app-tagline" id="app-famiprods-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                </div>
                <div class="app" id="app-famiprods">
                    <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-famiprods-image"></img>
                    <span class="app-text" id="app-famiprods-text">Indisponible</span>
                    <span class="app-tagline" id="app-famiprods-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                </div>
                <div class="app" id="app-famiprods">
                    <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-famiprods-image"></img>
                    <span class="app-text" id="app-famiprods-text">Indisponible</span>
                    <span class="app-tagline" id="app-famiprods-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                </div>
                <div class="app" id="app-famiprods">
                    <img src="https://familine.cdn.minteck.org/material/ic_block_24px.svg" style="filter:invert(1);" width="36px" height="36px" class="app-image" id="app-famiprods-image"></img>
                    <span class="app-text" id="app-famiprods-text">Indisponible</span>
                    <span class="app-tagline" id="app-famiprods-tagline">Cette application n'est désormais accessible qu'à partir de Familine 4 et n'est plus accessible depuis cette version.</span>
                </div>

                <div onclick="location.href='/plus';" class="app" id="app-plus">
                    <img src="/logos/plus/plus128.png" width="36px" height="36px" class="app-image" id="app-plus-image"></img>
                    <span class="app-text" id="app-plus-text">Familine Plus</span>
                    <span class="app-tagline" id="app-plus-tagline">Étendez les possibilités des services de Familine et soutenez financièrement le développement et la maintenance du réseau.</span>
                </div>
            </div>
        </div>
        <div id="logout" style="display:none;">
            Déconnexion en cours... Veuillez patienter
        </div>
        <div id="home">
            <p><a onclick="document.getElementById('home').style.display = 'none';" class="alink">Fermer</a></p>
            <h1>Gardez un œil sur la famille, en gardant le confort de votre navigateur</h1>
            <p>Utiliser Familine comme page d'accueil de votre navigateur vous permet d'être informé de vos notifications, et d'accéder plus facilement et plus rapidement aux services de Familine, aujourd'hui au cœur de notre famille.</p>
            <p>Vous profiterez d'une interface moderne, d'une meilleure sécurité lors de votre départ sur le Web, d'informations sur la météo proche de chez vous, d'une image de fond réellement unique, tout en conservant votre moteur de recherche favori (Google, Bing, DuckDuckGo, et autres).</p>
            <h2>Configuration</h2>
            <p>Familine recommande l'utilisation de DuckDuckGo, le moteur de recherche respectueux de la vie privée le plus fiable et le plus utilisé au monde. DuckDuckGo fournit des résultats de qualité sans vous pister aux quatres coins d'Internet. Toutefois, si ce choix ne vous convient pas, vous pouvez choisir un autre moteur de recherche.</p>
            <ul>
                <li>Moteur de recherche : <select onclick="document.getElementById('searchea').innerText=document.getElementById('searche').value;" id="searche">
                    <option value="ddg">DuckDuckGo</option>
                    <option value="gs">Google</option>
                    <option value="msb">Bing</option>
                    <option value="qw">Qwant</option>
                    <option value="ec">Ecosia</option>
                </select></li>
            </ul>
            <h2>Installation</h2>
            <p>Après avoir sélectionné votre moteur de recherche, il est très simple d'activer la page d'accueil Familine. Rendez-vous dans les paramètres de votre navigateur, et définissez l'adresse suivante comme page d'accueil :</p>
            <blockquote class="allowselect">https://familine.ddns.net/home/?home&amp;<span id="searchea">ddg</span></blockquote>
            <p>Si vous ne savez pas comment procéder, nous vous invitons à consulter la documentation de votre navigateur :
            <ul>
                <li><a href="https://support.mozilla.org/fr/kb/comment-definir-page-accueil" class="alink" target="_blank">Mozilla Firefox</a></li>
                <li><a href="https://support.google.com/chrome/answer/95314?co=GENIE.Platform%3DDesktop&hl=fr" class="alink" target="_blank">Google Chrome/Chromium/Brave</a></li>
                <li><a href="https://support.microsoft.com/fr-fr/microsoft-edge/modifier-la-page-d-accueil-de-votre-navigateur-a531e1b8-ed54-d057-0262-cc5983a065c6" class="alink" target="_blank">Microsoft Edge</a></li>
            </ul>
            Si vous n'arrivez toujours pas à utiliser Familine comme page d'accueil, contactez le support technique.
            </p>
            </ul>
        </div>

        <script>

        $.ajax({
            url: '/weather.php',
            dataType: 'html',
            cache: false,
            success: function (data) {
                console.log(data);
                items = JSON.parse(data);
                document.getElementById('weather-overview').innerHTML = `<img src="https:${items.current.condition.icon}" height="48px" style="vertical-align:middle;"> <span style="vertical-align:middle;">${items.current.temp_c}°C</span>`;
                document.getElementById('weather-feel').innerText = items.current.feelslike_c + "°C";
                document.getElementById('weather-wind-dir').innerText = items.current.wind_dir;
                switch (items.current.wind_dir) {
                    case 'N':
                        document.getElementById('weather-wind-dir').innerText = "🢁 (N, " + items.current.wind_degree + "°)";
                        break;
                    case 'NNE':
                        document.getElementById('weather-wind-dir').innerText = "🢁 (N, " + items.current.wind_degree + "°)";
                        break;
                    case 'NNW':
                        document.getElementById('weather-wind-dir').innerText = "🢁 (N, " + items.current.wind_degree + "°)";
                        break;
                    case 'NE':
                        document.getElementById('weather-wind-dir').innerText = "🢅 (NE, " + items.current.wind_degree + "°)";
                        break;
                    case 'NEN':
                        document.getElementById('weather-wind-dir').innerText = "🢅 (NE, " + items.current.wind_degree + "°)";
                        break;
                    case 'NEE':
                        document.getElementById('weather-wind-dir').innerText = "🢅 (NE, " + items.current.wind_degree + "°)";
                        break;
                    case 'E':
                        document.getElementById('weather-wind-dir').innerText = "🡺 (E, " + items.current.wind_degree + "°)";
                        break;
                    case 'ENE':
                        document.getElementById('weather-wind-dir').innerText = "🡺 (E, " + items.current.wind_degree + "°)";
                        break;
                    case 'ESE':
                        document.getElementById('weather-wind-dir').innerText = "🡺 (E, " + items.current.wind_degree + "°)";
                        break;
                    case 'SE':
                        document.getElementById('weather-wind-dir').innerText = "🡾 (SE, " + items.current.wind_degree + "°)";
                        break;
                    case 'SEE':
                        document.getElementById('weather-wind-dir').innerText = "🡾 (SE, " + items.current.wind_degree + "°)";
                        break;
                    case 'SES':
                        document.getElementById('weather-wind-dir').innerText = "🡾 (SE, " + items.current.wind_degree + "°)";
                        break;
                    case 'S':
                        document.getElementById('weather-wind-dir').innerText = "🡻 (S, " + items.current.wind_degree + "°)";
                        break;
                    case 'SSE':
                        document.getElementById('weather-wind-dir').innerText = "🡻 (S, " + items.current.wind_degree + "°)";
                        break;
                    case 'SSW':
                        document.getElementById('weather-wind-dir').innerText = "🡻 (S, " + items.current.wind_degree + "°)";
                        break;
                    case 'SW':
                        document.getElementById('weather-wind-dir').innerText = "🡿 (SO, " + items.current.wind_degree + "°)";
                        break;
                    case 'SWW':
                        document.getElementById('weather-wind-dir').innerText = "🡿 (SO, " + items.current.wind_degree + "°)";
                        break;
                    case 'SWS':
                        document.getElementById('weather-wind-dir').innerText = "🡿 (SO, " + items.current.wind_degree + "°)";
                        break;
                    case 'W':
                        document.getElementById('weather-wind-dir').innerText = "🡸 (O, " + items.current.wind_degree + "°)";
                        break;
                    case 'WSW':
                        document.getElementById('weather-wind-dir').innerText = "🡸 (O, " + items.current.wind_degree + "°)";
                        break;
                    case 'WNW':
                        document.getElementById('weather-wind-dir').innerText = "🡸 (O, " + items.current.wind_degree + "°)";
                        break;
                    case 'NW':
                        document.getElementById('weather-wind-dir').innerText = "🡼 (NO, " + items.current.wind_degree + "°)";
                        break;
                    case 'NWW':
                        document.getElementById('weather-wind-dir').innerText = "🡼 (NO, " + items.current.wind_degree + "°)";
                        break;
                    case 'NWN':
                        document.getElementById('weather-wind-dir').innerText = "🡼 (NO, " + items.current.wind_degree + "°)";
                        break;
                }
                document.getElementById('weather-wind-spd').innerText = items.current.wind_kph + " km/h";
                document.getElementById('weather-humidity').innerText = items.current.humidity + "%";
                document.getElementById('weather-clouds').innerText = items.current.cloud + "%";
                document.getElementById('weather-rain').innerText = items.current.precip_mm + " mm";
                document.getElementById('weather-updated').innerText = "il y a " + Math.floor(((new Date() - new Date(items.current.last_updated))/1000)/60) + " minutes";
                document.getElementById('weather').style.display = "";
                document.getElementById('city').innerText = items.location.name;
                document.getElementById('country').innerText = items.location.region + ", " + items.location.country;
                document.getElementById('location').style.display = "";
            }
        });

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
                        document.getElementById('notif-title').title = "Notifications (0)";
                        document.getElementById('notif-icon').src = "/mdi/ic_notifications_none_24px.svg";
                    }
                    if (cnt == 1) {
                        document.title = "(1) " + ot;
                        document.getElementById('notif-title').title = "Notifications (1)";
                        document.getElementById('notif-icon').src = "/mdi/ic_notifications_24px.svg";
                    }
                    if (cnt > 1) {
                        document.title = "(" + cnt + ") " + ot;
                        document.getElementById('notif-title').title = "Notifications (" + cnt + ")";
                        document.getElementById('notif-icon').src = "/mdi/ic_notifications_active_24px.svg";
                    }
                }
            });
        }

        notif();

        setInterval(() => {
            notif();
        }, 60000)

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

        document.getElementById('fl-searchbox').focus();
        </script>
    <?php endif; ?>
</body>
</html>
