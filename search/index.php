<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/UniversalCheckerAlt.php";

$type = "all";

if (isset($_GET['images'])) {
    $type = "images";
}

if (isset($_GET['users'])) {
    $type = "users";
}

if (isset($_GET['productions'])) {
    $type = "prods";
}

if ($_USER == null) {
    header("Location: /login/?r=home");
    die();
}

function sb_wordcount($a, $b) {
    return $a["wordcount"] - $b["wordcount"];
}

function super_unique($array)
{
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

    foreach ($result as $key => $value) {
        if (is_array($value)) {
            $result[$key] = super_unique($value);
        }
    }

    return $result;
}

if (!isset($_GET['q']) || trim($_GET['q']) == "" || trim($_GET['q']) == ".") {
    header("Location: /");
    die();
}

// Prevent XSS
$_GET['q'] = str_replace(">", " ", $_GET['q']);
$_GET['q'] = str_replace("<", " ", $_GET['q']);

// Get ready!
$start = new DateTime("now");

// We grab all the cookies (only once to speed up)
$cookies = "";
$keys = array_keys($_COOKIE);
$index = 0;
foreach ($_COOKIE as $cookie) {
    $cookies = $cookies . $keys[$index] . "=" . $cookie . ";";
    $index++;
}

// Search on Famiwiki
$curl = curl_init();
if ($type == "all" || $type == "images") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0|2|4|14&format=json");
}
if ($type == "users") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=2&format=json");
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
$fwk1 = json_decode($result, true);
$curl = curl_init();
if ($type == "all" || $type == "images") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0|2|4|6|14&format=json&srwhat=title");
}
if ($type == "users") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=2&format=json&srwhat=title");
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
$fwk2 = json_decode($result, true);
$fwk = @array_merge($fwk1, $fwk2);

