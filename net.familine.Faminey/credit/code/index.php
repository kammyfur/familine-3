<?php $_TITLE = "Utiliser un code"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/header.php"; ?>

<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Alerte arnaque :</strong> Si le code sur votre carte est découvert, <a href="mailto:freeziv.ytb+faminey-card-scam-refund@gmail.com" class="alert-link">demandez un remboursement</a> et n'utilisez pas le code.
</div>
<center id="main-view">
    <h2>Utiliser un code</h2>

    <p>Munissez-vous de votre carte et entrez votre code dans la zone de texte ci-dessous. Les tirets sont ajoutés automatiquement. Après cela, votre code sera automatiquement vérifié et il vous sera possible de le créditer à votre compte.</p>
    <input type="text" class="form-control form-control-lg" style="display:inline;width:initial;font-family:monospace;vertical-align:middle;" id="codeinput-1" onkeyup="ciTrigger(1);" maxlength="5" autocomplete="off" size="5" autofocus><big> - </big>
    <input type="text" class="form-control form-control-lg" style="display:inline;width:initial;font-family:monospace;vertical-align:middle;" id="codeinput-2" onkeyup="ciTrigger(2);" max="5" autocomplete="off" size="5"><big> - </big>
    <input type="text" class="form-control form-control-lg" style="display:inline;width:initial;font-family:monospace;vertical-align:middle;" id="codeinput-3" onkeyup="ciTrigger(3);" maxlength="5" autocomplete="off" size="5">
    <div id="credititem-valid" class="alert alert-warning" style="display:none;">
        Il s'agit d'un code de <b id="credititem-code">0,00 €</b>.
        <div class="btn-group">
            <button type="button" class="btn btn-success" onclick="credit();">Créditer</button>
            <button type="button" class="btn btn-danger" onclick="cancel();">Annuler</button>
        </div>
    </div>
    <div id="credititem-invalid" class="alert alert-danger" style="display:none;">
        Le code entré est invalide. Vérifiez que vous n'avez pas confondu des lettres similaires et réessayez.
    </div>
    <div id="credititem-error" class="alert alert-danger" style="display:none;">
        Nous ne parvenons pas à vérifier la validité de ce code, vérifiez votre connexion à Internet et réessayez.
    </div>
    <div id="credititem-used" class="alert alert-danger" style="display:none;">
        Ce code a déjà été utilisé. Contactez le support technique si vous pensez qu'il s'agit d'une erreur.
    </div>
    <div id="credititem-wait" class="alert alert-light" style="display:none;">
        Vérification du code en cours, veuillez patienter...
    </div>
</center>

<center id="crediting" style="display:none;">
    <div id="crediting-wait" class="alert alert-light">
        Veuillez patienter...
    </div>
    <div id="crediting-valid" class="alert alert-success" style="display:none;">
        Votre compte a été crédité, vous allez être redirigé vers la page d'accueil...
    </div>
    <div id="crediting-invalid" class="alert alert-danger" style="display:none;">
        Le code entré est invalide. Vérifiez que vous n'avez pas confondu des lettres similaires et réessayez.
    </div>
    <div id="crediting-error" class="alert alert-danger" style="display:none;">
        Nous ne parvenons pas à vérifier la validité de ce code, vérifiez votre connexion à Internet et réessayez.
    </div>
    <div id="crediting-used" class="alert alert-danger" style="display:none;">
        Ce code a déjà été utilisé. Contactez le support technique si vous pensez qu'il s'agit d'une erreur.
    </div>
</center>

<script>

values = {
    1: "",
    2: "",
    3: ""
}

requesting = false;

