<?php

header('Content-Type: application/json; charset=utf-8');
$conDB = new Classes\ConDB;
$postUser = new Classes\Metodos($conDB);
$senha = new Classes\Senha;
$email = new Classes\Email;

$dado = null;
foreach ($_POST as $key => $value) {
	if (empty($value)) {
		$dado = 'vazio';
		break;
	}
}

if ($dado == 'vazio') {
	$response = [
		'status' => 'error',
		'msg' => 'Todos os campos devem ser preenchidos',
	];
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	exit;
}

$dados = [];
foreach ($_POST as $key => $value) {
	$dados[$key] = htmlentities($value);
}

$email = $email->validar($dados['e-mail']);

if ($email['status'] == 'error') {
	echo json_encode($email, JSON_UNESCAPED_UNICODE);
	exit;
}

$senha = $senha->validar($dados['senha']);

if ($senha['status'] == 'error') {
	echo json_encode($senha, JSON_UNESCAPED_UNICODE);
	exit;
}

$postUser = $postUser
->table('tb_sysadmin')
->value('usuario', $dados['usuario'])
->value('email', $dados['e-mail'])
->value('senha', password_hash($dados['senha'], PASSWORD_DEFAULT))
->notExists('email')
->post();

if ($postUser == 1) {
	$response = [
		'status' => 'success',
		'msg' => 'Usuário cadastrado com sucesso',
	];
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	exit;
}

$response = [
	'status' => 'error',
	'msg' => 'Email já cadastrado',
];
echo json_encode($response, JSON_UNESCAPED_UNICODE);