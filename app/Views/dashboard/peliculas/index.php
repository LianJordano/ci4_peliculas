<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h1 class="display-5 mt-3"><?= $titulo ?></h1>

    <div class="card p-4">

        <div class="table-responsive">
            <a class="btn btn-success m-2" href="<?php echo base_url('dashboard/pelicula/new/'); ?>">Crear Película</a>

            <?= view("partials/_session") ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th colspan="4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peliculas as $pelicula) : ?>
                        <tr class="">
                            <td><?= $pelicula->id ?></td>
                            <td><?= $pelicula->titulo ?></td>
                            <td><?= $pelicula->descripcion ?></td>
                            <td><?= $pelicula->categoria ?></td>
                            <td style="width: 10px;">
                                <a href="<?php echo base_url('dashboard/pelicula/show/' . $pelicula->id); ?>" class="btn btn-info">Mostrar</a>
                            </td>
                            <td style="width: 10px;">
                                <a href="<?php echo base_url('dashboard/pelicula/edit/' . $pelicula->id); ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td style="width: 10px;">
                                <a href="<?php echo base_url('dashboard/pelicula/etiquetas/' . $pelicula->id); ?>" class="btn btn-secondary">Etiquetas</a>
                            </td>
                            <td style="width: 10px;">
                                <form action="<?php echo base_url('dashboard/pelicula/delete/' . $pelicula->id); ?>" method="post">
                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <div class="pagination">
                <?php echo $pager->links() ?>
            </div>
        </div>


    </div>

</div>

<?php echo $this->endSection() ?>