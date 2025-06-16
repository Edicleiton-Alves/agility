<?php
$conDB = new Classes\ConDB;
$updateDesktop = new Classes\Metodos($conDB);
$updateMobile  = new Classes\Metodos($conDB);

parse_str(file_get_contents("php://input"), $_PUT);

$idDesktop = $_PUT['id_desktop'] ?? null;
$idMobile  = $_PUT['id_mobile'] ?? null;
$url       = isset($_PUT['url_direcionamento']) ? trim($_PUT['url_direcionamento']) : null;

if (!$idDesktop || !$idMobile) {
    echo json_encode([
        'status' => 'error',
        'msg'    => 'Banners (Desktop e Mobile) não encontrados.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

function atualizarUrlBanner($metodo, $id, $url)
{
    return $metodo
        ->table('tb_banners')
        ->set('url_direcionamento', ($url === '' ? null : $url))
        ->set('clicavel', ($url === '' ? 2 : 1))
        ->where('id', '=', $id)
        ->put();
}

$resultDesktop = atualizarUrlBanner($updateDesktop, $idDesktop, $url);
if ($resultDesktop !== 1) {
    echo json_encode([
        'status' => 'error',
        'msg'    => 'Erro ao atualizar a URL do banner Desktop.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$resultMobile = atualizarUrlBanner($updateMobile, $idMobile, $url);
if ($resultMobile !== 1) {
    echo json_encode([
        'status' => 'error',
        'msg'    => 'Erro ao atualizar a URL do banner Mobile.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'status' => 'success',
    'msg'    => 'URL dos banners atualizada com sucesso.'
], JSON_UNESCAPED_UNICODE);
