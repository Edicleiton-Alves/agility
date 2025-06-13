<?php
$conDB = new Classes\ConDB;
$getConf = new Classes\Metodos($conDB);
$delConf = new Classes\Metodos($conDB);
$postConf = new Classes\Metodos($conDB);
$dadoVazio = null;

// foreach ($_POST as $key => $value) {
//     if (empty($value)) {
//         $dadoVazio = 'vazio';
//         break;
//     }
// }

// if ($dadoVazio === 'vazio') {
//     echo json_encode([
//         'status' => 'error',
//         'msg' => 'Todos os campos obrigatórios devem ser preenchidos'
//     ], JSON_UNESCAPED_UNICODE);
//     exit;
// }

// $dados = [];
// foreach ($_POST as $key => $value) {
//     $dados[$key] = htmlentities(trim($value));
// }

$existe = $getConf->table('tb_configuracoes')->get();

if (count($existe) > 0) {

    $delConf->table('tb_configuracoes')->where('id', '=', $existe[0]->id)->delete();

}

$resultado = $postConf
    ->table('tb_configuracoes')
    ->value('cnpj', $_POST['cnpj'])
    ->value('email', $_POST['email'])
    ->value('facebook', $_POST['facebook'])
    ->value('instagram', $_POST['instagram'])
    ->value('linkedin', $_POST['linkedin'])
    ->value('youtube', $_POST['youtube'])
    ->value('google_play', $_POST['google_play'])
    ->value('app_store', $_POST['app_store'])
    ->value('area_cliente', $_POST['area_cliente'])
    ->value('whatsapp', $_POST['whatsapp'])
    ->value('endereco', $_POST['endereco'])
    ->post();

if ($resultado == 1) {
    echo json_encode([
        'status' => 'success',
        'msg' => 'Configurações salvas com sucesso'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'status' => 'error',
    'msg' => 'Erro ao salvar as configurações'
], JSON_UNESCAPED_UNICODE);
