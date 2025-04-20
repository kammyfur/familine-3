<?php $_TITLE = "Faire un don"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/header.php"; ?>

<center id="main-view">
    <h2>Faire un don</h2>

    <p>Faites un don à une personne pour une quelconque raison. Vous ne pouvez pas donner plus de 15 €. Pour commencer, entrez la quantité d'argent que vous souhaitez donner :</p>
    <input type="text" class="form-control form-control-lg" style="display:inline;width:initial;font-family:monospace;vertical-align:middle;" id="credit" onkeyup="ciTrigger();" maxlength="2" autocomplete="off" size="2" autofocus><big> € </big>
    <div id="credititem-zero" class="alert alert-warning" style="display:none;">
        Votre compte n'aura plus d'argent après ce don.
    </div>
    <div id="credititem-valid" style="display:none;">
        <div class="alert alert-success">
            Vous pouvez donner cet argent.
        </div>
        <p>Pour continuer, entrez le nom de la personne à qui vous souhaitez donner cet argent :</p>
        <input style="display:inline;width:initial;" type="text" id="name" class="form-control" onkeyup="ciTrigger2();" autocomplete="off">
        <br><br>
        <div id="credititem2-valid" style="display:none;">
            <div class="alert alert-success">
                Vous pouvez donner à cette personne.
            </div>
            <p>Pour finir, entrez une raison pour votre don (facultatif) :</p>
            <div class="input-group mb-3">
                <input style="display:inline;width:256px;" type="text" class="form-control" id="reason">
                <div class="input-group-append">
                    <button type="button" class="btn btn-success" onclick="donate();">Donner</button>
                </div>
            </div>
        </div>
        <div id="credititem2-no" class="alert alert-danger" style="display:none;">
            Cette personne ne dispose pas de compte Faminey. Si elle dispose d'un compte Familine, demandez lui d'accéder à la page d'accueil de Faminey.
        </div>
        <div id="credititem2-disabled" class="alert alert-danger" style="display:none;">
            Le compte de cette personne a été désactivé, vous ne pouvez pas lui faire de dons tant qu'il est ainsi.
        </div>
        <div id="credititem2-invalid" class="alert alert-danger" style="display:none;">
            Le compte de cette personne est corrompu.
        </div>
        <div id="credititem2-self" class="alert alert-danger" style="display:none;">
            Vous ne pouvez pas donner à vous-même. Franchement, qui fait ça ?
        </div>
        <div id="credititem2-wait" class="alert alert-light" style="display:none;">
            Vérification de la personne, veuillez patienter...
        </div>
        <div id="credititem2-error" class="alert alert-danger" style="display:none;">
            Nous ne parvenons pas à vérifier la personne sélectionnée, vérifiez votre connexion à Internet et réessayez.
        </div>
    </div>
    <div id="credititem-no" class="alert alert-danger" style="display:none;">
        Votre compte ne dispose pas de suffisamment d'argent pour pouvoir donner ce montant.
    </div>
    <div id="credititem-wait" class="alert alert-light" style="display:none;">
        Vérification de votre crédit, veuillez patienter...
    </div>
    <div id="credititem-error" class="alert alert-danger" style="display:none;">
        Nous ne parvenons pas à vérifier le crédit de votre compte, vérifiez votre connexion à Internet et réessayez.
    </div>
</center>

