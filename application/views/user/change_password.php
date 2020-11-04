<? defined('BASEPATH') or exit('No direct script access allowed'); ?>

<main role="main" class="container animated fadeIn" style="padding-bottom: 0;">
	<div class="login">
		<i class="fas fa-paw fa-5x text-danger"></i>
		<h4>CATICKET</h4>
		<i>Debe cambiar su contraseña para continuar</i>

		<form action="<?= base_url("user/change_password") ?>" method="POST">
			<?php if (validation_errors()) : ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<?= validation_errors() ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>
			<?php if (isset($error)) : ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<?= $error ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>

			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

			<div class="row">
				<div class="form-group" style="margin-bottom: 5px; margin-top: 5px;">
					<input type="password" class="form-control" name="pass" placeholder="Contraseña">
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<input type="password" class="form-control" name="rpass" placeholder="Repita Contraseña">
				</div>
			</div>

			<div class="row">
				<button type="submit" class="btn btn-danger btn-block">Cambiar Contraseña</button>
			</div>
		</form>
		<span>&copy; <?= date("Y"); ?> Sistemas</span>
	</div>
</main>