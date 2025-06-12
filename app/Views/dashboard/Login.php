<?php

$_SESSION['TOKEN'] = md5('agltDash');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="theme-color" content="#f8f9fa">
	<meta name="apple-mobile-web-app-status-bar-style" content="#f8f9fa">
	<meta name="msapplication-navbutton-color" content="#f8f9fa">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/img/favicon.png" type="image/x-icon">
	<title>Admin | Agility Telecom</title>
	<link rel="manifest" href="/manifest/manifest.json">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<style>
	.bgDash {
		background: linear-gradient(to left, rgb(44 64 0), #114c00)
	}
</style>

<body class="bgDash">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 d-none d-md-block">
				<div class="d-flex vh-100">
					<div class="m-auto">
						<div class="d-flex mb-5 justify-content-center mx-auto">
							<?php require 'img/logo.svg'; ?>
						</div>
						<div class="d-flex">
							<img class="w-100" src="img/agltDraw.svg" alt="ilustração">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="d-flex vh-100">
					<div class="offset-md-3 col-md-6 m-auto">
						<div class="d-flex mb-5 d-md-none">
							<img src="img/logo.svg" class="w-50 mx-auto" alt="logo">
						</div>
						<div class="bg-white rounded-4 p-4">
							<form action="" id="login">
								<div class="mb-4 mt-4 mx-2 form-floating">
									<input id="email" type="text" class="form-control" name="email" placeholder="name@example.com" autocomplete="username">
									<label for="email" class="text-secondary"><i class="bi bi-envelope-at-fill"></i> Seu Email</label>
								</div>
								<div class="mb-5 mx-2 form-floating">
									<input id="senha" type="password" name="senha" class="form-control" placeholder="Sua_senha@123" autocomplete="current-password">
									<label for="senha" class="text-secondary"><i class="bi bi-lock-fill"></i> Sua Senha</label>
									<div class="mt-3 fw-bold invalid-feedback"></div>
								</div>
								<div class="mb-4 mx-2">
									<button type="submit" class="btnLogin shadow fw-bold btn btn-lg btn-primary w-100">Entrar</button>
								</div>
							</form>
							<p class="text-center d-none">
								<button type="button" class="modalEsqSen btn btn-link fw-medium text-body-secondary" modal-target="#modalEsqSen">
									Esqueci minha senha
								</button>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="position-fixed top-0 end-0 mt-3 m-3" style="z-index: 1500;">
		<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body"></div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>
	<?php
	require_once 'Loads/Recuperar/Modais/Modal_Recuperacao.php';
	?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<script type="text/javascript">
		"use strict";

		$(document).ready(() => {
			$('#login').submit(function(e) {
				e.preventDefault();
				$('.btnLogin').addClass('disabled').html('<div class="position-relative"><div class="position-absolute end-0 spinner-border text-light" role="status"></div></div> Entrando...');
				$.ajax({
					url: '/login',
					type: 'post',
					dataType: 'json',
					data: $('#login').serialize(),
					success: function(result) {
						if (result.status == 'success') {
							window.location.href = result.redirect;
						} else {
							$('.btnLogin').removeClass('disabled').html('Entrar');
							$('.invalid-feedback').html(result.msg).show();
						}
					},
					error: function(e) {
						$('.btnLogin').removeClass('disabled').html('Entrar');
						$('.invalid-feedback').html('Erro interno: Tente novamente mais tarde').show();
					}
				});
			});

			$('.modalEsqSen').click(function() {
				let modal = $(this).attr('modal-target');
				$(modal + ' form')[0].reset();
				$(modal).modal('show');
			});

			$('#formRecuperarSenha').submit(function(e) {
				e.preventDefault();

				let $form = $(this);
				let $btn = $form.find('button[type="submit"]');
				let btnSubmitText = $btn.html();

				$btn.prop('disabled', true).html('Enviando... <div class="spinner-border text-light" role="status" style="width: 20px; height: 20px"></div>');

				let modalAtual = '#' + $form.closest('.modal').attr('id');
				let form = this;
				let reload = $form.attr('reload');

				envForm.setForm(form);

				setTimeout(() => {
					let dados = envForm.request();

					if (dados.status === 'success') {
						$btn.html(btnSubmitText);

						toast(dados.status, dados.msg);

						setTimeout(function() {
							$(modalAtual).modal('hide');
							form.reset();
							$btn.prop('disabled', false);
							$('#modalConfCod').modal('show');
						}, 5000);
					} else {
						$btn.prop('disabled', false).html(btnSubmitText);
						toast(dados.status, dados.msg);
					}
				}, 50);
			});

			$('#formConfirmarCodigo').submit(function(e) {
				e.preventDefault();

				let $form = $(this);
				let $btn = $form.find('button[type="submit"]');
				let btnSubmitText = $btn.html();

				$btn.prop('disabled', true).html('Conferindo... <div class="spinner-border text-light" role="status" style="width: 20px; height: 20px"></div>');

				let modalAtual = '#' + $form.closest('.modal').attr('id');
				let form = this;
				let reload = $form.attr('reload');

				envForm.setForm(form);

				setTimeout(() => {
					let dados = envForm.request();

					if (dados.status === 'success') {
						$btn.html(btnSubmitText);

						toast(dados.status, dados.msg);
						$('#modalNovaSenha #edit').val(dados.user);

						setTimeout(function() {
							$(modalAtual).modal('hide');
							form.reset();
							$btn.prop('disabled', false);
							$('#modalNovaSenha').modal('show');
						}, 5000);
					} else {
						$btn.prop('disabled', false).html(btnSubmitText);
						toast(dados.status, dados.msg);
					}
				}, 50);
			});

			$('#formNovaSenha').submit(function(e) {
				e.preventDefault();

				let $form = $(this);
				let $btn = $form.find('button[type="submit"]');
				let btnSubmitText = $btn.html();

				$btn.prop('disabled', true).html('Conferindo... <div class="spinner-border text-light" role="status" style="width: 20px; height: 20px"></div>');

				let modalAtual = '#' + $form.closest('.modal').attr('id');
				let form = this;
				let reload = $form.attr('reload');

				envForm.setForm(form);

				setTimeout(() => {
					let dados = envForm.request();

					if (dados.status === 'success') {
						$btn.html(btnSubmitText);

						toast(dados.status, dados.msg);

						setTimeout(function() {
							$(modalAtual).modal('hide');
							form.reset();
							$btn.prop('disabled', false);
						}, 5000);
					} else {
						$btn.prop('disabled', false).html(btnSubmitText);
						toast(dados.status, dados.msg);
					}
				}, 50);
			});

			function toast($status, $msg) {
				if ($status == 'success') {
					$('.toast-body').html($msg);
					$('.toast').removeClass('text-bg-danger').addClass('text-bg-success').toast('show');
				} else {
					$('.toast-body').html($msg);
					$('.toast').removeClass('text-bg-success').addClass('text-bg-danger').toast('show');
				}
			}

			function sendForm() {
				this.action;
				this.method;
				this.data;
				this.param;

				this.getter = function(getter) {
					return this[getter];
				};

				this.setForm = function(form) {
					this.action = $(form).attr('action');
					this.method = $(form).attr('method');
					if (this.method == 'post') {
						this.data = new FormData(form);
					} else {
						this.data = $(form).serialize();
					}
				};

				this.resetForm = function() {
					this.action = '';
					this.method = '';
					this.data = '';
					this.param = '';
				};

				this.request = function() {
					let result;
					$.ajax({
						url: this.action,
						type: this.method,
						dataType: 'json',
						data: this.data,
						async: false,
						contentType: false,
						processData: false,
						success: function(r) {
							result = r;
						},
						error: function(r) {
							result = {
								status: 'error',
								msg: 'Erro Interno!'
							};
						}
					});
					return result;
				}

				this.get = function(action, param) {
					this.resetForm();
					this.action = action + '/' + param;
					this.method = 'get';
					this.param = param;
					return this.request();
				};
			}

			const envForm = new sendForm();

			function desenDado(dado) {
				return result = envForm.get('/load/cod', dado);
			}

		});
	</script>
</body>

</html>