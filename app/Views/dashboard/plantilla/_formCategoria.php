<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= old("nombre",$categoria->nombre) ?>" />
</div>

<button type="submit" class="btn btn-primary" style="float: right;">
    <?= $operacion ?>
</button>