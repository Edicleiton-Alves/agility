<?php
$conDB = new Classes\ConDB;
$getLogin = new Classes\Metodos($conDB);
$dateTime = new DateTime();

if (!isset($_SESSION['TOKEN']) || (isset($_SESSION['TOKEN']) && $_SESSION['TOKEN'] !== TOKEN )) {
	$response = [
		'status' => 'error',
		'msg' => 'Acesso inválido!',
	];
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	exit;
}

header('Content-Type: application/json; charset=utf-8');

if (!isset($_POST['email']) || !isset($_POST['senha'])) {
	$response = [
		'status' => 'error',
		'msg' => 'Email ou senha inválidos',
	];
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	exit;
}

if (empty($_POST['email']) || empty($_POST['senha'])) {
	$response = [
		'status' => 'error',
		'msg' => 'Os campos email e senha não podem estar vazios',
	];
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	exit; 
}

$dadosAuth = $getLogin
	->table('tb_sysadmin')
	->where('email', '=', $_POST['email'])
	->where('status','=',1)
	->get();

if (!empty($dadosAuth)) {
	if (password_verify($_POST['senha'], $dadosAuth[0]->senha)) {
		$_SESSION['ADMIN'] = [
			'id' => $dadosAuth[0]->id,
			'usuario' => $dadosAuth[0]->usuario,
			'email' => $dadosAuth[0]->email,
		];
		$_SESSION['ACCESS_ADMIN'] = 'acesso_liberado';

		$getLogin
			->table('tb_sysadmin')
			->set('ultimo_login', $dateTime->format('Y-m-d H:i:s'))
			->where('id', '=', $dadosAuth[0]->id)
			->put();

		$response = [
			'status' => 'success',
			'msg' => 'Dados consulatados com sucesso',
			'redirect' => 'dashboard',
		];
	}else{
		$response = [
			'status' => 'error',
			'msg' => 'Usúario ou senha incorretos',
		];
	}
}else{
	$response = [
		'status' => 'error',
		'msg' => 'Usúario ou senha incorretos',
	];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);