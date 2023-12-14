<?php echo $this->extend("plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h1 class="display-5 mt-3"><?= $titulo ?></h1>

    <div class="card mt-5">
        <div class="card-body">

            <form action="<?php echo base_url('pelicula/create'); ?>" method="post">


                <?php
                    echo view("plantilla/_formPelicula", ["operacion" => "Crear"]);
                ?>

            </form>

        </div>
    </div>







</div>

<?php echo $this->endSection() ?>