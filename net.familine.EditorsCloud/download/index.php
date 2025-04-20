<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/APIHeaders.php"; ?>
<?php

if (!isset($_GET['url']) || strpos(base64_decode($_GET['url']), "..") != false) {
    header("Location: /net.familine.EditorsCloud/download/?url=/");
    die();
}

$_GET['url'] = base64_decode($_GET['url']);

if (!isset($_GET['url']) || strpos($_GET['url'], "..") !== false) {
    header("Location: /net.familine.EditorsCloud/download/?url=/");
    die();
}

function sendHeaders($file, $type, $name=NULL)
{
    if (empty($name))
    {
        $name = basename($file);
    }
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Transfer-Encoding: binary');
    header('Content-Disposition: inline');
    header('Content-Type: ' . $type);
    header('Content-Length: ' . filesize($file));
}

$root = $_PROFILE->root . "/" . $_GET['url'];
  $rootp = "/" . $_GET['url'];
$url = $rootp;
    $parts = explode("/", $url);
    $parts2 = explode("/", $url);
    $parts3 = [];
    array_pop($parts);
if (!file_exists($root)) {
    die("ENOTFOUND : Fichier inexistant");
}

    $type = mime_content_type($root);

if (file_exists($root)) {
    if (is_file($root))
{
    sendHeaders($root, $type, explode("/", $root)[count(explode("/", $root))-1]);
    $chunkSize = 1024 * 1024;
    $handle = fopen($root, 'rb');
    while (!feof($handle))
    {
        $buffer = fread($handle, $chunkSize);
        echo $buffer;
        ob_flush();
        flush();
    }
    fclose($handle);
    exit;
}
} else {
    die();
}