<?php
namespace Classes;

class Senha
{
	public function validar($senha)
	{
		if (strlen($senha) > 7 && preg_match('/\p{Lu}/u', $senha) && preg_match('/\W|_/', $senha) && preg_match('/[0-9]/', $senha)) {
			return [
				'status' => 'success',
				'msg' => 'Dados validados',
				'senha' => $senha
			];
		}else{
			return [
				'status' => 'error',
				'msg' => 'A senha precisa conter um caractere especial, uma letra maiuscula, um número e no minimo oito caracteres. Exemplo: @Suasenha123',
			];
		}
	}
}