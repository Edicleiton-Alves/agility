<?php
require_once 'defines/defines.php';

if (!in_array(METODO, METODOS_PERMITIDOS)) {

	header("HTTP/1.0 405 Method Not Allowed; charset=utf-8");
	$response = [
		'status' => 'error',
		'msg' => 'Método não permitido'
	];
	echo json_encode($response, JSON_UNESCAPED_UNICODE);

	exit;
}

require_once 'Classes/Autoload.php';

$auth = new Classes\Auth;
$auth = $auth->authSession('ACCESS_ADMIN', 'acesso_liberado', function ($e)
{
	return $e;
});

define('AUTH', $auth);

$app = new Classes\Routes;

$routes = glob(PATH['Controllers'].'Routes/*');

foreach ($routes as $route) {
	require_once $route;
}

$app->erro_404(function () // ROTA 404
{
	if (METODO == 'GET') {
		require PATH['Views'].'dashboard/Dashboard.php';
	}
	else if (in_array(METODO, ['POST', 'PUT', 'DELETE'])) {
		header("HTTP/1.0 404; charset=utf-8");
		$response = [
			'status' => 'error',
			'msg' => 'Rota não encontrada'
		];
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}
});