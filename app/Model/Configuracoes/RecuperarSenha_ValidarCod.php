<?php
header('Content-Type: application/json; charset=utf-8');
$conDB = new Classes\ConDB;
$getCodigo = new Classes\Metodos($conDB);
$Metodos = new  Classes\Metodos($conDB);
$dateTime = new DateTime();
$dec = new Classes\Encrypt;

if (!isset($_SESSION['TOKEN']) || (isset($_SESSION['TOKEN']) && $_SESSION['TOKEN'] !== TOKEN )) {
	exit;
}

$getCodigo = $getCodigo->table('tb_verificacao')->where('codigo', '=', $_POST['codigo'])->get();

if (!empty($getCodigo)) {
    if (is_null($getCodigo[0]->status) && $getCodigo[0]->codigo == $_POST['codigo']) {
        $Metodos
            ->table('tb_verificacao')
            ->set('status', 'VALIDADO')
            ->set('data_validacao', $dateTime->format('Y-m-d H:i:s'))
            ->where('codigo', '=', $_POST['codigo'])
            ->put();

        $user = $dec->encrypt($getCodigo[0]->id_admin);

        $result = [
            'status' => 'success',
            'msg' => 'Código validado',
            'user' => $user
        ];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    } else {
        $result = [
            'status' => 'error',
            'msg' => 'Código inválido!',
        ];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
} else {
    $result = [
        'status' => 'error',
        'msg' => 'Código não encontrado, insira novamente!',
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
