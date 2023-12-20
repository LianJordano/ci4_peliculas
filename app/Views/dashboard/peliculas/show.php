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
    <ul>
        <?php foreach ($imagenes as $imagen) : ?>
            <li><?= $imagen->imagen ?></li>
        <?php endforeach; ?>
    </ul>


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