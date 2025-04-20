<?php $_TITLE = "Espace accueil"; require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/private/header.php"; ?>
<div id="intro" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#intro" data-slide-to="0" class="active"></li>
        <li data-target="#intro" data-slide-to="1"></li>
        <li data-target="#intro" data-slide-to="2"></li>
        <li data-target="#intro" data-slide-to="3"></li>
        <li data-target="#intro" data-slide-to="4"></li>
        <li data-target="#intro" data-slide-to="5"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div style="background-image: url('/net.familine.Famipun/carousel/1.png');" class="carousel-item active">
            <div class="carousel-caption">
                <h3>Chacun son espace</h3>
                <p>Chaque membre dispose de son propre espace personnel qu'il peut organiser et personnaliser selon ses envies.</p>
            </div>
        </div>
        <div style="background-image: url('/net.familine.Famipun/carousel/2.png');" class="carousel-item">
            <div class="carousel-caption">
                <h3>Panneau de contrôle</h3>
                <p>Ayez un aperçu simple et concret de tout ce que vous devez faire. Gardez un œil sur les prochains évènements et gérer les incidents en cours.</p>
            </div>
        </div>
        <div style="background-image: url('/net.familine.Famipun/carousel/3.png');" class="carousel-item">
            <div class="carousel-caption">
                <h3>La sécurité avant tout</h3>
                <p>Vous êtes fortement encouragé à utiliser un code PIN en plus de votre mot de passe pour une meilleure sécurité.</p>
            </div>
        </div>
        <div style="background-image: url('/net.familine.Famipun/carousel/4.png');" class="carousel-item">
            <div class="carousel-caption">
                <h3>Planning, emploi du temps et événements</h3>
                <p>Chaque chôse en son temps. Famipun vous aide à gérer les différents évènements et tâches de la famille, et peut même vous rappeler en cas de besoin.</p>
            </div>
        </div>
        <div style="background-image: url('/net.familine.Famipun/carousel/5.png');" class="carousel-item">
            <div class="carousel-caption">
                <h3>Informations additionnelles</h3>
                <p>Famipun est conçu pour s'ajouter à Famiwiki. Il fournit plus d'informations, essentiellement centrées sur toute la famille plutôt qu'une personne précise.</p>
            </div>
        </div>
        <div style="background-image: url('/net.familine.Famipun/carousel/6.png');" class="carousel-item">
            <div class="carousel-caption">
                <h3>Contrôle absolu</h3>
                <p>En utilisant Famipun, vous restez maître de vos données et de l'utilisation que nous en faisons.</p>
            </div>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#intro" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#intro" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/net.familine.Famipun/private/footer.php"; ?>