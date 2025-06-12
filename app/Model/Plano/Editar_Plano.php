<?php
global $_PUT;
parse_str(file_get_contents('php://input'), $_PUT);

$conDB = new Classes\ConDB;
$Metodos = new Classes\Metodos($conDB);
$delPalnSec = new Classes\Metodos($conDB);
$Encrypt = new Classes\Encrypt;
$dateTime = new DateTime();

if (empty($_PUT['id_plano']) || empty($_PUT['nome_plan']) || empty($_PUT['valor']) || empty($_PUT['selecao_secao'])) {
    echo json_encode([
        'status' => 'error',
        'msg' => 'Preencha todos os campos obrigatórios.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$idPlano = $Encrypt->decrypt($_PUT['id_plano']);
$nome = trim($_PUT['nome_plan']);
$valor = preg_replace('/[^\d,]/', '', $_PUT['valor']);
$valor = str_replace(',', '.', $valor);
$valor = number_format((float) $valor, 2, '.', '');
$secao = trim($_PUT['selecao_secao']);
$beneficios = $_PUT['beneficios'] ?? [];
$itens = $_PUT['itens'] ?? [];
$id_secao = $Encrypt->decrypt($secao);

$update = $Metodos
    ->table('tb_planos')
    ->set('nome_plan', $nome)
    ->set('valor', $valor)
    ->where('id', '=', $idPlano)
    ->put();

$delPalnSec->table('tb_sva_plan')->where('id_plano', '=', $idPlano)->delete();

foreach ($beneficios as $benef) {
    $id = $Encrypt->decrypt($benef);
    if (is_numeric($id)) {
        (new Classes\Metodos($conDB))
            ->table('tb_sva_plan')
            ->value('id_plano', $idPlano)
            ->value('id_sva', $id)
            ->value('tipo_plano', 'Benefício')
            ->post();
    }
}

foreach ($itens as $item) {
    $id = $Encrypt->decrypt($item);
    if (is_numeric($id)) {
        (new Classes\Metodos($conDB))
            ->table('tb_sva_plan')
            ->value('id_plano', $idPlano)
            ->value('id_sva', $id)
            ->value('tipo_plano', 'Item')
            ->post();
    }
}

$Metodos
    ->table('tb_sva_plan')
    ->value('id_plano', $idPlano)
    ->value('id_sva', $id_secao)
    ->value('tipo_plano', 'Seção')
    ->post();


echo json_encode([
    'status' => 'success',
    'msg' => 'Plano atualizado com sucesso.'
], JSON_UNESCAPED_UNICODE);
