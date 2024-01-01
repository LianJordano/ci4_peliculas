<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h1 class="display-5 mt-3"><?= $titulo ?></h1>

    <div style="display: flex; width: 100%; border-radius:10px" class="mb-3 bg-dark p-5">
        <form action="" method="get" style="display: flex; flex: 1;">
            <select class="form-control" name="categoria_id" id="categoria_id" style="flex: 1; margin-right: 5px;">
                <option value=""  selected>Categorías...</option>
            </select>
            <select class="form-control" name="etiqueta_id" id="etiqueta_id" style="flex: 1; margin-right: 5px;">
                <option value=""  selected>Etiquetas...</option>
            </select>
            <input class="form-control" style="flex: 1; margin-right: 5px;" type="text" name="buscar" id="buscar" placeholder="Buscar...">
            <input type="submit" value="Enviar" class="btn btn-sm btn-info">
        </form>
    </div>


    <div class="card p-4">
        <div class="row">

            <?php foreach ($peliculas as $pelicula) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card p-4">
                        <h4><?= $pelicula->titulo; ?></h4>
                        <p><?= $pelicula->descripcion; ?></p>
                        <a class="btn btn-dark" style="width: 100px;" href="<?php echo base_url("blog/pelicula/$pelicula->id") ?>">Ver...</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="pagination">
            <?php echo $pager->links() ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>