function ciTrigger(i) {
    if (requesting) {
        return;
    }
    el = document.getElementById('codeinput-' + i);
    document.getElementById('codeinput-' + i).value = document.getElementById('codeinput-' + i).value.toUpperCase();
    if (values[i] != el.value) {
        if (i < 3 && el.value.length == 5) {
            document.getElementById('codeinput-' + (i + 1)).focus();
        }
        if (i > 1 && el.value.length == 0) {
            document.getElementById('codeinput-' + (i - 1)).focus();
        }
        values[i] = el.value;
    }

    document.getElementById('credititem-valid').style.display = "none";
    document.getElementById('credititem-invalid').style.display = "none";
    document.getElementById('credititem-error').style.display = "none";
    document.getElementById('credititem-used').style.display = "none";
    document.getElementById('credititem-wait').style.display = "none";

    if (document.getElementById('codeinput-1').value.length == 5 && document.getElementById('codeinput-2').value.length == 5 && document.getElementById('codeinput-3').value.length == 5) {
        code = document.getElementById('codeinput-1').value + "-" + document.getElementById('codeinput-2').value + "-" + document.getElementById('codeinput-3').value;

        fdata = new FormData()
        fdata.append("c", code)

        document.getElementById('credititem-wait').style.display = "";

        requesting = true;
        $.ajax({
            url: "/net.familine.Faminey/api/CheckRedeemCode.php",
            dataType: 'html',
            cache: false,
            data: fdata,
            contentType: false,
            processData: false,
            type: 'post',
            success: function (data) {
                requesting = false;
                document.getElementById('credititem-wait').style.display = "none";

                if (data.startsWith("ok")) {
                    result = data.substr(3) - 1 + 1;
                    document.getElementById('credititem-code').innerHTML = result.toFixed(2).replace(".", ",") + " €";
                    document.getElementById('credititem-valid').style.display = "";
                } else if (data.startsWith("us")) {
                    document.getElementById('credititem-used').style.display = "";
                } else if (data.startsWith("in")) {
                    document.getElementById('credititem-invalid').style.display = "";
                } else {
                    document.getElementById('credititem-error').style.display = "";
                }
            },
            error: function () {
                requesting = false;
                document.getElementById('credititem-wait').style.display = "none";
                document.getElementById('credititem-error').style.display = "";
            }
        });
    }
}

function credit() {
    document.getElementById('main-view').style.display = "none";
    document.getElementById('crediting').style.display = "";

    if (document.getElementById('codeinput-1').value.length == 5 && document.getElementById('codeinput-2').value.length == 5 && document.getElementById('codeinput-3').value.length == 5) {
        code = document.getElementById('codeinput-1').value + "-" + document.getElementById('codeinput-2').value + "-" + document.getElementById('codeinput-3').value;

        fdata = new FormData()
        fdata.append("c", code)

        document.getElementById('crediting-wait').style.display = "";

        $.ajax({
            url: "/net.familine.Faminey/api/CreditRedeemCode.php",
            dataType: 'html',
            cache: false,
            data: fdata,
            contentType: false,
            processData: false,
            type: 'post',
            success: function (data) {
                document.getElementById('crediting-wait').style.display = "none";

                if (data.startsWith("ok")) {
                    document.getElementById('crediting-valid').style.display = "";
                    location.href = "/net.familine.Faminey/";
                } else if (data.startsWith("us")) {
                    document.getElementById('crediting-used').style.display = "";
                } else if (data.startsWith("in")) {
                    document.getElementById('crediting-invalid').style.display = "";
                } else {
                    document.getElementById('crediting-error').style.display = "";
                }
            },
            error: function () {
                document.getElementById('crediting-wait').style.display = "none";
                document.getElementById('crediting-error').style.display = "";
            }
        });
    }
}

function cancel() {
    document.getElementById('codeinput-1').value = "";
    document.getElementById('codeinput-2').value = "";
    document.getElementById('codeinput-3').value = "";
    document.getElementById('credititem-valid').style.display = "none";
    document.getElementById('credititem-invalid').style.display = "none";
    document.getElementById('credititem-error').style.display = "none";
    document.getElementById('credititem-used').style.display = "none";
    document.getElementById('credititem-wait').style.display = "none";
    ciTrigger();
}

</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/footer.php"; ?>
