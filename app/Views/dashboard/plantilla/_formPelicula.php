<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" class="form-control" name="titulo" id="titulo" value="<?= $pelicula->titulo ?>" />
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea class="form-control" name="descripcion" id="descripcion" rows="3"><?= $pelicula->descripcion ?></textarea>
</div>

<button type="submit" class="btn btn-primary" style="float: right;">
    <?= $operacion ?>
</button>