<?php
header("Location: /familine4");die();
require_once $_SERVER['DOCUMENT_ROOT'] . "/ddos/session.php";
// We grab all the cookies
$cookies = "";
$keys = array_keys($_COOKIE);
$index = 0;
foreach ($_COOKIE as $cookie) {
    $cookies = $cookies . $keys[$index] . "=" . $cookie . ";";
    $index++;
}

// Make the request to the MediaWiki API
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost:440/net.familine.Famiwiki/api-private.php?action=query&meta=userinfo&format=json&token=ytxS4ssnpzESg7CfzEmrsRbMntW8ARp8UMQvCvGPa9smbWYa");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);

// Process the data
$data = json_decode($result);

if (json_last_error() !== JSON_ERROR_NONE && isset($_SERVER['REMOTE_ADDR'])) {
    header("Location: /login/index.php?r=frt");
    die();
}

if (isset($data->batchcomplete) && $data->batchcomplete == "") {} else {
    header("Location: /login/index.php?r=frt");
    if (isset($_SERVER['REMOTE_ADDR'])) {
        die();
    }
}

if (isset($data->query->userinfo->name)) {
    global $_USER;
    $_USER = $data->query->userinfo->name;
} else {
    header("Location: /login/index.php?r=frt");
    if (isset($_SERVER['REMOTE_ADDR'])) {
        die();
    }
}

/*$bans = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/bans.json"));
if (in_array($_USER, $bans)) {
    header("Location: /net.familine.Famiwiki/index.php?title=Accès refusé");
    die();
}*/
$bans = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/bans.json"));
if (in_array($_USER, $bans)) {
    die("Vous n'êtes pas autorisé à utiliser cette application, veuillez vous connecter à un autre compte");
}
