<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerAlt.php";
if (isset($_USER)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/loader.php";
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/loader.fb.php";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?></title>
    <link rel="stylesheet" href="./ajax.css">
    <script src="./jquery.js"></script>
    <link rel="shortcut icon" href="<?= $favicon ?>"/>
</head>
<body>
    <div id="topbar">
        <a title="Familine : Des technologies fiables pour la famille" href="<?php

        if (isset($_COOKIE['mobileUI'])) {
            echo("/mobile.php");
        } else {
            echo("/");
        }

        ?>" id="familine-home"><img id="familine-logo" src="/familine-symb.png"> <span id="familine-brand"><?php

        switch ($_PROFILE->subscription) {
            case 0:
                if (!isset($_USER) || $_USER == false) {
                    echo("Familine Demo");
                } else {
                    echo("Familine Standard");
                }
                break;

            case 1:
                echo("Plus Lite");
                break;

            case 2:
                echo("Plus Pro");
                break;

            case 3:
                echo("Plus Ultimate");
                break;

            case 4:
                echo("Plus Dreams");
                break;

            default:
                if (!isset($_USER) || $_USER == false) {
                    echo("Familine Demo");
                } else {
                    echo("Familine Standard");
                }
                break;
        }

        ?></span></a>
        <?php

        if ($_PROFILE->subscription == 0):
            if (!isset($_USER) || $_USER == false): ?>
                <a title="Connectez-vous à Familine pour accéder à l'intégralité du réseau" href="/login" id="link-plus" class="link"><img class="link-logo" src="/mdi/ic_face_24px.svg" style="filter:contrast(0%) brightness(1000%);"> <span class="link-text">Connexion</span></a>
            <?php else: ?>
                <a title="Achetez l'abonnement Familine Plus et accédez à plus de fonctionnalités" href="/plus/status" id="link-plus" class="link"><img class="link-logo" src="/mdi/ic_add_shopping_cart_24px.svg" style="filter:contrast(0%) brightness(1000%);"> <span class="link-text">Acheter</span></a>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($_PROFILE->subscription < 4): ?>
                <a title="Mettez à niveau votre abonnement pour accéder à plus de fonctionnalités" href="/plus/buy" id="link-plus" class="link"><img class="link-logo" src="/mdi/ic_toll_24px.svg" style="filter:contrast(0%) brightness(1000%);"> <span class="link-text">Mettre à niveau</span></a>
            <?php else: ?>
                <a title="Obtenez des informations sur l'état actuel de votre abonnement" href="/plus/status" id="link-plus" class="link"><img class="link-logo" src="/mdi/ic_info_24px.svg" style="filter:contrast(0%) brightness(1000%);"> <span class="link-text">État</span></a>
            <?php endif; ?>
        <?php endif; ?>
        <a title="Signaler un bug" href="mailto:freeziv.ytb+familine-bugs-online@gmail.com" id="link-help" class="link"><img class="link-logo" src="/mdi/ic_report_24px.svg" style="filter:contrast(0%) brightness(1000%);"></a>
        <?php

        if (!(!isset($_USER) || $_USER == false)): ?>

        <a title="Informations importantes" href="/fwk/#/index.php/Famiwiki:Notes_importantes_concernant_Famipun" id="link-warn" class="link" style="color:red;background-color:yellow;"><b>IMPORTANT !</b></a>

        <?php endif; ?>

        <span id="links">
            <?php if ($active["famiwiki"]): ?>
                <span title="Familine Famiwiki | Encyclopédie familiale, recense plus de 300 personnes" id="link-famiwiki" class="link active"><img id="famiwiki-logo" class="link-logo" src="/net.familine.Famiwiki/logo.svg"> <span class="link-text">Famiwiki</span></span>
            <?php else: ?>
                <a title="Familine Famiwiki | Encyclopédie familiale, recense plus de 300 personnes" href="/fwk" id="link-famiwiki" class="link"><img id="famiwiki-logo" class="link-logo" src="/net.familine.Famiwiki/logo.svg"> <span class="link-text">Famiwiki</span></a>
            <?php endif; ?>
            <?php if ($active["famiprods"]): ?>
                <span title="Familine Famiprods | Studio de production de films familial" id="link-famiprods" class="link active"><img id="famiprods-logo" class="link-logo" src="/net.familine.Famiprods/favicon.png"> <span class="link-text">Famiprods</span></span>
            <?php else: ?>
                <a title="Familine Famiprods | Studio de production de films familial" href="/fps" id="link-famiprods" class="link"><img id="famiprods-logo" class="link-logo" src="/net.familine.Famiprods/favicon.png"> <span class="link-text">Famiprods</span></a>
            <?php endif; ?>
            <?php if ($active["faminews"]): ?>
                <span title="Familine Faminews | Actualités sur la famille et le réseau Familine" id="link-faminews" class="link active"><img id="faminews-logo" class="link-logo" src="/net.familine.Faminews/logo.png"> <span class="link-text">Faminews</span></span>
            <?php else: ?>
                <a title="Familine Faminews | Actualités sur la famille et le réseau Familine" href="/fns" id="link-faminews" class="link"><img id="faminews-logo" class="link-logo" src="/net.familine.Faminews/logo.png"> <span class="link-text">Faminews</span></a>
            <?php endif; ?>
            <?php if ($active["famipun"]): ?>
                <span title="Familine Famipun | Gestion des incidents, punitions et sanctions" id="link-famipun" class="link active"><img id="famipun-logo" class="link-logo" src="/net.familine.Famipun/public/logo.png"> <span class="link-text">Famipun</span></span>
            <?php else: ?>
                <a title="Familine Famipun | Gestion des incidents, punitions et sanctions" href="/pun" id="link-famipun" class="link"><img id="famipun-logo" class="link-logo" src="/net.familine.Famipun/public/logo.png"> <span class="link-text">Famipun</span></a>
            <?php endif; ?>
            <?php if ($active["faminey"]): ?>
                <span title="Familine Faminey | Compte bancaire en ligne pour les services Familine" id="link-faminey" class="link active"><img id="faminey-logo" class="link-logo" src="/net.familine.Faminey/logo.png"> <span class="link-text">Faminey</span></span>
            <?php else: ?>
                <a title="Familine Faminey | Compte bancaire en ligne pour les services Familine" href="/fpn" id="link-faminey" class="link"><img id="faminey-logo" class="link-logo" src="/net.familine.Faminey/logo.png"> <span class="link-text">Faminey</span></a>
            <?php endif; ?>
            <?php if ($active["cloud"]): ?>
                <span title="Familine Editors Cloud | Stockage en ligne privé, fiable et sécurité" id="link-cloud" class="link active"><img id="cloud-logo" class="link-logo" src="/net.familine.EditorsCloud/flstatus.png"> <span class="link-text">Editors Cloud</span></span>
            <?php else: ?>
                <a title="Familine Editors Cloud | Stockage en ligne privé, fiable et sécurité" href="/fcd" id="link-cloud" class="link"><img id="cloud-logo" class="link-logo" src="/net.familine.EditorsCloud/flstatus.png"> <span class="link-text">Editors Cloud</span></a>
            <?php endif; ?>
        </span>
    </div>
    <div id="loadbar">
        <span id="loadbar-title"><?= $name ?></span>
        <span id="loadbar-logo"><img src="/loader.svg" width="24px" height="24px"></span>
    </div>
    <?php if (isset($inject)) { require $inject; } ?>
    <iframe id="content" src="<?= $root ?>" frameborder="0"></iframe>
    <div id="loader">
        <svg class="spinner" width="48px" height="48px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
        </svg>
    </div>
</body>

<script>
    function iframeURLChange(iframe, callback) {
        var unloadHandler = function () {
            setTimeout(function () {
                callback(iframe.contentWindow.location.href);
            }, 0);
        };

        function attachUnload() {
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
        if (!url.startsWith("<?= $root ?>")) {
            if (url.includes("/login/") || url.includes("/fps") || url.includes("/hp") || url.includes("/pronote") || url.includes("/fwk") || url.includes("/plus") || url.includes("/fpn") || url.includes("/pun") || url.includes("/fcd") || url.includes("/fns")) {
                location.href = url;
            } else {
                window.open(url);
                document.getElementById('content').contentWindow.history.back();
            }
        }
    });

    document.getElementById('content').onbeforeunload = () => {
        $("#loader").fadeIn(200);
        $("#loadbar").fadeIn(200);
        $("#loadbar-logo").fadeIn(200);
        els2 = document.getElementById('content').contentWindow.location.href.split("/");

        els2.shift();
        els2.shift();
        els2.shift();

        url = "/" + els2.join("/");
        if (!url.startsWith("<?= $root ?>")) {
            if (url.includes("/login/") || url.includes("/fps") || url.includes("/fwk") || url.includes("/hp") || url.includes("/pronote") || url.includes("/plus") || url.includes("/fpn") || url.includes("/pun") || url.includes("/fcd") || url.includes("/fns")) {
                location.href = url;
            } else {
                window.open(url);
                document.getElementById('content').contentWindow.history.back();
            }
        }
    }

    document.getElementById('content').onload = () => {
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
                        if (event.target.href.includes("<?= $root ?>")) {
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
                        if (event.target.parentElement.href.includes("<?= $root ?>")) {
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
                        if (event.target.parentElement.parentElement.href.includes("<?= $root ?>")) {
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
                        if (event.target.parentElement.parentElement.parentElement.href.includes("<?= $root ?>")) {
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
        if (!url.startsWith("<?= $root ?>")) {
            if (url.includes("/login/") || url.includes("/fps") || url.includes("/plus") || url.includes("/hp") || url.includes("/pronote") || url.includes("/fwk") || url.includes("/fpn") || url.includes("/pun") || url.includes("/fcd") || url.includes("/fns")) {
                location.href = url;
            } else {
                window.open(url);
                document.getElementById('content').contentWindow.history.back();
            }
        }

        els = document.getElementById('content').contentWindow.location.href.split("/");

        els.shift();
        els.shift();
        els.shift();
        els.shift();

        oldu = "/" + els.join("/");

        window.history.replaceState("Famiwiki", "Famiwiki", "#/" + els.join("/"));
        console.log("<?= $root ?>" + els.join("/"));

        document.title = document.getElementById('content').contentWindow.document.title;
        document.getElementById('loadbar-title').innerHTML = document.getElementById('content').contentWindow.document.title;
    }

    oldu = null;
    setInterval(() => {
        hash = location.hash.substr(1);

        if (hash == "" && hash != oldu) {
            document.getElementById('content').src = "<?= $root ?>";
            console.log("<?= $root ?>");
            $("#loader").fadeIn(200);
            $("#loadbar").fadeIn(200);
            $("#loadbar-logo").fadeIn(200);

            oldu = hash;
        } else if (hash != oldu) {
            if (hash.startsWith("/") && (hash.substr(1, 1) != "/")) {
                document.getElementById('content').src = "<?= $root ?>" + hash;
                console.log("<?= $root ?>" + hash);
                $("#loader").fadeIn(200);
                $("#loadbar").fadeIn(200);
                $("#loadbar-logo").fadeIn(200);
            } else {
                document.getElementById('content').src = "<?= $root ?>";
                console.log("<?= $root ?>");
                $("#loader").fadeIn(200);
                $("#loadbar").fadeIn(200);
                $("#loadbar-logo").fadeIn(200);
            }

            oldu = hash;
        }
    }, 200)
</script>

</html>
