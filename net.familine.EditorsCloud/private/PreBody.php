<header class="mdc-top-app-bar">
  <div class="mdc-top-app-bar__row">
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" data-pushbar-target="menu" aria-label="Ouvrir le menu" id="mobilemenu">menu</button>
      <img src="/logos/cloud/cloud128.png" alt="" class="logo" style="filter:contrast(0%) brightness(2000%) !important;">
      <span class="mdc-top-app-bar__title">Editors Cloud</span>
    </section>
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
    </section>
  </div>
</header>
<article class="content">
<aside class="mdc-drawer" data-pushbar-id="menu" data-pushbar-direction="left">
  <div class="mdc-drawer__content">
    <nav class="mdc-list">
    <a class="mdc-list-item mdc-list-item--activated" id="link-dashboard" onmouseup="home()" aria-current="page">
        <span class="mdc-list-item__ripple"></span>
        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">home</i>
        <span class="mdc-list-item__text">Tableau de bord</span>
      </a>
      <a class="mdc-list-item" id="link-files" onmouseup="files()" aria-current="page">
        <span class="mdc-list-item__ripple"></span>
        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">perm_media</i>
        <span class="mdc-list-item__text">Mes fichiers</span>
      </a>

      <hr class="mdc-list-divider">
      <h6 class="mdc-list-group__subheader">Compte</h6>
      <a class="mdc-list-item" id="link-storage" onmouseup="storage()" aria-current="page">
        <span class="mdc-list-item__ripple"></span>
        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">save</i>
        <span class="mdc-list-item__text">Stockage disponible</span>
      </a>
      <a class="mdc-list-item" id="link-renew" onmouseup="renew()">
        <span class="mdc-list-item__ripple"></span>
        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">monetization_on</i>
        <span class="mdc-list-item__text">Renouvèlement</span>
      </a>
      <a class="mdc-list-item" id="link-preferences" onmouseup="preferences()">
        <span class="mdc-list-item__ripple"></span>
        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">settings</i>
        <span class="mdc-list-item__text">Préférences</span>
      </a>
      <a class="mdc-list-item" id="link-about" onmouseup="about()">
        <span class="mdc-list-item__ripple"></span>
        <i class="material-icons mdc-list-item__graphic" aria-hidden="true">info</i>
        <span class="mdc-list-item__text">À propos de Editors Cloud</span>
      </a>
    </nav>
  </div>
</aside>
</article>
