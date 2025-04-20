<?php $_TITLE = "Résilier l'abonnement"; require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/header.php"; ?>

<div>
    <?php
    
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json")) {
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE): ?>
            <p>Votre profil Faminey est corrompu, il est impossible de continuer. Veuillez <a href="mailto:freeziv.ytb+aw-that-doesnt-work">contacter le support technique</a> pour demander la réparation de votre profil.</p>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/footer.php"; ?>
        <?php die();endif;
    } else {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", str_replace("\$\$uid\$\$", rand(111111111111, 999999999999), file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json")));
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE): ?>
            <p>Votre profil Faminey est corrompu, il est impossible de continuer. Veuillez <a href="mailto:freeziv.ytb+aw-that-doesnt-work">contacter le support technique</a> pour demander la réparation de votre profil.</p>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/footer.php"; ?>
        <?php die();endif;
    }

    $index = 0;
    foreach ($profile->subscriptions as $sub) {
        if (substr($sub->name, 0, 16) == "Familine™ Plus" || substr($sub->name, 0, 30) == "Familine™ Famiwiki® Premium") {
            unset($profile->subscriptions[$index]);
        }

        $index++;
    }
    $_PROFILE->subscription = 0;
    $_PROFILE->last = null;
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", json_encode($profile, JSON_PRETTY_PRINT));
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/plus/profiles/" . $_USER . ".json", json_encode($_PROFILE, JSON_PRETTY_PRINT));
    
    ?>
    Votre abonnement a été résilié, vous ne bénéficiez plus des avantages de Familine Plus.
    <p>Vous pouvez maintenant <a href="/fpn/#/">voir l'état de votre compte sur Faminey</a>, <a href="/">retourner au tableau de bord Familine</a> ou <a href="/plus">retourner à l'accueil de Familine Plus</a></p>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/footer.php"; ?>