// Search on Famiprods.net
$curl = curl_init();
if ($type == "all") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiprods/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0|4|14&format=json");
}
if ($type == "prods") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiprods/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0&format=json");
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
$fps1 = json_decode($result, true);
$curl = curl_init();
if ($type == "all") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiprods/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0|4|6|14&format=json&srwhat=title");
}
if ($type == "prods") {
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiprods/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0&format=json&srwhat=title");
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
$fps2 = json_decode($result, true);
$fps = @array_merge($fps1, $fps2);

// Search on Faminews
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Faminews/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0|4|14&format=json");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
$fns1 = json_decode($result, true);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Faminews/api.php?action=query&list=search&srsearch=" . urlencode($_GET['q']) . "&srprop=wordcount|snippet&srlimit=100&srnamespace=0|4|6|14&format=json&srwhat=title");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
$result = curl_exec($curl);
curl_close($curl);
$fns2 = json_decode($result, true);
$fns = @array_merge($fns1, $fns2);

// Get the total number of results
if ($type == "all") {
    $total = $fwk["query"]["searchinfo"]["totalhits"] + $fps["query"]["searchinfo"]["totalhits"] + $fns["query"]["searchinfo"]["totalhits"];
}
if ($type == "users") {
    $total = $fwk["query"]["searchinfo"]["totalhits"];
}
if ($type == "prods") {
    $total = $fps["query"]["searchinfo"]["totalhits"];
}

// Parse results
$fwkr = [];
$fpsr = [];
$fnsr = [];
if ($type == "users" || $type == "images") {
    foreach ($fwk["query"]["search"] as $result) {
        $result["source"] = "fwk";
        array_push($fwkr, $result);
    }
}
if ($type == "all") {
    foreach ($fwk["query"]["search"] as $result) {
        $result["source"] = "fwk";
        array_push($fwkr, $result);
    }
    foreach ($fps["query"]["search"] as $result) {
        $result["source"] = "fps";
        array_push($fpsr, $result);
    }
    foreach ($fns["query"]["search"] as $result) {
        $result["source"] = "fns";
        array_push($fnsr, $result);
    }
}
if ($type == "prods") {
    foreach ($fps["query"]["search"] as $result) {
        $result["source"] = "fps";
        array_push($fpsr, $result);
    }
}

// Sort by "most relevent"
$results = array_merge($fwkr, $fpsr, $fnsr);
$results = super_unique($results);
usort($results, "sb_wordcount");
$results = array_reverse($results);

if ($type != "images" && $total > 0) {
    // Getting the document root for the most relevent
    switch ($results[0]["source"]) {
        case "fwk":
            $relroot = "net.familine.Famiwiki";
            break;
        case "fps":
            $relroot = "net.familine.Famiprods";
            break;
        case "fns":
            $relroot = "net.familine.Faminews";
            break;
    }

    // Getting intro of most relevent
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost/{$relroot}/api.php?action=query&prop=extracts&exintro=true&exlimit=1&titles=" . urlencode(str_replace(" ", "_", $results[0]["title"])) . "&explaintext=1&formatversion=2&format=json");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, $cookies);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($curl);
    curl_close($curl);
    $ijson = json_decode($result, true);
    $intro = trim($ijson["query"]["pages"][0]["extract"]);

    // Getting images list of most relevent
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost/{$relroot}/api.php?action=query&prop=images&titles=" . urlencode(str_replace(" ", "_", $results[0]["title"])) . "&imlimit=5&imdir=descending&format=json");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, $cookies);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($curl);
    curl_close($curl);
    $pjson = json_decode($result, true);
    $picturesraw = @$pjson["query"]["pages"][(string)$results[0]["pageid"]]["images"];
    if (!isset($picturesraw)) {
        $picturesraw = [];
    }
    $pictures = [];
    foreach ($picturesraw as $picture) {
        array_push($pictures, urlencode(str_replace(" ", "_", $picture["title"])));
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost/{$relroot}/api.php?action=query&titles=" . implode($pictures, "|") . "&prop=imageinfo&iilimit=5&iiprop=user|url&format=json");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, $cookies);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($curl);
    curl_close($curl);
    $pujson = @json_decode($result, true)["query"]["pages"];
    if (!isset($pujson)) {
        $pujson = [];
    }
    $images = [];
    $inames = [];
    $icreds = [];
    $icreds2 = [];
    foreach ($pujson as $image) {
        @array_push($images, $image["imageinfo"][0]["url"]);
        @array_push($inames, urlencode(str_replace(" ", "_", $image["title"])));
        @array_push($icreds2, urlencode(str_replace(" ", "_", $image["imageinfo"][0]["user"])));
        @array_push($icreds, $image["imageinfo"][0]["user"]);
    }
}

// Images list
if ($type == "images") {
    $total = 0;
    $titlesa = [];
    foreach ($results as $page) {
        array_push($titlesa, urlencode(str_replace(" ", "_", $page["title"])));
    }

    $titles = implode($titlesa, "|");

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api.php?action=query&prop=images&titles=" . $titles . "&imlimit=100&imdir=descending&format=json");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, $cookies);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($curl);
    curl_close($curl);
    $pjson = json_decode($result, true);
    $picturesraw = @$pjson["query"]["pages"][(string)$results[0]["pageid"]]["images"];
    if (!isset($picturesraw)) {
        $picturesraw = [];
    }
    $pictures = [];
    foreach ($picturesraw as $picture) {
        array_push($pictures, urlencode(str_replace(" ", "_", $picture["title"])));
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost/net.familine.Famiwiki/api.php?action=query&titles=" . implode($pictures, "|") . "&prop=imageinfo&iilimit=100&iiprop=user|url&format=json");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, $cookies);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $result = curl_exec($curl);
    curl_close($curl);
    $pujson = @json_decode($result, true)["query"]["pages"];
    if (!isset($pujson)) {
        $pujson = [];
    }
    $images = [];
    $inames = [];
    $icreds = [];
    $icreds2 = [];
    foreach ($pujson as $image) {
        $total++;
        array_push($images, $image["imageinfo"][0]["url"]);
        array_push($inames, urlencode(str_replace(" ", "_", $image["title"])));
        array_push($icreds2, urlencode(str_replace(" ", "_", $image["imageinfo"][0]["user"])));
        array_push($icreds, $image["imageinfo"][0]["user"]);
    }
}

// It's done!
$end = new DateTime("now");

// Calculate difference
$interval = $start->diff($end);

?>

<!DOCTYPE html>
<html>

<head>
    <title><?= $_GET['q'] ?> sur Familine</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/logos/familine/familine128.png" type="image/png">
    <script src="/fwk/jquery.js"></script>
    <link rel="stylesheet" href="https://familine.ddns.net/cdn/style/search.css">
</head>

<body>
    <div id="navbar">
        <a href="/"><img src="/logos/familine/familine48.png" height="48px" id="logo"></a>
        <form action="/search" id="fl-searchfrm">
            <input id="fl-searchbox" name="q" placeholder="Rechercher sur Familine" value="<?= $_GET['q'] ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <?php if ($type != "all"): ?>
            <input type="hidden" name="<?= $type == "images" ? "images" : "" ?><?= $type == "prods" ? "productions" : "" ?><?= $type == "users" ? "users" : "" ?>">
            <?php endif; ?>
            <button type="submit" id="fl-searchsmb"><img src="https://familine.ddns.net/cdn/material/ic_search_24px.svg"></button>
        </form>
        <span id="userbox">
            <?= $_USER ?>
        </span>
    </div>
    <div id="type">
        <a title="Afficher tous les résultats, incluant des articles, images, utilisateurs et productions" class="typelink" href="/search/?q=<?= urlencode($_GET['q']) ?>"><div id="type-all" class="type-item<?= $type == "all" ? " selected" : "" ?>">
            <img class="typelink-icon" src="/mdi/ic_all_inclusive_24px.svg">
            <span class="typelink-title">Tout</span>
        </div></a>
        <a title="Afficher uniquement les résultats relatifs à des images publiées sur Famiwiki" class="typelink" href="/search/?q=<?= urlencode($_GET['q']) ?>&images"><div id="type-pict" class="type-item<?= $type == "images" ? " selected" : "" ?>">
            <img class="typelink-icon" src="/mdi/ic_insert_photo_24px.svg">
            <span class="typelink-title">Images</span>
        </div></a>
        <a title="Afficher uniquement les résultats relatifs à des utilisateurs de Familine" class="typelink" href="/search/?q=<?= urlencode($_GET['q']) ?>&users"><div id="type-user" class="type-item<?= $type == "users" ? " selected" : "" ?>">
            <img class="typelink-icon" src="/mdi/ic_account_box_24px.svg">
            <span class="typelink-title">Utilisateurs</span>
        </div></a>
        <a title="Afficher uniquement les résultats relatifs à des productions de Famiprods" class="typelink" href="/search/?q=<?= urlencode($_GET['q']) ?>&productions"><div id="type-prods" class="type-item<?= $type == "prods" ? " selected" : "" ?>">
            <img class="typelink-icon" src="/mdi/ic_movie_filter_24px.svg">
            <span class="typelink-title">Productions</span>
        </div></a>
    </div>
    <div id="summary">
        <?= $total > 0 ? $total : "Aucun" ?> résultat<?= $total > 1 ? "s" : "" ?> trouvé<?= $total > 1 ? "s" : "" ?> en <?= number_format($interval->f, 2, ',', '') ?> secondes
    </div>
    <div id="results">
        <?php if ($total > 0): ?><?php if ($type != "images"): ?>
            <?php if ($type == "all"): ?>
            <a class="card" id="card-relevent" href="/<?= $results[0]["source"] ?>/#/index.php?title=<?= urlencode(str_replace(" ", "_", $results[0]["title"])) ?>">
                <h3 class="card-title"><?= str_replace("Utilisateur:", "", $results[0]["title"]) ?></h3>
                <span class="card-source"><img class="card-source-img" width="16px" height="16px" src="<?php

                if ($results[0]["ns"] == 2) {
                    echo "/mdi/ic_account_circle_24px.svg";
                } else {
                    switch ($results[0]["source"]) {
                        case "fwk":
                            echo "/logos/famiwiki/famiwiki64.png";
                            break;
                        case "fps":
                            echo "/logos/prodsnet/prodsnet64.png";
                            break;
                        case "fns":
                            echo "/logos/faminews/faminews64.png";
                            break;
                    }
                }

                ?>"> <span class="card-source-text"><?php

                if ($results[0]["ns"] == 2) {
                    echo "Utilisateur";
                } else {
                    switch ($results[0]["source"]) {
                        case "fwk":
                            echo "Famiwiki";
                            break;
                        case "fps":
                            echo "Famiprods.net";
                            break;
                        case "fns":
                            echo "Faminews";
                            break;
                    }
                }

                ?> · <?= $results[0]["wordcount"] ?> mot<?= $results[0]["wordcount"] > 1 ? "s" : "" ?></span></span>
                <p class="card-intro">
                    <?= $intro ?>
                </p>
            </a>
            <div id="relevent-images">
                <h3 id="relevent-images-title">Images relatives à <?= str_replace("Utilisateur:", "", $results[0]["title"]) ?></h3>
                <div id="rimg-space">
                    <?php if (isset($inames[0])): ?><div id="rimg-1" class="rimg-img"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=<?= $inames[0] ?>"><img src="<?= $images[0] ?>"></a></div><?php endif; ?>
                    <?php if (isset($inames[1])): ?><div id="rimg-2" class="rimg-img"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=<?= $inames[1] ?>"><img src="<?= $images[1] ?>"></a></div><?php endif; ?>
                    <?php if (isset($inames[2])): ?><div id="rimg-3" class="rimg-img"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=<?= $inames[2] ?>"><img src="<?= $images[2] ?>"></a></div><?php endif; ?>
                    <?php if (isset($inames[3])): ?><div id="rimg-4" class="rimg-img"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=<?= $inames[3] ?>"><img src="<?= $images[3] ?>"></a></div><?php endif; ?>
                    <?php if (isset($inames[4])): ?><div id="rimg-5" class="rimg-img"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=<?= $inames[4] ?>"><img src="<?= $images[4] ?>"></a></div><?php endif; ?>
                </div>
                <div id="rimg-credit">
                    <?php if (isset($inames[0])): ?><div id="rimg-cred-1" class="rimg-cred"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=Utilisateur:<?= $icreds2[0] ?>">par <?= $icreds[0] ?></a></div><?php endif; ?>
                    <?php if (isset($inames[1])): ?><div id="rimg-cred-2" class="rimg-cred"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=Utilisateur:<?= $icreds2[1] ?>">par <?= $icreds[1] ?></a></div><?php endif; ?>
                    <?php if (isset($inames[2])): ?><div id="rimg-cred-3" class="rimg-cred"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=Utilisateur:<?= $icreds2[2] ?>">par <?= $icreds[2] ?></a></div><?php endif; ?>
                    <?php if (isset($inames[3])): ?><div id="rimg-cred-4" class="rimg-cred"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=Utilisateur:<?= $icreds2[3] ?>">par <?= $icreds[3] ?></a></div><?php endif; ?>
                    <?php if (isset($inames[4])): ?><div id="rimg-cred-5" class="rimg-cred"><a class="rimg-link" href="/<?= $results[0]["source"] ?>/#/index.php?title=Utilisateur:<?= $icreds2[4] ?>">par <?= $icreds[4] ?></a></div><?php endif; ?>
                </div>
            </div>
            <hr id="relevent-separator">
            <?php array_shift($results); ?>
            <?php endif; ?>
            <?php foreach ($results as $result): ?>
                <a class="card" id="card-relevent" href="/<?= $result["source"] ?>/#/index.php?title=<?= urlencode(str_replace(" ", "_", $result["title"])) ?>">
                    <h3 class="card-title"><?= str_replace("Utilisateur:", "", $result["title"]) ?></h3>
                    <span class="card-source"><img class="card-source-img" width="16px" height="16px" src="<?php

                    if ($result["ns"] == 2) {
                        echo "/mdi/ic_account_circle_24px.svg";
                    } else {
                        switch ($result["source"]) {
                            case "fwk":
                                echo "/logos/famiwiki/famiwiki64.png";
                                break;
                            case "fps":
                                echo "/logos/prodsnet/prodsnet64.png";
                                break;
                            case "fns":
                                echo "/logos/faminews/faminews64.png";
                                break;
                        }
                    }

                    ?>"> <span class="card-source-text"><?php

                    if ($result["ns"] == 2) {
                        echo "Utilisateur";
                    } else {
                        switch ($result["source"]) {
                            case "fwk":
                                echo "Famiwiki";
                                break;
                            case "fps":
                                echo "Famiprods.net";
                                break;
                            case "fns":
                                echo "Faminews";
                                break;
                        }
                    }

                    ?> · <?= $result["wordcount"] ?> mot<?= $result["wordcount"] > 1 ? "s" : "" ?></span></span>
                    <p class="card-summary">
                        <?= $result["snippet"] ?>
                    </p>
                </a>
            <?php endforeach; ?><?php else: ?>
                <div id="images">
                <?php $index=0;foreach ($images as $image): ?>
                <div id="image-<?= $index ?>" class="image-img"><div><a class="image-link" href="/fwk/#/index.php?title=<?= $inames[$index] ?>"><img src="<?= $images[$index] ?>"></a><br><div id="image-cred-<?= $index ?>" class="rimg-cred"><a class="rimg-link" href="/fwk/#/index.php?title=Utilisateur:<?= $icreds2[$index] ?>">par <?= $icreds[$index] ?></a></div></div></div>
                <?php $index++;endforeach;?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h2>Aucun résultat</h2>
            <p>
                Aucun résultat correspondant à votre recherche n'a été trouvé. Voici quelques conseils :
                <ul>
                    <li>vérifiez l'orthographe de votre recherche</li>
                    <li>retirez des mots pour rendre votre recherche plus vague</li>
                    <li>essayez des mots synonymes</li>
                </ul>
            </p>
        <?php endif; ?>
    </div>
</body>

</html>
