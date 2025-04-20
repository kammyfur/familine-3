function fail() {
    document.getElementById('lgpass').value = "";
    document.getElementById('status').style.opacity = 0;
    document.getElementById('errorbtn').style.display = '';
    document.getElementById('state').innerHTML = "Une erreur s'est produite lors de la connexion, veuillez vous assurer que ...<ul><li>votre mot de passe et nom d'utilisateur sont corrects</li><li>votre compte n'a pas été bloqué</li><li>votre compte n'a pas été bloqué</li><li>vous n'avez pas modifié votre clavier (disposition, majuscule, ...)</li><li>votre connexion Internet est présente et suffisamment fiable</li></ul>";
}

function login() {
    if (document.getElementById('lguser').value != "" && document.getElementById('lgpass').value != "") {
        document.getElementById('status').value = 1;
        document.getElementById('state').innerText = "Initialisation du système d'authentification...";

        document.getElementById('status').style.opacity = 1;
        $("#loggingin").show();
        $("#status").show();

        user = document.getElementById('lguser').value;
        pass = document.getElementById('lgpass').value;

        document.getElementById('status').value = 2;
        document.getElementById('state').innerText = "Récupération du jeton de connexion...";
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
                    document.getElementById('status').value = 3;
                    document.getElementById('state').innerText = "Préparation des données de connexion...";
                    token = tdata.query.tokens.logintoken;
                    lgdata = {
                        wpName: document.getElementById("lguser").value,
                        wpPassword: document.getElementById("lgpass").value,
                        wpLoginToken: token,
                        wpEditToken: "+\\\\",
                        wpRemember: "1",
                        authAction: "login",
                        force: ""
                    };
                    document.getElementById('status').value = 4;
                    document.getElementById('state').innerText = "Authentification auprès du serveur...";
                    $.ajax("/net.familine.Famiwiki/index.php?title=Spécial:Connexion&interactive=true&returnto=MediaWiki:/net.familine.LoginUI.success", {
                        cache: false,
                        data: lgdata,
                        processData: true,
                        method: "POST",
                        dataType: "html",
            
                        error: (error) => {
                            console.warn("ajax error");
                            console.error(error);
                            fail();
                        },
                        success: (data) => {
                            if (data.includes("<div id=\"personal\"><h2><span>" + document.getElementById("lguser").value + "</span></h2>")) {
                                document.getElementById('status').value = 5;
                                document.getElementById('state').innerText = "Redirection vers " + goBackName + "...";
                                location.href = goBackTo;
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
}
