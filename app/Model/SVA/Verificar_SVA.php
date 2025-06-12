<?php
header('Content-Type: application/json; charset=utf-8');

$ConDB = new Classes\ConDB();
$Metodos = new Classes\Metodos($ConDB);
$dec = new Classes\Encrypt;

$id = $dec->decrypt($id);
$id = (int) $id;

$sva = $Metodos
    ->table('tb_sva')
    ->where('id', '=', $id)
    ->get();

if (empty($sva)) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'SVA não encontrado.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$img = null;

if($sva[0]->tipo_sva == 'Benefício'){
    $img = 'img/sva/' . $sva[0]->img_beneficio;
}

echo json_encode([
    'status' => 'success',
    'titulo' => $sva[0]->titulo,
    'tipo_sva' => $sva[0]->tipo_sva,
    'imagem' => $img
], JSON_UNESCAPED_UNICODE);
exit;
