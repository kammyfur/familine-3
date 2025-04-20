<?php $_TITLE = "Créditer le compte"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/header.php";

function dec2hex($dec)
{
    $hex = ($dec == 0 ? '0' : '');

    while ($dec > 0) {
        $hex = dechex($dec - floor($dec / 16) * 16) . $hex;
        $dec = floor($dec / 16);
    }

    return $hex;
}

?>

<center>
    <h2>Comment souhaitez-vous créditer votre compte ?</h2>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <i class="material-icons big-head">payments</i><br>
                    Argent physique
                </div>
                <div class="card-body">
                    <p>Utilisez de l'argent en espèces afin d'alimenter votre compte Familine™ Faminey®.</p>
                    <p>Notez que votre compte ne sera crédité que lorsque l'argent aura été reçu par un administrateur de Familine™ Faminey® ; le paiement ne peut s'effectuer qu'en main propre.</p>
                </div>
                <div class="card-footer">
                    <a href="mailto:freeziv.ytb+faminey-cash@gmail.com?subject=[0x<?= dec2hex((string)rand(286331153, 4294967295)); ?>] Demande de crédit par espèces&body=Bonjour, créditer [PRIX] € sur le compte de <?= $_USER ?> (<?= $profile->id ?>), je remettrai l'argent en main propre. Cordialement." class="btn btn-primary">Commencer ↗</a> 
                </div>
            </div>
            <small>En cliquant sur commencer, cela va ouvrir votre client email pour envoyer une demande. <b>Ne modifiez pas le contenu</b>, remplacez simplement <code>[PRIX]</code> par la quantité d'argent que vous souhaitez créditer sur votre compte.</small>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <i class="material-icons big-head">card_giftcard</i><br>
                    Utiliser un code
                </div>
                <div class="card-body">
                    <p>Utilisez un code cadeau ou une carte prépayée pour récupérer de l'argent.</p>
                    <p>Vous récupèrerez l'argent juste après l'entrée du code, et le code deviendra inutilisable. L'activation d'une carte de plus de 20 € vous déconnectera de votre compte par sécurité.</p>
                </div>
                <div class="card-footer">
                    <a href="/net.familine.Faminey/credit/code/" class="btn btn-primary">Commencer</a>
                </div>
            </div>
        </div>
    </div>
</center>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/footer.php"; ?>