<?php $_TITLE = "Le meilleur de la famille"; require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/header.php"; ?>

<div id="intro">
    <div id="intro-inner">
        <img src="/logos/plus/plus256.png" width="64px">
        <h2 style="margin-bottom:0;">Familine Plus</h2>
        <h5>Profitez du meilleur de la famille</h5><br>
        <?php if ($_PROFILE->subscription == 0): ?>
            <i>L'achat d'un nouvel abonnement n'est plus possible</i>
        <?php elseif ($_PROFILE->subscription < 4): ?>
            <a href="/plus/remove" id="remove" type="button" class="btn btn-danger">Résilier</a>
        <?php elseif ($_PROFILE->subscription >= 4): ?>
            <a href="/plus/remove" id="remove" type="button" class="btn btn-danger">Résilier</a>
        <?php endif; ?>
    </div>

    <div id="down">
        »
    </div>
</div>

<br><br>

<div id="content">
    <h1 id="compare">Comparez les offres</h1>
    <p>Cliquez sur le nom d'une fonctionnalité pour en savoir plus.</p>
    <table class="table-dark table table-striped">
        <thead>
            <tr>
                <th>Fonctionnalité</th>
                <th>Familine Standard</th>
                <th>Familine Plus Lite</th>
                <th>Familine Plus Pro</th>
                <th>Familine Plus Ultimate</th>
                <th>Familine Plus Dreams</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f1">Import de fichiers sur Famiwiki</a></td>
                <td>2 Mio</td>
                <td>5 Mio</td>
                <td>20 Mio</td>
                <td>256 Mio</td>
                <td>512 Mio</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f2">Stockage Editors Cloud</a></td>
                <td></td>
                <td></td>
                <td>128 Mio</td>
                <td>256 Mio</td>
                <td>512 Mio</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f3">Accès à Familine</a></td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f4">Conseils à l'équipe de rédaction Faminews</a></td>
                <td></td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f5">Accès à « Derrière les rideaux »</a></td>
                <td></td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f6">Protection de votre article Famiwiki</a></td>
                <td></td>
                <td></td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f7">Accès en écriture à Famiprods</a></td>
                <td></td>
                <td></td>
                <td>Oui</td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f8">Support technique rapide et professionnel</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f9">Tentez de gagner votre mois d'abonnement</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Oui</td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f10">Réductions et cadeaux</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Oui</td>
            </tr>
            <tr>
                <td><a class="link" data-toggle="modal" data-target="#modal-f11">Plus de chances de gagner aux tirages au sort</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Oui</td>
            </tr>
        </tbody>
    </table>

    <h2>Tarifs des abonnements</h2>
    <p>Familine propose 4 abonnements Familine Plus différents :
        <ul>
            <li><b>Familine Plus Lite</b>, au prix de 0,25 € par mois<?= $_PROFILE->subscription == 1 ? ", votre abonnement actuel" : "" ?></li>
            <li><b>Familine Plus Pro</b>, au prix de 0,50 € par mois<?= $_PROFILE->subscription == 2 ? ", votre abonnement actuel" : "" ?></li>
            <li><b>Familine Plus Ultimate</b>, au prix de 0,75 € par mois<?= $_PROFILE->subscription == 3 ? ", votre abonnement actuel" : "" ?></li>
            <li><b>Familine Plus Dreams</b>, au prix de 1,00 € par mois<?= $_PROFILE->subscription == 4 ? ", votre abonnement actuel" : "" ?></li>
        </ul>
    </p>
</div>

