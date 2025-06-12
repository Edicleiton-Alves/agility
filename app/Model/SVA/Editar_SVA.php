<?php
$conDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($conDB);
$getSva = new Classes\Metodos($conDB);
$dec = new Classes\Encrypt;
$dateTime = new DateTime();

if (empty($_POST['titulo']) || empty($_POST['tipo_sva']) || empty($_POST['edit'])) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Preencha todos os campos obrigatórios.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$id = (int) $dec->decrypt($_POST['edit']);
if (!$id) {
    echo json_encode(['status' => 'error', 'msg' => 'Edição inválida!']);
    exit;
}

$titulo = trim($_POST['titulo']);
$tipo = trim($_POST['tipo_sva']);
$img_beneficio = null;

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
    $dados = $getSva
        ->table('tb_sva')
        ->select('img_beneficio')
        ->where('id', '=', $id)
        ->get();

    if (!empty($dados[0]->img_beneficio)) {
        $caminho = 'img/sva/' . $dados[0]->img_beneficio;
        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }
    $img_beneficio = salvarImagem('imagem', 'beneficio');
}

if ($img_beneficio !== null) {
    $resultado  = $Metodos
        ->table('tb_sva')
        ->set('titulo', $titulo)
        ->set('tipo_sva', $tipo)
        ->set('img_beneficio', $img_beneficio)
        ->where('id', '=', $id)
        ->put();
} else {
    $resultado  = $Metodos
        ->table('tb_sva')
        ->set('titulo', $titulo)
        ->set('tipo_sva', $tipo)
        ->where('id', '=', $id)
        ->put();
}

if ($resultado != 1) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao atualizar o SVA.',
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        'status' => 'success',
        'msg' => 'SVA atualizado com sucesso.',
    ], JSON_UNESCAPED_UNICODE);
}
