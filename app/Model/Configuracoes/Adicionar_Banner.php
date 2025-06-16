<?php
$conDB = new Classes\ConDB;
$insertDesktop = new Classes\Metodos($conDB);
$insertMobile  = new Classes\Metodos($conDB);
$dateTime = new DateTime();

if (
    !isset($_FILES['banner_desktop']) || $_FILES['banner_desktop']['error'] === UPLOAD_ERR_NO_FILE ||
    !isset($_FILES['banner_mobile']) || $_FILES['banner_mobile']['error'] === UPLOAD_ERR_NO_FILE
) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Ambas as imagens Desktop e Mobile são obrigatórias.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$md5Hash = md5($dateTime->format('Y-m-d H:i:s'));
$base36 = base_convert($md5Hash, 16, 36);
$codigo = substr($base36, 0, 5);

function salvarImagem($inputName, $codigo, $isMobile = false)
{
    $nomeTemporario = $_FILES[$inputName]['tmp_name'];
    $fileName = $_FILES[$inputName]['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $uploadFileDir = 'img/banner/';
    $nomeArquivo = $codigo . ($isMobile ? '_mobile' : '') . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $nomeArquivo;
    $extPerm = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

    if (!is_dir($uploadFileDir)) {
        if (!mkdir($uploadFileDir, 0755, true)) {
            echo json_encode(['status' => 'error', 'msg' => 'Erro ao criar diretório de imagem.'], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    if (!in_array($fileExtension, $extPerm)) {
        echo json_encode(['status' => 'error', 'msg' => "Formato inválido: $fileExtension."], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (!move_uploaded_file($nomeTemporario, $dest_path)) {
        echo json_encode(['status' => 'error', 'msg' => "Erro ao mover a imagem $fileName."], JSON_UNESCAPED_UNICODE);
        exit;
    }

    return $nomeArquivo;
}

$nomeDesktop = salvarImagem('banner_desktop', $codigo, false);
$nomeMobile = salvarImagem('banner_mobile', $codigo, true);

$urlDirecionamento = $_POST['url_direcionamento'] ?? null;
$clicavel = $_POST['clicavel'] ?? 2;
$clicavel = ($clicavel == '1' || $clicavel === 1) ? 1 : 2;

if ($urlDirecionamento != null) {
    $inserirDesktop = $insertDesktop
        ->table('tb_banners')
        ->value('banner', $nomeDesktop)
        ->value('url_direcionamento', $urlDirecionamento)
        ->value('clicavel', $clicavel)
        ->post();
} else {
    $inserirDesktop = $insertDesktop
        ->table('tb_banners')
        ->value('banner', $nomeDesktop)
        ->value('clicavel', $clicavel)
        ->post();
}

if ($inserirDesktop != 1) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao salvar banner Desktop no banco.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($urlDirecionamento != null) {
    $inserirMobile = $insertMobile 
        ->table('tb_banners')
        ->value('banner', $nomeMobile)
        ->value('url_direcionamento', $urlDirecionamento)
        ->value('clicavel', $clicavel)
        ->post();
} else {
    $inserirMobile = $insertMobile 
        ->table('tb_banners')
        ->value('banner', $nomeMobile)
        ->value('clicavel', $clicavel)
        ->post();
}

if ($inserirMobile != 1) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao salvar banner Mobile no banco.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'status' => 'success',
    'msg' => 'Banners Desktop e Mobile adicionados com sucesso.'
], JSON_UNESCAPED_UNICODE);