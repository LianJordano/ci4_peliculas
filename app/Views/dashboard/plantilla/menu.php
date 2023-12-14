<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url("/dashboard/pelicula") ?>">Crud Peliculas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="<?= base_url("/dashboard/pelicula") ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Peliculas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url("/dashboard/pelicula") ?>">Listar</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url("/dashboard/pelicula/new") ?>">Crear</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="<?= base_url("/dashboard/categoria") ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorías
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url("/dashboard/categoria") ?>">Listar</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url("/dashboard/categoria/new") ?>">Crear</a></li>
          </ul>
        </li>
      </ul>
    
    </div>
  </div>
</nav>