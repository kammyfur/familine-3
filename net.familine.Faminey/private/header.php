<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalChecker2.php"; ?>
<?php

global $_USER;
if (isset($_USER)) {
    if ($_USER == "Administrateur" && isset($_GET['user'])) {
        $_USER = $_GET['user'];
    }
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
<?php /*    <link rel="shortcut icon" href="favicon.png" type="image/png"> */ ?>
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
    <p>Erreur <?= json_last_error() ?> : <?= json_last_error_msg() ?></p>
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
<?php /*    <link rel="shortcut icon" href="favicon.png" type="image/png"> */ ?>
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
    <p>Erreur <?= json_last_error() ?> : <?= json_last_error_msg() ?></p>
</body>
</html>
        <?php die();endif;
    }
}

$profile->credit = (float)number_format((float)$profile->credit, 2, '.', '');

if ($profile->disabled != false || $profile->credit <= -50) {
    header("Location: /net.familine.Faminey/disabled/");
    die();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_TITLE ?> | Faminey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="/logos/faminey/faminey64.png" type="image/png">
    <link rel="stylesheet" href="/net.familine.Faminey/styles/common.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="/net.familine.Faminey/">Faminey</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/net.familine.Faminey/credit/">Créditer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/net.familine.Faminey/donate/">Donner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="width: max-content;" href="/net.familine.Faminey/recycle/">Réutiliser <span class="badge badge-secondary">Nouveau</span></a>
            </li>
        </ul>

        <span class="navbar-text" style="width:100%;text-align:right;">
            <?= $_USER ?> (<?= $profile->id ?>)
        </span>
    </nav>
    <br>
