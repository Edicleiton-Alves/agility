<?php
$conDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($conDB);
$getPlan = new Classes\Metodos($conDB);
$postSect = new Classes\Metodos($conDB);
$Encrypt = new Classes\Encrypt;
$dateTime = new DateTime();

if (empty($_POST['nome_plan']) || empty($_POST['valor']) || empty($_POST['selecao_secao'])) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Preencha todos os campos obrigatórios.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$nome = trim($_POST['nome_plan']);
$valor = preg_replace('/[^\d,]/', '', $_POST['valor']);
$valor = str_replace(',', '.', $valor);
$valor = number_format((float) $valor, 2, '.', '');
$secao = trim($_POST['selecao_secao']);
$beneficios = $_POST['beneficios'] ?? [];
$itens = $_POST['itens'] ?? [];

$id_secao = $Encrypt->decrypt($secao);

$md5Hash = md5($dateTime->format('Y-m-d H:i:s'));
$base36 = base_convert($md5Hash, 16, 36);
$codigo = substr($base36, 0, 5);

$idPlano = $Metodos
    ->table('tb_planos')
    ->value('nome_plan', $nome)
    ->value('valor', $valor)
    ->value('cod', $codigo)
    ->post();

if ($idPlano != 1) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Erro ao cadastrar o plano.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$getPlan = $getPlan
    ->table('tb_planos')
    ->where('cod', '=', $codigo)
    ->get();


foreach ($beneficios as $benef) {
    $id = $Encrypt->decrypt($benef);
    $postBeneficio = new Classes\Metodos($conDB);
    if (is_numeric($id)) {
        $postBeneficio
            ->table('tb_sva_plan')
            ->value('id_plano', $getPlan[0]->id)
            ->value('id_sva', $id)
            ->value('tipo_plano', 'Benefício')
            ->post();
    }
}

foreach ($itens as $item) {
    $id = $Encrypt->decrypt($item);
    $postItens = new Classes\Metodos($conDB);
    if (is_numeric($id)) {
        $postItens
            ->table('tb_sva_plan')
            ->value('id_plano', $getPlan[0]->id)
            ->value('id_sva', $id)
            ->value('tipo_plano', 'Item')
            ->post();
    }
}

$postSect
    ->table('tb_sva_plan')
    ->value('id_plano', $getPlan[0]->id)
    ->value('id_sva', $id_secao)
    ->value('tipo_plano', 'Seção')
    ->post();

echo json_encode([
    'status' => 'success',
    'msg' => 'Plano cadastrado com sucesso.'
], JSON_UNESCAPED_UNICODE);
