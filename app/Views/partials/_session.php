
<?php if (session("mensaje")) : ?>
    <div class="alert alert-info" style="font-weight: bold;">
        <?= session("mensaje"); ?>
    </div>
<?php endif; ?>
