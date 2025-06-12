<?php
$ConDB = new Classes\ConDB();
$getPlan = new Classes\Metodos($ConDB);
$getSvaPlan = new Classes\Metodos($ConDB);
$getSecao = new Classes\Metodos($ConDB);
$getBeneficios = new Classes\Metodos($ConDB);
$getItens = new Classes\Metodos($ConDB);
$getSvaInfo = new Classes\Metodos($ConDB);
$dec = new Classes\Encrypt;

$id = $dec->decrypt($id);
$id = (int) $id;

$plan = $getPlan
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

$dados = $plan[0];

$svaPlan = $getSvaPlan
    ->table('tb_sva_plan')
    ->where('id_plano', '=', $id)
    ->get();

$ids_sva_secao = [];
$ids_sva_beneficio = [];
$ids_sva_item = [];

foreach ($svaPlan as $sva) {
    $svaInfo = $getSvaInfo->table('tb_sva')->where('id', '=', $sva->id_sva)->get();
    if (!empty($svaInfo)) {
        $tipo = $svaInfo[0]->tipo_sva;
        if ($tipo === 'Seção') {
            $ids_sva_secao[] = $sva->id_sva;
        } elseif ($tipo === 'Benefício') {
            $ids_sva_beneficio[] = $sva->id_sva;
        } elseif ($tipo === 'Item') {
            $ids_sva_item[] = $sva->id_sva;
        }
    }
}

$getSecao = $getSecao->table('tb_sva')->where('tipo_sva', '=', 'Seção')->get();
$secao_html = '<option value="" disabled>Selecione a seção</option>';
foreach ($getSecao as $secao) {
    $encId = $dec->encrypt($secao->id);
    $selected = in_array($secao->id, $ids_sva_secao) ? 'selected' : '';
    $secao_html .= "<option value='{$encId}' {$selected}>{$secao->titulo}</option>";
}

$getBeneficios = $getBeneficios->table('tb_sva')->where('tipo_sva', '=', 'Benefício')->get();
$benef_html = '';
foreach ($getBeneficios as $benef) {
    $encId = $dec->encrypt($benef->id);
    $checked = in_array($benef->id, $ids_sva_beneficio) ? 'checked' : '';
    $benef_html .= "
        <div class='form-check'>
            <input class='form-check-input' type='checkbox' name='beneficios[]' value='{$encId}' id='benef_{$encId}' {$checked}>
            <label class='form-check-label' for='benef_{$encId}'>{$benef->titulo}</label>
        </div>
    ";
}

$getItens = $getItens->table('tb_sva')->where('tipo_sva', '=', 'Item')->get();
$itens_html = '';
foreach ($getItens as $item) {
    $encId = $dec->encrypt($item->id);
    $checked = in_array($item->id, $ids_sva_item) ? 'checked' : '';
    $itens_html .= "
        <div class='form-check'>
            <input class='form-check-input' type='checkbox' name='itens[]' value='{$encId}' id='item_{$encId}' {$checked}>
            <label class='form-check-label' for='item_{$encId}'>{$item->titulo}</label>
        </div>
    ";
}

echo json_encode([
    'status' => 'success',
    'id' => $dec->encrypt($dados->id),
    'nome_plan' => $dados->nome_plan,
    'valor' => 'R$ ' . number_format($dados->valor, 2, ',', '.'),
    'secao_html' => $secao_html,
    'benef_html' => $benef_html,
    'itens_html' => $itens_html,
], JSON_UNESCAPED_UNICODE);
exit;
