<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h1 class="display-5 mt-3"><?= $titulo ?></h1>

    <div class="card mt-5">
        <div class="card-body">

            <form action="<?php echo base_url('dashboard/categoria/create'); ?>" method="post">


                <?php
                    echo view("dashboard/plantilla/_formCategoria", ["operacion" => "Crear"]);
                ?>

            </form>

        </div>
    </div>







</div>

<?php echo $this->endSection() ?>