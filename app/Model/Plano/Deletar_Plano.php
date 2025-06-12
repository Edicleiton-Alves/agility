<?php
header('Content-Type: application/json; charset=utf-8');
global $_DELETE;
parse_str(file_get_contents('php://input'), $_DELETE);

$ConDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($ConDB);
$deletePlan = new Classes\Metodos($ConDB);
$deletePlanSel = new Classes\Metodos($ConDB);
$dec = new Classes\Encrypt;

$id = $dec->decrypt($_DELETE['id_exclude'] ?? '');

if (!$id) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao tentar excluir!',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$plan = $Metodos
    ->table('tb_planos')
    ->where('id', '=', $id)
    ->get();

if (empty($plan)) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'SVA não encontrado.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {

    $deletePlan
        ->table('tb_planos')
        ->where('id', '=', $id)
        ->delete();

    $deletePlanSel
        ->table('tb_sva_plan')
        ->where('id_plano', '=', $id)
        ->delete();

    echo json_encode([
        'status' => 'success',
        'msg' => 'Plano excluído com sucesso.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao tentar excluir Plano: ' . $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
