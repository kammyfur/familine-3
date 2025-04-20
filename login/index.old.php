<!DOCTYPE html>

<?php

if (isset($_GET['r'])) {
    if ($_GET['r'] == "fwk") {
        $rstr = "à Famiwiki";
        $rstr2 = "Famiwiki";
    }
    if ($_GET['r'] == "fns") {
        $rstr = "à Faminews";
        $rstr2 = "Faminews";
    }
    if ($_GET['r'] == "pun") {
        $rstr = "au service client Famipun";
        $rstr2 = "le service client Famipun";
    }
    if ($_GET['r'] == "cloud") {
        $rstr = "à Familine Editors Cloud";
        $rstr2 = "Familine Editors Cloud";
    }
    if ($_GET['r'] == "home") {
        $rstr = "à l'espace accueil";
        $rstr2 = "l'espace accueil";
    }
    if ($_GET['r'] == "plus") {
        $rstr = "à Familine Plus";
        $rstr2 = "Familine Plus";
    }
    if ($_GET['r'] == "mobile") {
        $rstr = "à l'application mobile";
        $rstr2 = "l'application mobile";
    }
    if ($_GET['r'] == "pun1") {
        $rstr = "à la page de récupération des identifiants Famipun";
        $rstr2 = "la page de récupération des identifiants Famipun";
    }
    if ($_GET['r'] == "ney") {
        $rstr = "à Faminey";
        $rstr2 = "Faminey";
    }
    if ($_GET['r'] == "fps") {
        $rstr = "au site officiel de Family Productions Studio";
        $rstr2 = "le site officiel de Family Productions Studio";
    }
    if (!isset($rstr)) {
        $rstr = "à un service inconnu";
        $rstr2 = "un service inconnu";
    }
} else {
    $rstr = "à Familine";
    $rstr2 = "Familine";
}

?>

<html>

    <head>
        <title>Compte Familine</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="styles.css">
        <script src="jquery.js"></script>
    </head>

    <body>
    
        <div id="login-box">
            <div id="login-box-inner">
                <img src="/familine.png" width="96px" height="96px">
                <h1 style="margin-top: 0;">Connexion</h1>
                <p>Connectez-vous à votre compte Familine pour accéder <?= $rstr; ?></p>
                
                <div id="error" style="display:none;">
                    <p>
                        Nous ne parvenons pas à vous connecter à Familine. Vérifiez que :
                        <ul>
                            <li>votre mot de passe est correct ;</li>
                            <li>le nom de votre compte est correct ;</li>
                            <li>votre compte n'a pas été bloqué ;</li>
                            <li>vous n'avez pas activé le verrouillage majuscule ;</li>
                            <li>vous n'avez pas changé la disposition de votre clavier ;</li>
                            <li>vous n'avez pas désactivé votre connexion Internet ;</li>
                            <li>vous avez une connexion Internet fiable et rapide ;</li>
                        </ul>
                    </p>
                </div>
                <div id="success" style="display:none;">
                    <p>
                        Connexion effectuée, vous serez redirigé vers <?= $rstr2 ?> dans quelques instants.
                    </p>
                </div>
                
                <input type="text" id="user" name="username" placeholder="Nom du compte" class="textbox"><br>
                <input type="password" id="pass" placeholder="Mot de passe" class="textbox"><br><br>
                
                <span class="button" id="lgbutton" onclick="login();">Se connecter</span>
                
                <small>
                    <p>
                        Vous resterez connecté jusqu'à cliquer sur l'option « Déconnexion »<br>
                        <a class="link" href="/net.familine.Famiwiki/index.php/Spécial:Demander_un_compte">Demander un compte</a> • <a class="link" href="/net.familine.Famiwiki/index.php/Spécial:Réinitialisation_du_mot_de_passe">Mot de passe oublié</a> • <a class="link" href="/net.familine.Famiwiki/index.php/Aide:Connexion">Aide</a>
                    </p>
                </small>
            </div>
        </div>
    
    <script>
    
    function fail() {
        document.getElementById("error").style.display = "block";
        document.getElementById("user").disabled = false;
        document.getElementById("pass").disabled = false;
        document.getElementById("pass").value = "";
        document.getElementById("lgbutton").disabled = false;
    }
    
    function login() {
        document.getElementById("user").disabled = true;
        document.getElementById("pass").disabled = true;
        document.getElementById("lgbutton").disabled = true;
        document.getElementById("error").style.display = "none";
        $.ajax("/net.familine.Famiwiki/api.php?action=query&meta=tokens&type=login&format=json", {
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
                    token = tdata.query.tokens.logintoken;
                    /*fd = new FormData();
                    fd.append("wpName", document.getElementById("user").value);
                    fd.append("wpPassword", document.getElementById("pass").value);
                    fd.append("wpLoginToken", token);
                    fd.append("wpEditToken", "+\\\\");
                    fd.append("wpRemember", "1");
                    fd.append("authAction", "login");
                    fd.append("force", "");*/
                    $.ajax("/net.familine.Famiwiki/index.php?title=Spécial:Connexion&interactive=true&returnto=MediaWiki:/net.familine.LoginUI.success", {
                        cache: false,
                        data: {
                            wpName: document.getElementById("user").value,
                            wpPassword: document.getElementById("pass").value,
                            wpLoginToken: token,
                            wpEditToken: "+\\\\",
                            wpRemember: "1",
                            authAction: "login",
                            force: ""
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
                            if (data.includes("MediaWiki:/net.familine.LoginUI.success") || data.includes("<div id=\"personal\"><h2><span>" + document.getElementById("user").value + "</span></h2>")) {
                                document.getElementById("success").style.display = "block";
                                location.href = "<?php
                
                                if ($_GET['r'] == "fwk") {
                                    echo("/fwk");
                                }
                                
                                if ($_GET['r'] == "fps") {
                                    echo("/fps");
                                }
                                
                                if ($_GET['r'] == "ney") {
                                    echo("/fpn");
                                }
                                
                                if ($_GET['r'] == "cloud") {
                                    echo("/fcd");
                                }
                                
                                if ($_GET['r'] == "pun") {
                                    echo("/pun");
                                }

                                if ($_GET['r'] == "fns") {
                                    echo("/fns");
                                }

                                if ($_GET['r'] == "home") {
                                    echo("/");
                                }

                                if ($_GET['r'] == "plus") {
                                    echo("/plus");
                                }
                                
                                if ($_GET['r'] == "mobile") {
                                    echo("/mobile.php");
                                }
                                
                                if ($_GET['r'] == "pun1") {
                                    echo("/pun/#/credentials/");
                                }
                    
                                ?>";
                            } else {
                                console.warn("api error");
                                console.error(data);
                                fail();
                            }
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
    
    </script>
    
    </body>
    
</html>
