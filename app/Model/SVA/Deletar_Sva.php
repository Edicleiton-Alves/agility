<?php 
header('Content-Type: application/json; charset=utf-8');
global $_DELETE;
parse_str(file_get_contents('php://input'), $_DELETE);

$ConDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($ConDB);
$deleteSva = new Classes\Metodos($ConDB);
$dec = new Classes\Encrypt;

$id = $dec->decrypt($_DELETE['id_exclude'] ?? '');

if (!$id) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao tentar excluir!',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

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

try {
    $imagens = json_decode($sva[0]->imagens ?? '[]');
    if (is_array($imagens)) {
        foreach ($imagens as $imgPath) {
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
    }

    $deleteSva
        ->table('tb_sva')
        ->where('id', '=', $id)
        ->delete();

    echo json_encode([
        'status' => 'success',
        'msg' => 'SVA excluído com sucesso.',
    ], JSON_UNESCAPED_UNICODE);
    exit;

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao tentar excluir SVA: ' . $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
    exit;
}