<center id="crediting" style="display:none;">
    <div id="crediting-wait" class="alert alert-light">
        Veuillez patienter...
    </div>
    <div id="crediting-zero" class="alert alert-danger" style="display:none;">
        Votre compte ne dispose pas de suffisamment d'argent pour pouvoir donner ce montant.
    </div>
    <div id="crediting-error" class="alert alert-danger" style="display:none;">
        Nous ne parvenons pas à vérifier le crédit de votre compte, vérifiez votre connexion à Internet et réessayez.
    </div>
    <div id="crediting-no" class="alert alert-danger" style="display:none;">
        Cette personne ne dispose pas de compte Faminey. Si elle dispose d'un compte Familine, demandez lui d'accéder à la page d'accueil de Faminey.
    </div>
    <div id="crediting-disabled" class="alert alert-danger" style="display:none;">
        Le compte de cette personne a été désactivé, vous ne pouvez pas lui faire de dons tant qu'il est ainsi.
    </div>
    <div id="crediting-invalid" class="alert alert-danger" style="display:none;">
        Le compte de cette personne est corrompu.
    </div>
    <div id="crediting-self" class="alert alert-danger" style="display:none;">
        Vous ne pouvez pas donner à vous-même. Franchement, qui fait ça ?
    </div>
    <div id="crediting-error" class="alert alert-danger" style="display:none;">
        Nous ne parvenons pas à vérifier la personne sélectionnée, vérifiez votre connexion à Internet et réessayez.
    </div>
    <div id="crediting-valid" class="alert alert-success" style="display:none;">
        Don terminé, cela peut prendre jusqu'à 12 heures pour que la personne récupère votre argent. Vous serez redirigé vers la page d'accueil dans quelques secondes.
    </div>
    <div id="crediting-warn" class="alert alert-warning" style="display:none;">
        Le don a été terminé, mais votre compte n'a maintenant plus d'argent, nous vous conseillons de le créditer rapidement. Vous serez redirigé vers la page d'accueil dans 5 secondes.
    </div>
</center>

<script>

requesting = false;

function ciTrigger(cont) {
    if (requesting) {
        return;
    }

    el = document.getElementById('credit');
    value = el.value;
    if (value > 15 || isNaN(value)) {
        document.getElementById('credit').value = 15;
        el = document.getElementById('credit');
    }

    document.getElementById('credititem-valid').style.display = "none";
    document.getElementById('credititem-no').style.display = "none";
    document.getElementById('credititem-zero').style.display = "none";
    document.getElementById('credititem-error').style.display = "none";
    document.getElementById('credititem-wait').style.display = "none";

    if (el.value == 0 || el.value.trim() == "") {
        return;
    }

    fdata = new FormData()
    fdata.append("c", el.value)

    document.getElementById('credititem-wait').style.display = "";

    requesting = true;
    $.ajax({
        url: "/net.familine.Faminey/api/CheckWalletCredit.php",
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
                document.getElementById('credititem-valid').style.display = "";
                if (!cont) {
                    ciTrigger(true)
                }
            } else if (data.startsWith("no")) {
                document.getElementById('credititem-no').style.display = "";
                document.getElementById('credititem2-valid').style.display = "none";
                if (!cont) {
                    ciTrigger(true)
                }
            } else if (data.startsWith("ze")) {
                document.getElementById('credititem-zero').style.display = "";
                document.getElementById('credititem-valid').style.display = "";
                if (!cont) {
                    ciTrigger(true)
                }
            } else {
                document.getElementById('credititem-error').style.display = "";
                document.getElementById('credititem2-valid').style.display = "none";
                if (!cont) {
                    ciTrigger(true)
                }
            }
        },
        error: function () {
            requesting = false;
            document.getElementById('credititem-wait').style.display = "none";
            document.getElementById('credititem-error').style.display = "";
        },
    });
}

