<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($titulo) ? $titulo : "" ?></title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
 <link rel="stylesheet" href="<?= base_url("bootstrap/bootstrap-5.3.2-dist/css/bootstrap.min.css") ?>">
</head>

<body>

    <?php echo $this->include("dashboard/plantilla/menu") ?>



    <?php echo $this->renderSection("contenido"); ?>

    <script src="<?= base_url("bootstrap/bootstrap-5.3.2-dist/js/bootstrap.min.js") ?>"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <?php echo $this->renderSection("scripts"); ?>

</body>

</html>