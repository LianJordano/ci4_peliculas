<?php echo $this->extend("web/plantilla/app") ?>

<?php echo $this->section("contenido") ?>

<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
				
					<div class="card shadow-lg my-5">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">Iniciar sesión</h1>

                            <?= view("partials/_session") ?>

							<form method="POST" action="<?= base_url("login_post") ?>" class="needs-validation" novalidate="" autocomplete="off" >
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="contrasena">Contraseña</label>
									</div>
									<input id="contrasena" type="password" class="form-control" name="contrasena" required>
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										Iniciar sesión
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								¿No tienes una cuenta? <a href="<?= base_url("register") ?>" class="text-dark">Crea una!</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; <?=date("Y")?> &mdash; Crudstaceo
					</div>
				</div>
			</div>
		</div>
	</section>


<?php echo $this->endSection() ?>