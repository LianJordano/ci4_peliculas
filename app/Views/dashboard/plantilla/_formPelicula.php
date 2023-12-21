<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" class="form-control" name="titulo" id="titulo" value="<?= old("titulo", $pelicula->titulo) ?>" />
</div>

<div class="mb-3">
    <label for="" class="form-label">Categoría</label>
    <select class="form-select form-select-lg" name="categoria_id" id="categoria_id">
        <option selected disabled>-- Seleccione --</option>
        <?php foreach ($categorias as $categoria) : ?>
            <option <?= $categoria->id !== old("categoria_id", $pelicula->categoria_id) ?: "selected" ?> value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea class="form-control" name="descripcion" id="descripcion" rows="3"><?= old("descripcion", $pelicula->descripcion) ?></textarea>
</div>

<?php if ($pelicula->id) :  ?>
    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" class="form-control" name="imagen" id="imagen" />
    </div>
<?php endif;  ?>

<button type="submit" class="btn btn-primary" style="float: right;">
    <?= $operacion ?>
</button>