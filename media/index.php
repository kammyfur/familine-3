<?php $_TITLE = "Accueil"; require_once $_SERVER['DOCUMENT_ROOT'] . "/media/private/header.php"; ?>

<article style="margin-top:56px">
    <div class="jumbotron jumbotron-fluid" style="margin-bottom:0;">
        <div class="container">
            <h1>Famiload, des centaines d'heures de contenu</h1>
            <p>De 2013 à aujourd'hui, Famiload vous permet d'accéder à tout le contenu que Familine a produit, utilisé ou a été donné les droits d'utiliser (sous certaines conditions).</p>
            <p>Qu'il s'agisse de musiques, de films, de dessins ou de romans, tout le contenu de Familine est disponible sur Famiload, n'importe quand, n'importe où.</p>

            <div style="text-align: center;">
                → <a type="button" class="btn btn-success" href="/media/start">Commencer</a> ←
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top" style="top: 56px;text-align: center">
        <div style="text-align: center;width: 100%;display: flex;justify-content: center;">
            <ul class="navbar-nav" style="text-align: center;width: 100%;display: flex;justify-content: center;">
                <li id="intro-link-free" class="nav-item">
                    <a class="nav-link" href="#/intro/free">Gratuité</a>
                </li>
                <li id="intro-link-reliable" class="nav-item">
                    <a class="nav-link" href="#/intro/reliable">Fiabilité</a>
                </li>
                <li id="intro-link-fast" class="nav-item">
                    <a class="nav-link" href="#/intro/fast">Rapidité</a>
                </li>
                <li id="intro-link-quality" class="nav-item">
                    <a class="nav-link" href="#/intro/quality">Qualité</a>
                </li>
                <li id="intro-link-easy" class="nav-item">
                    <a class="nav-link" href="#/intro/easy">Simplicité</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="intro-box-free" class="jumbotron jumbotron-fluid">
        <div id="/intro/free" class="container">
            <h1>Gratuité</h1>
            <p>Il n'y a pas moins cher que gratuit !</p>
            <p>L'intégralité du contenu de Famiload vous est accessible gratuitement, dans l'espoir qu'il vous sera utile. Certaines ressources sont sous des licences libres (qui autorisent les modifications).</p>
            <p>Les utilisateur de Familine Plus pourront toutefois télécharger du contenu afin de le consulter même sans connexion Internet ou durant les maintenances du réseau.</p>
        </div>
    </div>
    <div id="intro-box-reliable" class="jumbotron jumbotron-fluid">
        <div id="/intro/reliable" class="container">
            <h1>Fiabilité</h1>
            <p>Du contenu toujours disponible.</p>
            <p>Lorsque du contenu est publié sur Famiload, il le reste pour toujours. Même les anciennes versions d'un contenu restent accessibles aux personnes le désirant.</p>
            <p>Cela vous permet de ne plus vous soucier de la disponibilité ou non d'un contenu et de ne pas vous forcer à le consulter en un temps limité.</p>
        </div>
    </div>
    <div id="intro-box-fast" class="jumbotron jumbotron-fluid">
        <div id="/intro/fast" class="container">
            <h1>Rapidité</h1>
            <p>Un chargement rapide.</p>
            <p>Nous savons tous à quel point il est désagréable de devoir attendre le chargement du contenu, voire pire : de devoir attendre le chargement de la suite du contenu.</p>
            <p>Nous essayons de précharger le plus possible de contenu, et de limiter sa qualité pour être sur que vous ne soyez pas interrompu.</p>
        </div>
    </div>
    <div id="intro-box-quality" class="jumbotron jumbotron-fluid">
        <div id="/intro/quality" class="container">
            <h1>Qualité</h1>
            <p>Du contenu de haute qualité, à votre portée.</p>
            <p>Lorsque votre connexion Internet est suffisamment performante, nous vous diffuseront le contenu dans la meilleure qualité possible, pour que vous puissiez en profiter au mieux.</p>
            <p>La recrudescence des écrans de plus en plus qualitatifs nous oblige à améliorer la qualité de nos contenus, tant pour les services en ligne que pour le reste. Nous faisons de notre mieux pour pousser à son plein potentiel les technologies que nous utilisons.</p>
        </div>
    </div>
    <div id="intro-box-easy" class="jumbotron jumbotron-fluid">
        <div id="/intro/easy" class="container">
            <h1>Simplicité</h1>
            <p>Asseyez-vous dans votre canapé et commencez !</p>
            <p>Ouvrez Famiload, cliquez sur un contenu, et profitez-en directement. Pas de paiement, pas de conditions à accepter, tout est disponible directement.</p>
            <p>Et si vous attendez un contenu en particulier, les producteurs peuvent annoncer la sortie prochaine d'un nouveau contenu.</p>
        </div>
    </div>
</article>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/media/private/footer.php"; ?>