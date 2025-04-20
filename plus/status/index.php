<?php $_TITLE = "État de l'abonnement"; require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/header.php"; ?>

<div>
    <h2><center>Votre abonnement actuel est <b>
    <?php

        switch ($_PROFILE->subscription) {
            case 0:
                echo("Familine Standard");
                break;

            case 1:
                echo("Familine Plus Lite");
                break;

            case 2:
                echo("Familine Plus Pro");
                break;

            case 3:
                echo("Familine Plus Ultimate");
                break;

            case 4:
                echo("Familine Plus Dreams");
                break;
            
            default:
                echo("Familine Unknown");
                break;
        }

    ?>
    </b></center></h2>
    <ul>
        <li><b>Dernier renouvèlement automatique :</b> <?php
        
        if ($_PROFILE->last == null) {
            echo("jamais");
        } else {
            $parts = explode("-", $_PROFILE->last);
            echo($parts[2] . "/" . $parts[1] . "/" . $parts[0]);
        }
        
        ?></li>
        <li><b>Jour du renouvellement automatique :</b> <?php
        
        if ($_PROFILE->last == null) {
            echo("jamais");
        } else {
            $rnv = (int)$parts[2];
            if ($rnv == 1) {
                echo("1<sup>er</sup>");
            } else {
                echo($rnv . "<sup>ème</sup>");
            }
        }
        
        ?> jour du mois</li>
        <li><b>Abonnement précédemment acheté :</b> <?php
        
        if ($_PROFILE->prevent) {
            echo("oui");
        } else {
            echo("non");
        }
        
        ?></li>
        <li><b>Identifiants des reçus :</b> <ul>
            <?php foreach ($_PROFILE->receipts as $rec): ?>
                <li><code><?= $rec ?></code></li>
            <?php endforeach; ?>
        </ul></li>
    </ul>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/footer.php"; ?>