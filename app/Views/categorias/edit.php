<?php echo $this->extend("plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h2 class="p-3"><?= $titulo ?></h2>

    <div class="card mt-5">

        <div class="card-body">

            <form action="<?php echo base_url('categoria/update/' . $categoria->id); ?>" method="post">

                <?php 
                   echo view("plantilla/_formCategoria",["operacion" => "Editar"]);
                ?>

            </form>

        </div>
    </div>







</div>

<?php echo $this->endSection() ?>