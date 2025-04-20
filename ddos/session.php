<?php
header("Location: /familine4");die();
require_once $_SERVER['DOCUMENT_ROOT'] . "/ddos/kartik.php";

/**
 *
 * All the code here will be applied to ALL websites
 *
 * This code is mainly for anti-DDOS functionnality
 * but can also be used for other things such as
 * tracking.
 *
 */
//var_dump($_SERVER['SCRIPT_NAME']);

/*

TODO: Re-enable this!

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

*/

// <!> DISABLED BECAUSE OF DNS PROBLEMS <!>
/*if ($_SERVER["SERVER_NAME"] === "familine.ddns.net") {
    header("Location: /redirect/?r=" . base64_encode($_SERVER['REQUEST_URI']));
}*/

$_NODDOS = true;
if (!isset($_NODDOS)) {
	$_NODDOS = false;
} else {
     if (!is_bool($_NODDOS)) {
        $_NODDOS = false;
     }
}

if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1") {
    $_NODDOS = true;
}

if (!$_NODDOS) {
$config = json_decode(file_get_contents("/data/ddos/config.json"));

$mins = json_decode(file_get_contents("/data/ddos/requests/1min.json"));
$secs = json_decode(file_get_contents("/data/ddos/requests/10secs.json"));

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$checking = false;
$unknowness = 0;
if (isset($secs->$ip)) {
    if ($secs->$ip->count >= $config->max->per10) {
        $checking = true;
    }
} else {
    $unknowness = $unknowness + 1;
}

if (isset($mins->$ip)) {
    if ($mins->$ip->count >= $config->max->per60) {
        $checking = true;
    }
} else {
    $unknowness = $unknowness + 1;
}

if ($unknowness >= 2) {
    $checking = true;
}

// Add browser check

$blocks = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/ddos/blocks.txt"));
foreach ($blocks as $block) {
    if (trim($block) == $ip) {
        die(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/err/block.html"));
    }
}

if ($checking && !isset($ignoreCheck)) {
    if (isset($secs->$ip)) {
        $secs->$ip->last = date("Y-m-d H:i:s");
        $secs->$ip->start = date("Y-m-d H:i:s");
    }
    if (isset($mins->$ip)) {
        $mins->$ip->last = date("Y-m-d H:i:s");
        $mins->$ip->last = date("Y-m-d H:i:s");
    }

    file_put_contents("/data/ddos/requests/10secs.json", json_encode($secs, JSON_PRETTY_PRINT));
    file_put_contents("/data/ddos/requests/1min.json", json_encode($mins, JSON_PRETTY_PRINT));

    require $_SERVER['DOCUMENT_ROOT'] . "/ddos/check.php";
    die();
}

/* --------------------------- */

if (isset($secs->$ip)) {
    $old = new DateTime($secs->$ip->start);
    $new = new DateTime('now');
    $diff = $old->diff($new);
    
    $sdiff = (int)$diff->format("%s");
    
    if ($sdiff >= 10) {
        $secs->$ip->start = date("Y-m-d H:i:s");
        $secs->$ip->count = 1;
    } else {
        $secs->$ip->count = $secs->$ip->count + 1;
    }
    
    $secs->$ip->last = date("Y-m-d H:i:s");
} else {
    $secs->$ip = [];
    $secs->$ip["count"] = 1;
    $secs->$ip["last"] = date("Y-m-d H:i:s");
    $secs->$ip["start"] = date("Y-m-d H:i:s");
}

file_put_contents("/data/ddos/requests/10secs.json", json_encode($secs, JSON_PRETTY_PRINT));

if (isset($mins->$ip)) {
    $old = new DateTime($mins->$ip->start);
    $new = new DateTime('now');
    $diff = $old->diff($new);
    
    $sdiff = (int)$diff->format("%i");
    
    if ($sdiff >= 1) {
        $mins->$ip->start = date("Y-m-d H:i:s");
        $mins->$ip->count = 1;
    } else {
        $mins->$ip->count = $mins->$ip->count + 1;
    }
    
    $mins->$ip->last = date("Y-m-d H:i:s");
} else {
    $mins->$ip = [];
    $mins->$ip["count"] = 1;
    $mins->$ip["last"] = date("Y-m-d H:i:s");
    $mins->$ip["start"] = date("Y-m-d H:i:s");
}

file_put_contents("/data/ddos/requests/1min.json", json_encode($mins, JSON_PRETTY_PRINT));
}
