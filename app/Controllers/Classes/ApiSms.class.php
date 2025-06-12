<?php

namespace Classes;

class ApiSms
{
	private $header;
    private $metodo;
    private $urlRaiz;
    private $url;
    private $data;
    private $login;
    private $token;

	public function __construct()
    {
        $this->login = SMS['login'];
        $this->token = SMS['token'];
        $this->header = [
            "Content-Type: application/json"
        ];

        $this->urlRaiz = 'http://painel.kingsms.com.br/kingsms/api.php';
    }

	public function initRequest()
    {
        $apiSms = curl_init();

        curl_setopt($apiSms, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($apiSms, CURLOPT_CUSTOMREQUEST, $this->metodo);
        curl_setopt($apiSms, CURLOPT_URL, $this->url);
        curl_setopt($apiSms, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($apiSms, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($apiSms);

        curl_close($apiSms);

        return json_decode($response, true);
    }

    public function sendSms($numero, $nomeParcial, $codigo)
    {
        $txtMsg = "Ola, ". $nomeParcial . ",aqui está seu código para atualizar sua senha: " . $codigo . " . Obrigado por usar nosso sistema.";

        $msg = $txtMsg;
        $params = [
            'acao' => 'sendsms',
            'login' => $this->login,
            'token' => $this->token,
            'numero' => $numero,
            'msg' => $msg
        ];

        $query = http_build_query($params);
        $this->url = $this->urlRaiz . '?' . $query;
        $this->metodo = 'GET';
        $this->data = '';

        return $this->initRequest();
    }
}