function ciTrigger2(cont) {
    if (requesting) {
        return;
    }
    el = document.getElementById('name');

    document.getElementById('credititem2-valid').style.display = "none";
    document.getElementById('credititem2-no').style.display = "none";
    document.getElementById('credititem2-disabled').style.display = "none";
    document.getElementById('credititem2-invalid').style.display = "none";
    document.getElementById('credititem2-self').style.display = "none";
    document.getElementById('credititem2-error').style.display = "none";
    document.getElementById('credititem2-wait').style.display = "none";

    if (el.value == 0 || el.value.trim() == "") {
        return;
    }

    fdata = new FormData()
    fdata.append("u", el.value)

    document.getElementById('credititem2-wait').style.display = "";

    requesting = true;
    $.ajax({
        url: "/net.familine.Faminey/api/CheckDonateUser.php",
        dataType: 'html',
        cache: false,
        data: fdata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            requesting = false;
            document.getElementById('credititem2-wait').style.display = "none";

            if (data.startsWith("ok")) {
                document.getElementById('credititem2-valid').style.display = "";
                document.getElementById('credititem2-no').style.display = "none";
                if (!cont) {
                    ciTrigger2(true)
                }
            } else if (data.startsWith("no")) {
                document.getElementById('credititem2-no').style.display = "";
                if (!cont) {
                    ciTrigger2(true)
                }
            } else if (data.startsWith("di")) {
                document.getElementById('credititem2-disabled').style.display = "";
                document.getElementById('credititem2-valid').style.display = "none";
                if (!cont) {
                    ciTrigger2(true)
                }
            } else if (data.startsWith("in")) {
                document.getElementById('credititem2-invalid').style.display = "";
                document.getElementById('credititem2-valid').style.display = "none";
                if (!cont) {
                    ciTrigger2(true)
                }
            } else if (data.startsWith("su")) {
                document.getElementById('credititem2-self').style.display = "";
                document.getElementById('credititem2-valid').style.display = "none";
                if (!cont) {
                    ciTrigger2(true)
                }
            } else {
                document.getElementById('credititem2-error').style.display = "";
                document.getElementById('credititem2-valid').style.display = "none";
                if (!cont) {
                    ciTrigger2(true)
                }
            }
        },
        error: function () {
            requesting = false;
            document.getElementById('credititem2-wait').style.display = "none";
            document.getElementById('credititem2-error').style.display = "";
        }
    });
}

function donate() {
    document.getElementById('main-view').style.display = "none";
    document.getElementById('crediting').style.display = "";

    if (document.getElementById('credit').value.length > 0 && document.getElementById('name').value.length > 0) {
        fdata = new FormData()
        fdata.append("c", document.getElementById('credit').value);
        fdata.append("u", document.getElementById('name').value);
        fdata.append("r", document.getElementById('reason').value);

        document.getElementById('crediting-wait').style.display = "";

        $.ajax({
            url: "/net.familine.Faminey/api/DonateConfirm.php",
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
                    document.getElementById('crediting-no').style.display = "none";
                    location.href = "/net.familine.Faminey/";
                } else if (data.startsWith("em")) {
                    document.getElementById('crediting-valid').style.display = "";
                    document.getElementById('crediting-no').style.display = "none";
                    setTimeout(() => {
                        location.href = "/net.familine.Faminey/";
                    }, 5000);
                } else if (data.startsWith("no")) {
                    document.getElementById('crediting-no').style.display = "";
                } else if (data.startsWith("di")) {
                    document.getElementById('crediting-disabled').style.display = "";
                    document.getElementById('crediting-valid').style.display = "none";
                } else if (data.startsWith("in")) {
                    document.getElementById('crediting-invalid').style.display = "";
                    document.getElementById('crediting-valid').style.display = "none";
                } else if (data.startsWith("su")) {
                    document.getElementById('crediting-self').style.display = "";
                    document.getElementById('crediting-valid').style.display = "none";
                } else if (data.startsWith("wa")) {
                    document.getElementById('crediting-empty').style.display = "";
                } else if (data.startsWith("ze")) {
                    document.getElementById('crediting-zero').style.display = "";
                    document.getElementById('crediting-valid').style.display = "";
                } else {
                    document.getElementById('crediting-error').style.display = "";
                    document.getElementById('crediting-valid').style.display = "none";
                }
            },
            error: function () {
                document.getElementById('crediting-wait').style.display = "none";
                document.getElementById('crediting-error').style.display = "";
            }
        });
    }
}

</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/footer.php"; ?>
