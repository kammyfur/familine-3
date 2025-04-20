<?php $_TITLE = "Projet de réutilisation"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/header.php"; ?>

<h1>Projet de réutilisation d'anciens objets</h1>
<p><details>
    <summary>C'est quoi ?</summary>
    <blockquote style="margin-left:35px;">
    <p>Avec Familine 2021, Familine propose maintenant à tous les membres de la famille de donner des objets dont ils ne se servent plus afin d'aider les administrateurs de Familine, que ce soit personnellement ou pour maintenir Familine. Les autres utilisateurs peuvent <a href="mailto:freeziv.ytb@gmail.com">contacter les administrateurs</a> pour publier une offre.</p>
    <p>Tous les membres de Familine sont fortement encouragés à donner du matériel qu'ils n'utilisent plus, ils gagnent de l'argent sur leur compte Faminey après avoir donné un objet (la somme peut varier selon l'état de l'objet). Sur la page de Faminey, la somme maximale est affichée. En cliquant sur "Détails", vous pourrez voir les variations de la somme selon l'état de l'objet.</p>
    <p>Des conditions particulières sont à remplir pour donner un objet ; il est important de vérifier que votre objet remplit toutes ces conditions avant de le donner afin d'éviter les déplacements inutiles. <b>Tous les vices cachés vous seront facturés</b>, il est donc important de signaler tout défaut. Pour les objets nécessitant une taille/des dimensions et/ou un poids particuliers, la plage demandée est spécifiée, en utilisant les unités respectives du système international : grammes et mètres.</p>
    <p>La quantité d'objets maximale acceptée est là aussi précisée. Si il y a plus de demandes que d'objets demandés, seul le premier reçu sera pris en compte, les objets reçus pourront vous être retournés ou être recyclés proprement, selon votre choix. Dans tous les cas, si vous respectez les règles, vous ne perderez rien sur votre compte Faminey.</p>
    </blockquote>
</details></p>

<h2>Soyez toujours au courant</h2>
<p>Restez informez des dernières offres disponibles en vous inscrivant à la lettre d'information (newsletter). Vous recevrez 1 email par semaine avec les offres actives cette semaine.</p>
<div class="input-group mb-3">
  <input type="email" id="email" class="form-control" placeholder="Adresse email"<?php

    $emails = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/emails.json"));

    if (isset($emails->$_USER)): ?>
    value="<?= $emails->$_USER ?>"
    <?php endif; ?>>
  <div class="input-group-append">
    <?php

    $emails = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/emails.json"));

    if (isset($emails->$_USER)): ?>
    <button class="btn btn-primary" type="submit" onclick="register();">Modifier</button>
    <button class="btn btn-danger" type="button" onclick="unregister();">Se désinscrire</button>
    <?php else: ?>
    <button class="btn btn-success" type="submit" onclick="register();">S'inscrire</button>
    <?php
    endif;
    ?>
  </div>
</div>
<script>

function register() {
    fdata = new FormData()
    fdata.append("e", document.getElementById('email').value);

    $.ajax({
        url: "/net.familine.Faminey/api/GiveNewsletterRegister.php",
        dataType: 'html',
        cache: false,
        data: fdata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            location.reload();
        }
    })
}

function unregister() {
    fdata = new FormData()

    $.ajax({
        url: "/net.familine.Faminey/api/GiveNewsletterDelete.php",
        dataType: 'html',
        cache: false,
        data: fdata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            location.reload();
        }
    })
}

</script>

<h2>Offres actuelles</h2>
<div id="cards">
<?php $items=json_decode(file_get_contents("./recycles.json"), true);foreach ($items as $item): ?>
<div class="card">
  <img class="card-img-top" src="/net.familine.Faminey/recycle/image.php?id=<?= $item['id'] ?>" alt="">
  <div class="card-body">
    <h4 class="card-title"><?= $item['name'] ?> <span class="badge badge-info badge-pill"><?= $item['price'] ?> €</span> <span class="badge badge-pill badge-<?php if($item['qty'] > 1){echo("success");}else{echo("warning");}; ?>">×<?= $item['qty'] ?></span></h4>
    <p class="card-text"><?php if (strlen($item['description']) > 100) { echo(substr($item['description'], 0, 100) . " ..."); }else{ echo($item['description']); } ?></p>
    <a href="/net.familine.Faminey/recycle/give/?id=<?= $item['id'] ?>" class="btn btn-primary">J'en ai !</a>
    <a href="/net.familine.Faminey/recycle/info/?id=<?= $item['id'] ?>" class="btn btn-secondary">Détails...</a>
  </div>
</div>
<?php endforeach; ?>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/footer.php"; ?>