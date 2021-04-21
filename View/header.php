<header>
  <nav class="navbar navbar-expand-lg navbar-dark static-top" style="background-color: #000080;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php?page=main">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=exercice">Mes exercices</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=dashboard">Tableau de bord</a>
        </li>
      </ul>
      <span class="navbar-text">
    <form method="POST" action="index.php?page=login">
      <button type="submit" class="btn btn-light" name="disconnect">Se déconnecter</button> 
    </form>
      </span>
    </div>
  </nav>
</header>