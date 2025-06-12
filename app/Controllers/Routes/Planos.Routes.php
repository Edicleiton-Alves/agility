<?php 

$app->get('/load/planos', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Views'] . 'dashboard/Loads/Planos/Planos.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->get('/load/cadastroPlan', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Views'] . 'dashboard/Loads/Planos/Cadastro_Plano.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->get('/load/cadSva', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Views'] . 'dashboard/Loads/Planos/Cadastro_SVA.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->get('/request/Sva/:id', function ($id) {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'SVA/Verificar_SVA.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->get('/request/Plano/:id', function ($id) {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Plano/Buscar_Plano.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->post('/request/Sva', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'SVA/Adicionar_Sva.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->post('/request/Plano', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Plano/Adicionar_Plano.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->post('/altera/Sva', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'SVA/Editar_SVA.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->put('/request/Plano', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Plano/Editar_Plano.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->delete('/request/Sva', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'SVA/Deletar_Sva.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});

$app->delete('/request/Plano', function () {
	if (AUTH['status'] == 'success') {
		require PATH['Requests'] . 'Plano/Deletar_Plano.php';
	} else {
		echo "<script> window.location = '/';</script>";
	}
});