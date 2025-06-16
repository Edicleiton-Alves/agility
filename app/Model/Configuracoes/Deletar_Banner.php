<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Método não permitido.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

parse_str(file_get_contents("php://input"), $_DELETE);

$conDB = new Classes\ConDB;
$delete = new Classes\Metodos($conDB);

$idDesktop = isset($_DELETE['id_desktop']) ? intval($_DELETE['id_desktop']) : null;
$idMobile  = isset($_DELETE['id_mobile']) ? intval($_DELETE['id_mobile']) : null;

if (!$idDesktop || !$idMobile) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Não encontramos as informações obrigatórias.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

function excluirImagem($id, $metodos) {
    $busca = $metodos->table('tb_banners')
                     ->select('banner')
                     ->where('id', '=', $id)
                     ->get();

    if (!$busca || count($busca) === 0) {
        return ['status' => false, 'msg' => "Banner não encontrado."];
    }

    $arquivo = 'img/banner/' . $busca[0]->banner;

    if (file_exists($arquivo)) {
        if (!unlink($arquivo)) {
            return ['status' => false, 'msg' => "Erro ao excluir o arquivo: {$busca[0]->banner}."];
        }
    }

    $excluir = $metodos->table('tb_banners')
                       ->where('id', '=', $id)
                       ->delete();

    if ($excluir != 1) {
        return ['status' => false, 'msg' => "Erro ao deletar o registro."];
    }

    return ['status' => true];
}

// Excluir Desktop
$resultDesktop = excluirImagem($idDesktop, $delete);
if ($resultDesktop['status'] === false) {
    echo json_encode([
        'status' => 'error',
        'msg' => $resultDesktop['msg']
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Excluir Mobile
$resultMobile = excluirImagem($idMobile, $delete);
if ($resultMobile['status'] === false) {
    echo json_encode([
        'status' => 'error',
        'msg' => $resultMobile['msg']
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'status' => 'success',
    'msg' => 'Banners Desktop e Mobile excluídos com sucesso.'
], JSON_UNESCAPED_UNICODE);
