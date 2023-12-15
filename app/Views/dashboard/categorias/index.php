<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<div class="container">

    <h1 class="display-5 mt-3"><?= $titulo ?></h1>

    <div class="card p-4">

        <div class="table-responsive">
            <a class="btn btn-success m-2" href="<?php echo base_url('dashboard/categoria/new/'); ?>">Crear Categoría</a>

            <?=view("partials/_session") ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria) : ?>
                        <tr class="">
                            <td><?= $categoria->id ?></td>
                            <td><?= $categoria->nombre ?></td>
                            <td style="width: 10px;">
                                <a href="<?php echo base_url('dashboard/categoria/show/' . $categoria->id); ?>" class="btn btn-info">Mostrar</a>
                            </td>
                            <td style="width: 10px;">
                                <a href="<?php echo base_url('dashboard/categoria/edit/' . $categoria->id); ?>" class="btn btn-warning">Editar</a>
                            </td>
                            <td style="width: 10px;">
                                <form action="<?php echo base_url('dashboard/categoria/delete/' . $categoria->id); ?>" method="post">
                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>

</div>

<?php echo $this->endSection() ?>