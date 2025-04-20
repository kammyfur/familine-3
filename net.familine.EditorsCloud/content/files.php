<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/Headers.php"; ?>
<?php

if (!isset($_GET['url']) || strpos(base64_decode($_GET['url']), "..") !== false) {
    header("Location: /net.familine.EditorsCloud/content/files.php/?url=Lw==");
    die();
}

?>

<?php

$_GET['url'] = base64_decode($_GET['url']);

if (!isset($_GET['url']) || strpos($_GET['url'], "..") !== false) {
    header("Location: /net.familine.EditorsCloud/content/files.php/?url=Lw==");
    die();
}

$root = $_PROFILE->root . "/" . $_GET['url'];
  $rootp = "/" . $_GET['url'];
  $rootp2 = $rootp;
$url = $rootp;
$url2 = $rootp;
    $parts = explode("/", $url);
    $parts2 = explode("/", $url);
    $parts3 = [];
    array_pop($parts);
    foreach ($parts2 as $part) {
        if (!trim($part) == "") {
            array_push($parts3, $part);
        }
    }
    if (count($parts3) == 0) {
        echo "<small style=\"padding:5px\";><a class=\"navlink\" href=\"/net.familine.EditorsCloud/content/files.php?url=Lw==\"><b>Racine du stockage</b></a>";
    } else {
        echo "<small style=\"padding:5px\";><a class=\"navlink\" href=\"/net.familine.EditorsCloud/content/files.php?url=Lw==\">Racine du stockage</a>";
    }
    $cpath = "";
    $index = 1;
    foreach ($parts3 as $part) {
        $cpath = $cpath . "/" . $part;
        if ($index == count($parts3)) {
            echo(" → <a class=\"navlink\" href=\"/net.familine.EditorsCloud/content/files.php?url=" . base64_encode($cpath) . "\"><b>" . $part . "</b></a>");
        } else {
            echo(" → <a class=\"navlink\" href=\"/net.familine.EditorsCloud/content/files.php?url=" . base64_encode($cpath) . "\">" . $part . "</a>");
        }

        $index++;
    }
    echo "</small><hr class=\"mdc-list-divider\">";
?>

<div class="mdc-list-group">
<ul class="mdc-list">
<?php if (preg_match('/[^\/]/', $_GET['url'])): ?>
    <li onclick='location.href = "/net.familine.EditorsCloud/content/files.php?url=<?php

    $new = implode("/", $parts);

    echo(base64_encode($new));

    if (trim($parts[count($parts)-1]) == "") {
        $parts[count($parts)-1] = "Racine du stockage";
    }

    ?>";' class="mdc-list-item" tabindex="0">
    <span class="mdc-list-item__ripple fshow"></span>
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">arrow_upward</i>
    <span class="mdc-list-item__text">Remonter d'un niveau <small>(vers <?= $parts[count($parts)-1] ?>)</small></span>
  </li>
