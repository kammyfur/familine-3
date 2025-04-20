<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

    <a class="navbar-brand" href="/media">Famiload</a>

    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Vidéos
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/media/latest/?t=vid">Derniers ajouts</a>
                <a class="dropdown-item" href="/media/trending/?t=vid">Contenu populaire</a>
                <a class="dropdown-item" href="/media/familine/?t=vid">Par Familine</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Images
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/media/latest/?t=img">Derniers ajouts</a>
                <a class="dropdown-item" href="/media/trending/?t=img">Contenu populaire</a>
                <a class="dropdown-item" href="/media/familine/?t=img">Par Familine</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Musique
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/media/latest/?t=mus">Derniers ajouts</a>
                <a class="dropdown-item" href="/media/trending/?t=mus">Contenu populaire</a>
                <a class="dropdown-item" href="/media/familine/?t=mus">Par Familine</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Documents
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/media/latest/?t=doc">Derniers ajouts</a>
                <a class="dropdown-item" href="/media/trending/?t=doc">Contenu populaire</a>
                <a class="dropdown-item" href="/media/familine/?t=doc">Par Familine</a>
            </div>
        </li>
        <li class="nav-item">
            <a style="display:inline-block;" class="nav-link disabled" href="/media/admin">Gérer...</a>
        </li>
    </ul>

    <div style="margin-left: auto;">
        <form action="/media/search" class="input-group mb-3" style="width: max-content;max-width: 512px;margin-bottom: 0 !important;">
            <input name="q" type="text" class="form-control" placeholder="Rechercher du contenu...">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Rechercher</button>
            </div>
        </form>
    </div>

</nav>