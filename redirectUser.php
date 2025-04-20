<?php

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
curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api-private.php?action=query&meta=userinfo&format=json&token=ytxS4ssnpzESg7CfzEmrsRbMntW8ARp8UMQvCvGPa9smbWYa");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);

// Process the data
$data = json_decode($result);

if (json_last_error() !== JSON_ERROR_NONE && isset($_SERVER['HTTP_HOST'])) {
    header("Location: /login/?r=fwk");
    die();
}

if (isset($data->batchcomplete) && $data->batchcomplete == "") {} else {
    header("Location: /login/?r=fwk");
    if (isset($_SERVER['HTTP_HOST'])) {
        die();
    }
}

if (isset($data->query->userinfo->name)) {
    global $_USER;
    $_USER = $data->query->userinfo->name;
    header("Location: /net.familine.Famiwiki/index.php?title=" . $_USER);
    die();
} else {
    header("Location: /login/?r=fwk");
    if (isset($_SERVER['HTTP_HOST'])) {
        die();
    }
}

$bans = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/bans.json"));
if (in_array($_USER, $bans)) {
    header("Location: /net.familine.Famiwiki/index.php?title=Accès refusé");
    die();
}
