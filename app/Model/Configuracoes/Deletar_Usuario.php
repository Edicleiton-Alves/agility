<?php
header('Content-Type: application/json; charset=utf-8');

$conDB = new Classes\ConDB;
$deleteUsuario = new Classes\Metodos($conDB);

$deleteUsuario = $deleteUsuario
	->table('tb_sysadmin')
	->where('id', '=', htmlentities($id))
	->set('status', 2)
	->set('email', '')
	->put();

if ($deleteUsuario == 1) {
	$response = [
		'status' => 'success',
		'msg' => 'Usuário excluido com sucesso',
		'dados' => $deleteUsuario,
	];
}else{
	$response = [
		'status' => 'error',
		'msg' => 'Erro ao excluir usuário',
	];
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);