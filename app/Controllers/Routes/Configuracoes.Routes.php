<?php


$app->get('/load/configuracoes', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Views'] . 'dashboard/Loads/Configuracoes/Configuracoes.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->post('/request/users', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Configuracoes/Adicionar_Usuario.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->post('/request/conf', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Configuracoes/Adicionar_Configuracoes.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->post('/request/recuperarSenha', function () {
	require PATH['Requests'] . 'Configuracoes/RecuperarSenha_EnvioEmail.php';
});

$app->post('/request/confirmarCodigo', function () {
	require PATH['Requests'] . 'Configuracoes/RecuperarSenha_ValidarCod.php';
});

$app->post('/request/novaSenha', function () {
	require PATH['Requests'] . 'Configuracoes/RecuperarSenha_ValidarSenha.php';
});

$app->delete('/request/users/:id', function ($id) {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Configuracoes/Deletar_Usuario.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});