</ul>
<hr class="mdc-list-divider">
<?php endif;?>
<ul class="mdc-list mdc-list--two-line">
  <?php
  $files = scandir($root);?>

    <?php
  foreach ($files as $file): ?>
  <?php if ($file != "." && $file != ".."): ?>
  <?php

  $type = mime_content_type($root . "/" . $file);
  if ($type != "directory") {
    $size = filesize($root . "/" . $file);
    if ($size > 1024) {
        if ($size > (1024 * 1024)) {
            if ($size > (1024 * 1024 * 1024)) {
                if ($size > (1024 * 1024 * 1024 * 1024)) {
                    $sizep = round($size / (1024 * 1024 * 1024 * 1024)) . " Tio";
                } else {
                    $sizep = round($size / (1024 * 1024 * 1024)) . " Gio";
                }
            } else {
                $sizep = round($size / (1024 * 1024)) . " Mio";
            }
        } else {
            $sizep = round($size / 1024) . " Kio";
        }
    } else {
        if ($size > 1) {
            $sizep = ($size) . " octets";
        } else {
            $sizep = ($size) . " octet";
        }
    }
  } else {
    $size = count(scandir($root . "/" . $file)) - 2;
    if ($size > 1) {
        $sizep = $size . " éléments";
    } else {
        $sizep = $size . " élément";
    }
  }

    switch ($type) {
        case 'directory':
            $icon = "folder";
            $pretty = "Dossier";
            break;
        case 'text/plain':
            $icon = "text_snippet";
            $pretty = "Fichier texte";
            break;
        case 'application/octet-stream':
            $icon = "help_center";
            $pretty = "Fichier binaire";
            break;
        case 'application/x-abiword':
            $icon = "description";
            $pretty = "Document texte";
            break;
        case 'application/msword':
            $icon = "description";
            $pretty = "Document texte";
            break;
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            $icon = "description";
            $pretty = "Document texte";
            break;
        case 'application/vnd.oasis.opendocument.text':
            $icon = "description";
            $pretty = "Document texte";
            break;
        case 'application/rtf':
            $icon = "description";
            $pretty = "Document texte";
            break;
        case 'application/pdf':
            $icon = "description";
            $pretty = "Document texte";
            break;
        case 'application/vnd.oasis.opendocument.presentation':
            $icon = "analytics";
            $pretty = "Présentation";
            break;
        case 'application/vnd.ms-powerpoint':
            $icon = "analytics";
            $pretty = "Présentation";
            break;
        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
            $icon = "analytics";
            $pretty = "Présentation";
            break;
        case 'application/vnd.visio':
            $icon = "analytics";
            $pretty = "Présentation";
            break;
        case 'application/vnd.amazon.ebook':
            $icon = "book";
            $pretty = "Livre électronique";
            break;
        case 'application/epub+zip':
            $icon = "book";
            $pretty = "Livre électronique";
            break;
        case 'application/x-freearc':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/x-bzip':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/vnd.rar':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/x-bzip2':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/x-tar':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/x-7z-compressed':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/zip':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/gzip':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'text/x-mup':
            $icon = "archive";
            $pretty = "Archive";
            break;
        case 'application/x-cd-image':
            $icon = "album";
            $pretty = "Image de disque";
            break;
        case 'application/x-cshell':
            $icon = "request_quote";
            $pretty = "Script";
            break;
        case 'application/x-sh':
            $icon = "request_quote";
            $pretty = "Script";
            break;
        case 'application/vnd.ms-fontobject':
            $icon = "font_download";
            $pretty = "Typographie";
            break;
        case 'font/otf':
            $icon = "font_download";
            $pretty = "Typographie";
            break;
        case 'font/ttf':
            $icon = "font_download";
            $pretty = "Typographie";
            break;
        case 'font/woff':
            $icon = "font_download";
            $pretty = "Typographie";
            break;
        case 'font/woff2':
            $icon = "font_download";
            $pretty = "Typographie";
            break;
        case 'text/css':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'text/javascript':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'application/json':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'application/ld+json':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'text/html':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'text/xml':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'application/xml':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'application/xhtml+xml':
            $icon = "code";
            $pretty = "Code source";
            break;
        case 'text/calendar':
            $icon = "event";
            $pretty = "Calendrier";
            break;
        case 'application/java-archive':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/vnd.apple.installer+xml':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/x-ms-dos-executable':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/x-msi':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/vnd.android.package-archive':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/x-sharedlib':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/x-shockwave-flash':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'application/vnd.mozilla.xul+xml':
            $icon = "open_in_browser";
            $pretty = "Exécutable";
            break;
        case 'text/csv':
            $icon = "table_view";
            $pretty = "Feuille de calcul";
            break;
        case 'application/ogg':
            $icon = "headset";
            $pretty = "Fichier audio";
            break;
        case 'application/vnd.oasis.opendocument.spreadsheet':
            $icon = "table_view";
            $pretty = "Feuille de calcul";
            break;
        case 'application/vnd.ms-excel':
            $icon = "table_view";
            $pretty = "Feuille de calcul";
            break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            $icon = "table_view";
            $pretty = "Feuille de calcul";
            break;

    default:
            $icon = "insert_drive_file";
            $pretty = "Fichier";
            break;
  }

  if (substr($type, 0, 6) == "audio/") {
    $icon = "headset";
    $pretty = "Fichier audio";
  }

  if (substr($type, 0, 6) == "video/") {
    $icon = "videocam";
    $pretty = "Fichier vidéo";
  }

  if (substr($type, 0, 6) == "image/") {
    $icon = "insert_photo";
    $pretty = "Image";
  }

  ?>
    <li <?php if (substr($file, 0, 1) == "."): ?>
        style='opacity:.5;'
    <?php endif; ?>
    <?php if ($type == "directory"): ?>
        onclick='location.href = "/net.familine.EditorsCloud/content/files.php?url=<?= base64_encode($rootp . '/' . $file) ?>";'
    <?php else: ?>
        onclick='window.open("/net.familine.EditorsCloud/download/?url=<?= base64_encode($rootp . '/' . $file) ?>");document.body.focus();'
    <?php endif; ?> class="mdc-list-item" tabindex="0">
    <span class="mdc-list-item__ripple fshow"></span>
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true"><?= $icon ?></i>
    <span class="mdc-list-item__text">
      <span class="mdc-list-item__primary-text"><?= $file ?></span>
      <span class="mdc-list-item__secondary-text"><?= $pretty ?> (<?= $sizep ?><?php if (substr($file, 0, 1) == "."): ?>, masqué<?php endif; ?>)</span>
    </span>
  </li>
  <?php endif; ?>
  <?php endforeach; ?>
</ul>
</div>
<script>

window.onbeforeunload = () => {
    window.parent.document.getElementById('content').style.display = "none";
    window.parent.document.getElementById('loader').style.display = "";
}

</script>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.EditorsCloud/private/Footer.php"; ?>
