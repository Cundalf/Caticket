<? defined('BASEPATH') or exit('No direct script access allowed'); ?>

<main role="main" class="container animated fadeIn" style="padding-bottom: 0;">
	<div class="login">
		<i class="fas fa-paw fa-5x text-danger"></i>
		<h4>CATICKET</h4>
		<i>Ingrese su usuario y email</i>

		<form action="<?= base_url("user/forgot_password") ?>" method="POST">
			<? if (validation_errors()) : ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<?= validation_errors() ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<? endif; ?>
			
			<? if (isset($error)) : ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<?= $error ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<? endif; ?>
			
			<? if (isset($ok)) : ?>
				<div class="alert alert-success fade show" role="alert">
					Se envio un correo electronico con los pasos necesarios para restablecer la contraseña <br />
					<a href="<?=base_url() ?>">Volver</a>
				</div>
			<? else: ?>

				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				<div class="row">
					<div class="form-group" style="margin-bottom: 5px; margin-top: 5px;">
						<input type="text" class="form-control" name="username" placeholder="Usuario">
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="Email">
					</div>
				</div>

				<div class="row">
					<button type="submit" class="btn btn-danger btn-block">Restablecer Contraseña</button>
				</div>

			<? endif; ?>
		</form>
		<span>&copy; <?= date("Y"); ?> Sistemas</span>
	</div>
</main>