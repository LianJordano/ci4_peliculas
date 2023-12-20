<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" class="form-control" name="titulo" id="titulo" value="<?= old("titulo", $etiqueta->titulo) ?>" />
</div>

<div class="mb-3">
    <label for="" class="form-label">Categoría</label>
    <select class="form-select form-select-lg" name="categoria_id" id="categoria_id">
        <option selected disabled>-- Seleccione --</option>
        <?php foreach($categorias as $categoria): ?>
        <option <?=  $categoria->id !== old("categoria_id", $etiqueta->categoria_id) ?: "selected" ?> value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
        <?php endforeach; ?>
    </select>
</div>


<button type="submit" class="btn btn-primary" style="float: right;">
    <?= $operacion ?>
</button>