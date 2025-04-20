<?php $_TITLE = "Compte bancaire interne à Familine"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/header.php"; ?>
<center>
    <h1><?= number_format((float)$profile->credit, 2, ',', '') ?> €</h1>
    <a href="/net.familine.Faminey/credit/">Créditer le compte...</a>
</center>

<hr>

<div class="row">
    <div class="col-sm-4">
        <center>
            <h1>Avertissements</h1>
            <ul class="list-group">
                <?php if ($profile->credit < 0): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">Le solde de votre compte est négatif, veuillez le créditer le plus rapidement possible.</li>
                <?php $warned=true;endif; ?>
                <?php if ($profile->credit == 0): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">Le solde de votre compte est nul, commencez par y mettre un peu d'argent...</li>
                <?php $warned=true;endif; ?>
                <?php

                $problematic = [];
                $maybe = [];
                $topay = 0;
                $total = $profile->credit;

                foreach ($profile->subscriptions as $subscription) {
                    $topay = $topay + $subscription->cost;
                    if ($topay > $total) {
                        $problematic[] = $subscription->name;
                    }
                    if ($topay == $total) {
                        $maybe[] = $subscription->name;
                    }
                }

                if (count($problematic) != 0): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">Votre solde est insuffisant pour payer l'abonnement « <?= $problematic[0] ?> »<?php
                
                if (count($problematic) > 2) {
                    echo(", et " . (count($problematic) - 1) . " autres abonnements, qui se termineront donc à la fin de leurs périodes de facturation respectives.");
                } else if (count($problematic) > 1) {
                    echo(", et 1 autre abonnement, qui se termineront donc à la fin de leurs périodes de facturation respectives.");
                } else {
                    echo(", il se terminera donc à la fin de la période de facturation.");
                }
                
                ?></li>
                <?php $warned=true;endif;

                ?>
            </ul>
            <?php
            
            if (!isset($warned)) {
                echo("<p>Votre compte se porte très bien !</p>");
            }
            
            ?>
        </center>
    </div>
    <div class="col-sm-4">
        <center>
            <h1>Abonnements</h1>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    L'abonnement Familine Plus n'est plus disponible et n'est désormais plus prélevé sur votre compte Faminey.
                </li>
                <?php foreach ($profile->subscriptions as $subscription): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $subscription->name ?>
                    <span class="badge badge-primary badge-pill"><?= number_format((float)$subscription->cost, 2, ',', '') ?> € par <?php
                    
                    switch ($subscription->type) {
                        case 'month':
                            echo("mois");
                            break;

                        case 'year':
                            echo("an");
                            break;

                        case 'week':
                            echo("semaine");
                            break;

                        case 'day':
                            echo("jour");
                            break;

                        case 'hour':
                            echo("heure");
                            break;
                        
                        default:
                            echo($subscription->type);
                            break;
                    }

                    ?></span>
                </li>
                <?php endforeach; ?>
            </ul> 
        </center>
    </div>
    <div class="col-sm-4">
        <center>
            <h1>Anciennes transactions</h1>
            <ul class="list-group">
                <?php foreach ($profile->history as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div style="width:100%;"><?= $item->name ?> <small style="vertical-align:middle;">(<?php switch ($item->type) {
                        case 'auto':
                            echo("Renouvellement");
                            break;

                        case 'donate':
                            echo("Don");
                            break;

                        case 'onetime':
                            echo("Paiement unique");
                            break;

                        case 'code':
                            echo("Code cadeau");
                            break;

                        case 'recycle':
                            echo("Réutilisation");
                            break;
                        
                        default:
                            echo("Inconnu");
                            break;
                    }?>)</small></div><br><small>à <b><?= $item->to ?></b></small><br><small>le <b><?= $item->date ?></b></small>
                    <span class="badge badge-primary badge-pill"><?php
                    
                    if ($item->cost < 0) {
                        echo(number_format((float)$item->cost, 2, ',', ''));
                    } else {
                        echo("+" . number_format((float)$item->cost, 2, ',', ''));
                    }
                    
                    ?> €</span>
                </li>
                <?php endforeach; ?>
            </ul>
        </center>
    </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Faminey/private/footer.php"; ?>
