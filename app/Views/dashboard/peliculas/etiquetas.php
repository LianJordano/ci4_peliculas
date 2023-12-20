<?php echo $this->extend("dashboard/plantilla/app") ?>

<?php echo $this->section("contenido") ?>


<div class="container">

    <h1 class="display-5 mt-3"><?= $titulo ?></h1>

    <div class="card p-4">

        <form action="<?= base_url("dashboard/pelicula/etiquetas_post/$pelicula->id") ?>" method="post">

            <div class="mb-3">
                <label for="" class="form-label">Categoría</label>
                <select class="form-select form-select-lg" name="categoria_id" id="categoria_id">
                    <option selected disabled>-- Seleccione --</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option <?= $categoria->id != $categoria_id ?: "selected" ?> value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Etiquetas</label>
                <select class="form-select form-select-lg" name="etiqueta_id" id="etiqueta_id">
                    <option selected disabled>-- Seleccione --</option>
                    <?php foreach ($etiquetas as $etiqueta) : ?>
                        <option value="<?= $etiqueta->id ?>"><?= $etiqueta->titulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>



            <button type="submit" class="btn btn-primary" style="float: right;" id="send" disabled>
                Enviar
            </button>

        </form>
    </div>
</div>


<script>
    function disabledEnabledButton() {
        document.querySelector("#etiqueta_id").addEventListener("change", function() {
            if (this.value === "") {
                document.querySelector("#send").setAttribute("disabled", true);
            } else {
                document.querySelector("#send").removeAttribute("disabled");
            }
        });
    }

    document.querySelector("[name=categoria_id]").onchange = function(e) {
        window.location.href = "<?= route_to("dashboard/pelicula/etiquetas/" . $pelicula->id) ?>?categoria_id=" + this.value;
    }


    disabledEnabledButton();
</script>




</div>

<?php echo $this->endSection() ?>