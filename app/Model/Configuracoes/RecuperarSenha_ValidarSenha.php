<?php
header('Content-Type: application/json; charset=utf-8');
$senha = new Classes\Senha;
$conDB = new Classes\ConDB;
$getAdmin = new Classes\Metodos($conDB);
$updateSenha = new Classes\Metodos($conDB);
$dec = new Classes\Encrypt;

if (!isset($_SESSION['TOKEN']) || (isset($_SESSION['TOKEN']) && $_SESSION['TOKEN'] !== TOKEN )) {
	exit;
}

$id = (int)$dec->decrypt($_POST['id']);

if (!is_int($id) || $id == 0) {
	exit;
}

if ($_POST['novaSenha'] != $_POST['confirmaSenha']) {
	$result = [
		'status' => 'error',
		'msg' => 'As senhas não coincidem',
	];
	echo json_encode($result, JSON_UNESCAPED_UNICODE);
	exit;
}

$senhaV = $senha->validar($_POST['novaSenha']);

if ($senhaV['status'] == 'error') {
	echo json_encode($senhaV, JSON_UNESCAPED_UNICODE);
	exit;
}

$getAdmin = $getAdmin
	->table('tb_sysadmin')
	->where('id', '=', $id)
	->get();

if (!empty($getAdmin)) {

	$updateSenha = $updateSenha
		->table('tb_sysadmin')
		->set('senha', password_hash($senhaV['senha'], PASSWORD_DEFAULT))
		->where('id', '=', $id)
		->put();
		
	if ($updateSenha == 1) {
		$result = [
			'status' => 'success',
			'msg' => 'Senha atualizada com sucesso, tente fazer login novamente!',
		];
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit;
	}
} else {
	$result = [
		'status' => 'error',
		'msg' => 'Usuário não encontrado.',
	];
	echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
