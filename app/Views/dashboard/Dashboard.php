<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="theme-color" content="#25324f">
	<meta name="apple-mobile-web-app-status-bar-style" content="#25324f">
	<meta name="msapplication-navbutton-color" content="#25324f">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/img/favicon.png" type="image/x-icon">
	<title>Login - Administrativo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style type="text/css">
		<?php
		require_once 'Assets/Style.css';
		?>
	</style>
</head>

<body class="d-flex flex-column vh-100">
	<div class="row mb-3 d-md-none bg-plan text-white">
		<div class="col-2 h-auto d-flex pe-0 justify-content-end">
			<button class="my-auto btn bg-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#subMenu" aria-controls="subMenu">
				<span class="text-dark bi bi-list fs-5"></span>
			</button>
		</div>
		<div class="col-9 offset-md-1 col-md-10 my-3 d-flex justify-content-center m-auto">
			<div class="w-75">
				<?php require 'img/logo.svg'; ?>
			</div>
		</div>
	</div>
	<div class="offcanvas offcanvas-start bg-plan" data-bs-backdrop="false" tabindex="-1" id="subMenu" aria-labelledby="subMenuLabel">
		<div class="d-md-none" style="z-index: 1060;">
			<button type="button" class="position-absolute z-3 end-0 btn text-white" data-bs-dismiss="offcanvas" aria-label="Close">
				<i class="bi bi-x-square-fill display-2"></i>
			</button>
		</div>
		<div class="offcanvas-body">
			<nav class="menu-lateral bg-plan text-white position-fixed h-100 d-flex flex-column p-2 px-0 mx-md-0 mx-5 nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<div class="position-sticky top-0 bgDash">
					<div class="position-absolute top-0 end-0 m-2">
						<button id="toggleFixar" class="btn btn-sm btn-outline-light p-1 btn-somente-visivel">
							<i class="bi bi-pin" id="iconeFixar"></i>
						</button>
					</div>
					<div class="offset-1 col-10 mx-auto d-flex justify-content-center mb-2">
						<img src="img/agLg.svg" class="w-75 logo_menu" id="logoImage">
					</div>
					<p class="text-white text-center greeting-text">
						Olá, <b class="text-capitalize text-white"><?= $_SESSION['ADMIN']['usuario'] ?></b>
					</p>
				</div>
				<ul class="nav flex-column ms-2">
					<li class="nav-item">
						<button data-load="pills" class="nav-link text-white d-flex align-items-center active w-100" id="v-pills-planos-tab" data-content='planos' data-bs-toggle="pill" data-bs-target="#v-pills-planos" type="button" role="tab" aria-controls="v-pills-planos" aria-selected="true">
							<i class="bi bi-file-earmark-spreadsheet-fill"></i>
							<span>Planos</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-load="pills" class="nav-link text-white d-flex align-items-center w-100" id="v-pills-configuracoes-tab" data-content='configuracoes' data-bs-toggle="pill" data-bs-target="#v-pills-configuracoes" type="button" role="tab" aria-controls="v-pills-configuracoes" aria-selected="true">
							<i class="bi bi-gear-fill"></i>
							<span>Configurações</span>
						</button>
					</li>
					<li class="nav-item mt-auto">
						<a class="nav-link d-flex align-items-center" href="logout" type="button">
							<i class="text-warnig  bi bi-box-arrow-left"></i>
							<span class="text-warnig ">Sair</span>
						</a>
					</li>
				</ul>
				<div class="position-absolute bottom-0 start-0 w-100 text-center p-3 text-white">
					<h6>V. <?= VERSION ?></h6>
				</div>
			</nav>
		</div>
	</div>
	<main class="flex-grow-1">
		<div class="rounded-2 bg-white shadow-lg py-3 h-100">
			<div class="tab-content h-100" id="v-pills-tabContent">
				<div class="container-fluid h-100 tab-pane fade show active" id="v-pills-planos" role="tabpanel" aria-labelledby="v-pills-planos-tab" tabindex="0">
					<div class="d-flex h-100">
						<div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div class="container-fluid h-100 tab-pane fade show" id="v-pills-configuracoes" role="tabpanel" aria-labelledby="v-pills-configuracoes-tab" tabindex="0">
					<div class="d-flex h-100">
						<div class="m-auto spinner-border text-warning" role="status" style="width: 6rem; height: 6rem;">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div class="position-fixed top-0 end-0 mt-3 m-3" style="z-index: 1500;">
		<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body"></div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript">
		<?php
		require_once 'Assets/Script.js';
		?>
	</script>
</body>

</html>