<?php echo $this->extend("plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h2 class="p-3"><?= $titulo ?></h2>

    <div class="card mt-5">

        <div class="card-body">

            <form action="<?php echo base_url('pelicula/update/' . $pelicula->id); ?>" method="post">

                <?php 
                   echo view("plantilla/_formPelicula",["operacion" => "Editar"]);
                ?>

            </form>

        </div>
    </div>







</div>

<?php echo $this->endSection() ?>