<div class="modal fade" id="modal-f1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Import de fichiers sur Famiwiki</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Taille maximale pour un seul fichier que vous pouvez importer sur Famiwiki. Ne s'applique que sur la page « Téléverser un fichier ». Toutes les autre sources d'import utiliseront le paramètre par défaut : 2 Mio.
                </p>
                <p>
                    <ul>
                        <li>2 Mio = 2,048 Mo</li>
                        <li>5 Mio = 5,12 Mo</li>
                        <li>20 Mio = 20,48 Mo</li>
                        <li>256 Mio = 262,144 Mo</li>
                        <li>512 Mio = 524,288 Mo</li>
                    </ul>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f2">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Stockage Editors Cloud</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Capacité de stockage Editors Cloud auquel vous avez accès, à partir de Familine Plus Pro. Familine Standard et Familine Plus Lite n'ont pas de stockage Editors Cloud.
                </p>
                <p>
                    Vous pouvez accéder en lecture seule aux fichiers via l'interface Web, et en lecture-écriture via un gestionnaire de fichiers compatible. Consultez la documentation de Editors Cloud pour en savoir plus.
                </p>
                <p>
                    <ul>
                        <li>2 Mio = 2,048 Mo</li>
                        <li>5 Mio = 5,12 Mo</li>
                        <li>20 Mio = 20,48 Mo</li>
                        <li>256 Mio = 262,144 Mo</li>
                        <li>512 Mio = 524,288 Mo</li>
                    </ul>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f3">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Accès à Familine</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Accès aux fonctionnalités de base des différents services de Familine. C'est gratuit et ça le restera toujours.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f4">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Conseils à l'équipe de rédaction Faminews</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Donnez de nouveaux « scoops » à la rédaction de Faminews afin d'améliorer le prochain numéro du quotidien familial.
                </p>
                <p>
                    Conseillez simplement des sujets ou un article entier et il sera incorporé dans le numéro du jour.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f5">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Accès à « Derrière les rideaux »</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Apprenez comment nous gérons Familine, une infrastructure complèxe mais qui doit rester fiable.
                </p>
                <p>
                    Cela vous permet d'en apprendre plus sur le fonctionnement du réseau de plus de 300 personnes, et de plus de 20 Go de données sur des dizaines de générations.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f6">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Protection de votre article Famiwiki</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Obtenez une protection permanente et efficace sur votre article Famiwiki (si vous en avez un) contre le vandalisme et les actions involontaires.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f7">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Accès en écriture à Famiprods</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Disposez d'un accès en écriture au site officiel de Famiprods, afin de modifier le contenu et améliorer la richesse du site.
                </p>
                <p>
                    Demandez vos identifiants d'accès au site de Famiprods (l'accès en écriture réquiert des identifiants supplémentaires)
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f8">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Support technique rapide et professionnel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Obtenez de l'aide rapidement (hors périodes de cours, devoirs, sorties, etc...) et efficacement, par des professionnels de Familine.
                </p>
                <p>
                    Demandez de l'aide sur un des forums de Famiwiki, ou appelez le <a class="link" href="tel:+33783284607">+33 (7) 8328 460 7</a>.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f9">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tentez de gagner votre mois d'abonnement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Chaque mois, Familine effectue un tirage au sort parmi les abonnés Familine Plus Ultimate et Familine Plus Dreams pour leur faire gagner leur mois d'abonnement.
                </p>
                <p>
                    Une personne qui gagne son mois d'abonnement se fera rembourser la somme payée ce mois-ci sur son compte Faminey.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f10">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Réductions et cadeaux</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Familine peut, occasionnellement, vous donner des cadeaux, des codes Faminey ou des réductions sur votre abonnement Faminey Plus Dreams.
                </p>
                <p>
                    Ces cadeaux vous seront offerts lors d'occasions spéciales, pour vous, pour nous ou pour tout le monde.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-f11">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Plus de chances de gagner aux tirages au sort</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>
                    Lorsque Familine organise des tirages aux sort, par exemple des tombolas ou des lotos, vous aurez plus de chances de gagner que les autres personnes.
                </p>
                <p>
                    Cela fonctionne en vous comptant comme 2 personnes au lieu d'une, et multiplie par deux vos chances de gagner.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/plus/private/footer.php"; ?>
