<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">


    <div class="card mt-5">
        <h2 class="p-3"><?= $categoria->id ?></h2>
        <div class="card-body">
            <p><?= $categoria->nombre ?></p>
        </div>
    </div>







</div>

<?php echo $this->endSection() ?>