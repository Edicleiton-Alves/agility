<?php

if (!isset($_POST['nome']) || !isset($_POST['telefone']) || !isset($_POST['email'])) {

    header("HTTP/1.0 405 Method Not Allowed; charset=utf-8");
    $response = [
        'status' => 'error',
        'msg' => 'Nenhum parâmetro encontrado.'
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    return;
}
header('Content-Type: application/json; charset=utf-8');

$dados = new Classes\Dados;

$dados = $dados->htmlRemove($_POST);

$nome = new Classes\Nome;
$nome = $nome->validar($dados['nome']);

if ($nome['status'] == 'error') {
    echo json_encode($nome, JSON_UNESCAPED_UNICODE);
    return;
}

$telefone = new Classes\Telefone;
$telefone = $telefone->validar($dados['telefone']);

if ($telefone['status'] == 'error') {
    echo json_encode($telefone, JSON_UNESCAPED_UNICODE);
    return;
}

$valida_email = filter_var($dados['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($valida_email, FILTER_VALIDATE_EMAIL)) {
    $result = [
        'status' => 'error',
        'msg' => 'Email inválido.'
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    return;
}

switch ($dados['opcao']) {
    case 1:
        $dados['opcao'] = 'Quero um carregador empresarial';
        break;
    case 2:
        $dados['opcao'] = 'Quero um carregador na minha casa';
        break;
    case 3:
        $dados['opcao'] = 'Outro motivo';
        break;
    default:
        $dados['opcao'] = 'Quero um carregador público';
        break;
}

$headers = "From:" . $dados['email'];
$to = "contato@planetacharge.com.br";
$title = "Novo contato feito pelo site";
$message = "
	Olá, me chamo " . ucwords($dados['nome']) . "
	Meu telefone é " . $dados['telefone'] . "

	Meu email é " . strtolower($dados['email']) . "

	O motivo do contato é " . strtolower($dados['opcao']) . "
    
    " . $dados['msg'];

if (mail($to, $title, $message, $headers)) {
    $result = [
        'status' => 'success',
        'msg' => 'Mensagem enviada. Em breve entraremos em contato.'
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $result = [
        'status' => 'error',
        'msg' => 'Erro ao enviar, tente novamente ou entre em contato <a href="https://api.whatsapp.com/send?phone=5508000857777&text=Olá, gostaria de falar com a Planeta Charge!">clicando aqui</a>.'
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}