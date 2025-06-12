<?php
$conDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($conDB);
$dateTime = new DateTime();

if (empty($_POST['titulo']) || empty($_POST['tipo_sva'])) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Preencha todos os campos obrigatórios.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$titulo = trim($_POST['titulo']);
$tipo = trim($_POST['tipo_sva']);
$img_beneficio = null;
$aux = null;

function salvarImagem($inputName, $indexador)
{
    $dateTime = new DateTime();

    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $md5Hash = md5($dateTime->format('Y-m-d H:i:s') . $indexador);
    $base36 = base_convert($md5Hash, 16, 36);
    $codigo = substr($base36, 0, 5);

    $nomeTemporario = $_FILES[$inputName]['tmp_name'];
    $fileName = $_FILES[$inputName]['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $uploadFileDir = 'img/sva/';
    $dest_path = $uploadFileDir . $codigo . '.' . $fileExtension;
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

    return $codigo . '.' . $fileExtension;
}

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    if ($tipo === 'Benefício') {
        $img_beneficio = salvarImagem('imagem', 'beneficio');
    }
}

if ($img_beneficio !== null) {

    $aux = $Metodos
        ->table('tb_sva')
        ->value('titulo', $titulo)
        ->value('tipo_sva', $tipo)
        ->value('img_beneficio', $img_beneficio)
        ->post();
} else {
    $aux = $Metodos
        ->table('tb_sva')
        ->value('titulo', $titulo)
        ->value('tipo_sva', $tipo)
        ->post();   
}

if ($aux != 1) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao cadastrar formulário.'
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        'status' => 'success',
        'msg' => 'SVA cadastrado com sucesso.',
    ], JSON_UNESCAPED_UNICODE);
}
