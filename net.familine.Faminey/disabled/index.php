<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker2.php"; ?>
<?php

global $_USER;
if (isset($_USER)) {
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json")) {
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE): ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur interne | Faminey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="/net.familine.Faminey/styles/common.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="/net.familine.Faminey/">Faminey</a>
        <span class="navbar-text">
            Erreur interne
        </span>
    </nav>
    <h1>Profil corrompu</h1>
    <p>Votre profil Faminey est corrompu et ne peut pas être lu pour le moment. Ne vous inquiétez pas, <b>vous n'avez pas perdu votre argent</b>, vous devez simplement <a href="mailto:freeziv.ytb+faminey@gmail.com">contacter le support technique</a> pour réparer votre profil.</p>
</body>
</html>
        <?php die();endif;
    } else {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json", str_replace("\$\$uid\$\$", rand(111111111111, 999999999999), file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/\$\$default.json")));
        $profile = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/net.familine.Faminey/public/" . $_USER . ".json"));

        if (json_last_error() != JSON_ERROR_NONE): ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur interne | Faminey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="/net.familine.Faminey/styles/common.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="/net.familine.Faminey/">Faminey</a>
        <span class="navbar-text">
            Erreur interne
        </span>
    </nav>
    <h1>Profil corrompu</h1>
    <p>Votre profil Faminey est corrompu et ne peut pas être lu pour le moment. Ne vous inquiétez pas, <b>vous n'avez pas perdu votre argent</b>, vous devez simplement <a href="mailto:freeziv.ytb+faminey@gmail.com">contacter le support technique</a> pour réparer votre profil.</p>
</body>
</html>
        <?php die();endif;
    }
}

$profile->credit = (float)number_format((float)$profile->credit, 2, '.', '');

?>
<!DOCTYPE html>
<html lang="en" style="height:100%;overflow:hidden;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte désactivé</title>
</head>
<body style="background-color:red;display:flex;color:white;align-items:center;justify-content:center;height:100%;font-family:sans-serif;flex-wrap:wrap;text-align:center;">
    <div>
        <h1>Votre compte a été désactivé</h1>
        <p>Soit il a été désactivé par un administrateur, ou alors vous êtes endetté de plus de 50,00 €. Dans tous les cas, l'argent sur votre compte Faminey est perdu et votre compte Familine est désactivé.</p>
        <p>Si vous pensez qu'il s'agit d'une erreur, ou que vous voulez en savoir plus, appelez le <b>+33 7 83 28 46 07</b> (en France) ou envoyez un courriel à <b>freeziv.ytb+familine-bans@gmail.com</b>  (autres pays)</p>
        <p>Cette désactivation ne concerne que votre compte Familine™ et n'impacte pas votre profil sur Microsoft Teams ou Famichat. Ne paniquez pas, si vous n'avez rien à vous reprocher, votre compte reviendra dans quelques instants.</p>
        <p>Il ne vous reste plus qu'une seule chose à faire...<br><button onclick="location.href='/login';">Vous connecter à un autre compte</button></p>
    </div>
</body>
</html>
