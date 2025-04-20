<?php $_TITLE = "Récupérer les identifiants"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/private/header-alt.php"; ?>
<?php

$codes = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/credentials/private/codes.json"));

if (in_array($_USER, array_keys((array)$codes))) {
    $code = $codes->$_USER;
} else {
    $code = rand(1111111111, 9999999999) . "-" . rand(400, 500) . "-" . rand(11111, 99999);
    $codes->$_USER = $code;
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/credentials/private/codes.json", json_encode($codes, JSON_PRETTY_PRINT));
}

?>
<div id="content-box">
    <p>
        La récupération d'identifiants depuis le site officiel de Famipun n'est plus disponible pour des raisons de sécurité et de simplicité. Merci d'envoyer un courriel à <a href="mailto:freeziv.ytb+fpn-creds@gmail.com">freeziv.ytb+fpn-creds@gmail.com</a> pour récupérer vos identifiants.
    </p>
    <p>
        Notez que l'équipe d'administration de Familine peut aussi vous demander le code suivant : <b><?= $code ?></b> (ne donnez ce code à personne d'autre que les administrateurs de Familine, il permet de récupérer vos identifiants).
    </p>
</div>
<?php /*
<div id="content-box">
    <p>
        Les identifiants suivants vous permettent de vous connecter <b>pour la première fois</b> à Famipun, en utilisant l'option « Ouvrir dans le navigateur » ou l'application sur votre appareil. Ces identifiants ne peuvent être utilisés qu'une seule fois, après vous être connecté, il vous sera demander de définir un nouveau mot de passe, ce qui invalidera le mot de passe sur cette page.
    </p>
    <blockquote>
        <b>Avertissement :</b> Tous les identifiants ont été réinitialisés entre le 16 et le 20 octobre 2020, merci de récupérer de nouveau vos identifiants depuis cette page et de (de nouveau) personnaliser votre mot de passe.
    </blockquote>
    <p>
        Description des colonnes :
        <ul>
            <li><b>Mode</b> : soit sur l'application, soit dans le navigateur, on vous demande de choisir un « mode » (par exemple professeur ou élève), cette colonne indique que l'identifiant est valide pour tel mode.</li>
            <li><b>Identifiant</b> : insensible à la casse, il s'agit de votre nom d'utilisateur, que vous devrez entrer dans la case « Identifiant ».</li>
            <li><b>Mot de passse</b> : votre mot de passe par défaut. Respectez bien la casse, il est conseillé d'utiliser la fonction copier-coller tant que possible.
                <ul>
                    <li>Pour des raisons de sécurité, le mot de passe n'est pas immédiatement visible, vous devez cliquer sur « afficher » ou sur « copier » pour y accéder.</li>
                </ul>
            </li>
            <li><b>Nom du profil</b> : Le nom qui sera affiché sur les emplois du temps, les listes d'appel, la page d'accueil, ...</li>
        </ul>
    </p>

    <h2>Identifiants disponibles pour le compte Familine « <?= $_USER ?> »</h2>
    <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/credentials/private/" . $_USER . ".json")): ?>
        <?php $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/credentials/private/" . $_USER . ".json"));
        if ($data == null || count($data) == 0): ?>
            <center><i>Pas d'identifiants Famipun associés avec votre compte Familine (ENODATA)</i></center>
        <?php else: ?>
            <table id="loginstables" class="table table-hover">
                <thead>
                    <tr>
                        <th>Mode</th>
                        <th>Identifiant</th>
                        <th>Mot de passe</th>
                        <th>Nom du profil</th>
                    </tr>
                </thead>
                <tbody>
                <?php $index=0;foreach ($data as $login): ?>
                    <tr>
                        <td><a href="<?= $login->link ?>"><?= $login->mode ?></a></td>
                        <td><?= $login->user ?></td>
                        <td id="password-<?= $index ?>">
                            <span style="display:none;" id="password-<?= $index ?>-show">
                                <code id="password-<?= $index ?>-copy"><?= $login->pass ?></code>
                                <small><a class="link" onclick="hidePass(<?= $index ?>);">masquer</a></small>
                            </span>
                            <span style="display:none;" id="password-<?= $index ?>-copied">
                                Copié !
                                <small><a class="link" onclick="showPass(<?= $index ?>);">afficher</a></small>
                                <small><a class="link" onclick="copyPass(<?= $index ?>);">copier</a></small>
                            </span>
                            <span id="password-<?= $index ?>-hide">
                                <small><a class="link" onclick="showPass(<?= $index ?>);">afficher</a></small>
                                <small><a class="link" onclick="copyPass(<?= $index ?>);">copier</a></small>
                            </span>
                        </td>
                        <td><?= $login->name ?></td>
                    </tr>
                <?php $index++;endforeach; ?>
                </tbody>
            </table>
            <center><i>En cas d'erreur, vous pouvez <a href="/fwk/#/index.php/Discussion:Accueil">ouvrir un sujet de discussion sur Famiwiki</a> pour demander la correction des informations.</i></center>
        <?php endif; ?>
    <?php else: ?>
        <center><i>Pas d'identifiants Famipun associés avec votre compte Familine (ENOTFOUND)</i></center>
    <?php endif; ?>
</div>

<script>

function showPass(id) {
    document.getElementById('password-' + id + '-copied').style.display = "none";
    document.getElementById('password-' + id + '-hide').style.display = "none";
    document.getElementById('password-' + id + '-show').style.display = "";
}

function hidePass(id) {
    document.getElementById('password-' + id + '-copied').style.display = "none";
    document.getElementById('password-' + id + '-hide').style.display = "";
    document.getElementById('password-' + id + '-show').style.display = "none";
}

function copyPass(id) {
    copyTextToClipboard(document.getElementById('password-' + id + '-copy').innerText);
    document.getElementById('password-' + id + '-copied').style.display = "";
    document.getElementById('password-' + id + '-hide').style.display = "none";
    document.getElementById('password-' + id + '-show').style.display = "none";
}

function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;

    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function() {
        console.log('Async: Copying to clipboard was successful!');
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
}

</script>*/?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/private/footer.php"; ?>