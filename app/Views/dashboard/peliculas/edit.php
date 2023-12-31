<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>


<div class="container">

    <h2 class="p-3"><?= $titulo ?></h2>
    
    <?= view("partials/_form-errors") ?>

    <div class="card mt-5">

        <div class="card-body">

            <form enctype="multipart/form-data" action="<?php echo base_url('dashboard/pelicula/update/' . $pelicula->id); ?>" method="post">

                <?php 
                   echo view("dashboard/plantilla/_formPelicula",["operacion" => "Editar"]);
                ?>

            </form>

        </div>
    </div>







</div>

<?php echo $this->endSection() ?>