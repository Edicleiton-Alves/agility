<?php
header('Content-Type: application/json; charset=utf-8');
$conDB = new Classes\ConDB;
$email = new Classes\Email;
$dateTime = new DateTime();
$getAdmin = new Classes\Metodos($conDB);

if (!isset($_SESSION['TOKEN']) || (isset($_SESSION['TOKEN']) && $_SESSION['TOKEN'] !== TOKEN)) {
    exit;
}

try {
    $getAdmin = $getAdmin->table('tb_sysadmin')->where('email', '=', $_POST['email'])->get();

    if (empty($getAdmin)) {
        throw new Exception("Erro: Email não cadastrado, verifique e tente novamente.");
    }

    $md5Hash = md5($dateTime->format('Y-m-d H:i:s'));
    $base36 = base_convert($md5Hash, 16, 36);
    $codigo = substr($base36, 0, 5);

    $nomeCompleto = explode(' ', $getAdmin[0]->usuario);
    $nomeParcial = $nomeCompleto[0];

    if (isset($nomeCompleto[1])) {
        $nomeParcial .= " " . $nomeCompleto[1];
        if (strlen($nomeCompleto[1]) <= 3 && isset($nomeCompleto[2])) {
            $nomeParcial .= " " . $nomeCompleto[2];
        }
    }

    $nomeParcial = ucwords(strtolower($nomeParcial));


    $email = $getAdmin[0]->email;

    $headers  = "From: Planeta Net Telecom <naoresponda@redeplanetanet.com.br>\r\n";
    $headers .= "Reply-To: naoresponda@redeplanetanet.com.br\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $to = $email;
    $title = $nomeParcial . ", aqui está seu código de recuperação";

    $message = "
        <html>
        <head>
        <meta charset='UTF-8'>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
            }
            .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
            }
            .header {
            background-color:rgb(253, 13, 13);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            }
            .body {
            padding: 30px;
            }
            .codigo {
            font-size: 24px;
            font-weight: bold;
            color:rgb(253, 13, 13);
            margin: 20px 0;
            text-align: center;
            letter-spacing: 4px;
            }
            .footer {
            background-color: #f1f3f5;
            color: #6c757d;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            }
        </style>
        </head>
        <body>
        <div class='container'>
            <div class='header'>
            Recuperação de Senha - Planeta Net
            </div>
            <div class='body'>
            <p>Olá, <strong>{$nomeParcial}</strong>,</p>
            <p>Recebemos uma solicitação para redefinir sua senha.</p>
            <p>Use o código abaixo para continuar o processo de recuperação:</p>
            <div class='codigo'>{$codigo}</div>
            <p>Se você não solicitou essa recuperação, pode ignorar este e-mail.</p>
            <p>Atenciosamente,<br><strong>Equipe Planeta Net Telecom</strong></p>
            </div>
            <div class='footer'>
            Por favor, não responda a este e-mail. Em caso de dúvidas, entre em contato conosco através dos nossos canais oficiais.
            </div>
        </div>
        </body>
        </html>
        ";

    if (mail($to, $title, $message, $headers)) {
        $conDB = new Classes\ConDB;
        $Metodos = new  Classes\Metodos($conDB);

        $Metodos
            ->table('tb_verificacao')
            ->value('codigo', $codigo)
            ->value('id_admin', $getAdmin[0]->id)
            ->value('modo', 'EMAIL')
            ->value('dado', $email)
            ->post();

        echo json_encode($result = [
            'status' => 'success',
            'msg' => 'Código enviado para: ' . mascararDado($email) . ' , aguarde que você irá ser redirecionado.',
            'dado' => $email
        ], JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $result = [
            'status' => 'error',
            'msg' => 'Erro ao enviar código!'
        ];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'msg' => $e->getMessage(),
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

function mascararDado($dado)
{
    if (filter_var($dado, FILTER_VALIDATE_EMAIL)) {
        [$usuario, $dominio] = explode('@', $dado);

        $inicio = substr($usuario, 0, 2);
        $final = substr($usuario, -1);
        $mascara = str_repeat('*', max(0, strlen($usuario) - 3));

        return $inicio . $mascara . $final . '@' . $dominio;
    }

    return $dado;
}
