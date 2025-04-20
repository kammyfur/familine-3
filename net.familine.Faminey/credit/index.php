<?php $_TITLE = "Créditer le compte"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/header.php"; ?>

<h2>Informations importantes à lire avant toute transaction</h2>
<p>Une fois l'argent crédité sur votre compte Familine™ Faminey®, il n'y a <b>aucune possibilité de récupérer cet argent</b>, il ne peut être utilisé strictement aux fins des services proposés par Familine™. <b>Vous</b> êtes seul responsable de l'utilisation de l'argent crédité sur votre compte Familine™ Faminey®</p>

<h3>Litiges et remboursements</h3>
<p>En cas de litige ou de non-satisfaction, Familine™ peut proposer <b>dans des mesures exceptionnelles</b>, un remboursement du client, sur son compte Familine™ Faminey®, qu'il pourra utiliser pour d'autres achats.</p>
<p>Les dons effectués à d'autres personnes <b>ne sont pas remboursables</b> en raison de la nature complèxe d'un don (la personne pourrait dépenser l'argent, et se retrouver endettée par votre faute), les dons ne pouvant excéder la valeur de 15 € par unité.</p>
<p>Les achats de produits physiques ne peuvent être remboursés uniquement si le produit n'a pas été utilisé et est encore présent dans son emballage d'origine. <b>Toute trace d'ouverture et/ou de remballage fera refuser votre remboursement.</b></p>
<p>Pour terminer, Familine™ se réserve le droit <b>exclusif</b> de terminer les comptes Familine™ Faminey® sans avertissement préalable, et sans rembourser l'argent présent sur ce dernier.</p>

<h3>Valeur légale</h3>
<p>Légalement, l'argent physique crédité sur votre compte Familine™ Faminey® (virtuel) fait l'objet d'un <b>don</b> à XXX pour le maintien de Familine™.</p>
<p>De votre point de vue, l'argent crédité peut-être utilisé dans le cadre des services et produits de Familine™, mais appartient réellement à XXX.</p>
<p>Pour rappeler les paragraphes précédents, un don effectué à un autre utilisateur de Familine™ Faminey® ne pourra pas lui rapporter d'argent réel, l'argent donné ne pourra être utilisé que sur les services de Familine™.</p>

<h3>Vie privée</h3>
<p>Chaque utilisateur de Familine™ Faminey® se voit attribuer un <b>identifiant unique d'utilisateur</b>, affiché dans le coin supérieur droit de l'écran, à côté de son nom d'utilisateur. Il est utilisé en interne par le logiciel Familine™ Faminey® et <b>ne permet pas</b> à d'autres utilisateurs d'accéder à votre compte.</p>
<p>Un utilisateur ayant crédité de l'argent sur Familine™ Faminey® se voit recommandé de changer son mot de passe de compte pour un mot de passe plus « fort » et plus complèxe, afin de prévenir contre de potentiels piratages.</p>

<h3>Dettes</h3>
<p>Avec un compte Familine™ Faminey®, il est possible d'être endetté. Être endetté à partir de -50,00 € vous interdit d'effectuer des paiements jusqu'à crédit de votre compte, sachant que vous avez jusqu'à 6 mois pour créditer votre compte lorsque vous êtes endetté.</p>
<p>Tout endettement prolongé de plus de 6 mois mènera à des sanctions internes dans Familine™ et peut aussi mener à des poursuites judiciaires selon le montant endetté.</p>

<hr>

<label><input id="checkb" type="checkbox" onchange="check();"> J'accepte que <b>l'argent crédité sur Familine™ Faminey® le soit pour toujours</b> et de <b>ne pas être endetté plus de 6 mois</b>. Si je suis mineur, je certifie avoir reçu l'autorisation de mon responsable légal.</label><br>
<a id="button" href="#" class="btn btn-primary disabled">Continuer</a>

<script>

function check() {
    if (document.getElementById('checkb').checked) {
        document.getElementById('button').classList.remove('disabled');
        document.getElementById('button').href = "/net.familine.Faminey/credit/hello/";
    } else {
        document.getElementById('button').classList.add('disabled');
        document.getElementById('button').href = "#";
    }
}

</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/footer.php"; ?>