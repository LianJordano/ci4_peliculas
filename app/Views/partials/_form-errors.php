
<?php if (session("validation")) : ?>
    <div class="alert alert-info container mt-3" style="font-weight: bold;">
        <?= session("validation")->listErrors(); ?>
    </div>
<?php endif; ?>
