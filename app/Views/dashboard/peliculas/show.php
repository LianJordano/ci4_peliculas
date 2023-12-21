<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">


    <div class="card mt-5">
        <h2 class="p-3"><?= $pelicula->titulo ?></h2>
        <div class="card-body">
            <p><?= $pelicula->descripcion ?></p>
        </div>
    </div>

    <h2>Imágenes</h2>


    <div class="row">
        <?php foreach ($imagenes as $imagen) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <img style="width: 100%; height: 400px;" src="<?= base_url('uploads/peliculas/') ?><?= $imagen->imagen ?>">
                
                <div style="display: flex; align-items: center; justify-content:center;gap:10px;">
                    <form action="<?= base_url("dashboard/pelicula/imagen_delete/$pelicula->id/$imagen->id") ?>" method="post">
                        <button class="btn btn-danger mt-2">Eliminar</button>
                    </form>
                    <form action="<?= base_url("dashboard/pelicula/imagen_descargar/$imagen->id") ?>" method="post">
                        <button class="btn btn-success mt-2">Descargar</button>
                    </form>
                </div>

            </div>
        <?php endforeach; ?>
    </div>



    <h2>Etiquetas</h2>

    <?= view("partials/_session") ?>

    <!-- 
    <ul>
        <?php foreach ($etiquetas as $etiqueta) : ?>
            <form action="<?= base_url("dashboard/pelicula/$pelicula->id/etiqueta/$etiqueta->id/delete") ?>" method="post">
                <button style="display: flex;"><?= $etiqueta->titulo ?></button>  
            </form>
        <?php endforeach; ?>
    </ul> -->

    <?php foreach ($etiquetas as $etiqueta) : ?>
        <button data-url="<?= base_url("dashboard/pelicula/$pelicula->id/etiqueta/$etiqueta->id/delete") ?>" class="deleteEtiqueta"><?= $etiqueta->titulo ?></button>
    <?php endforeach; ?>

</div>


<script>
    let etiquetas = document.querySelectorAll(".deleteEtiqueta");

    etiquetas.forEach(etiqueta => {
        etiqueta.onclick = (e) => {
            fetch(etiqueta.getAttribute("data-url"), {
                    method: "post"
                }).then(res => res.json())
                .then(res =>
                    window.location.reload(),
                )
        }
    });
</script>

<?php echo $this->endSection() ?>