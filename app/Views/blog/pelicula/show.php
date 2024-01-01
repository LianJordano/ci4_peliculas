<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">


    <div class="card mt-5">
        <h2 class="p-3"><?= $pelicula->titulo ?></h2>
        <div class="card-body">
            <p><?= $pelicula->descripcion ?></p>
        </div>
    </div>



<?php echo $this->endSection() ?>