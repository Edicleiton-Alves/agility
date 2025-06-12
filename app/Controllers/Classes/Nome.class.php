<?php
namespace Classes;

class Nome
{
	public function validar($nome)
	{
		if (strlen($nome) < 3) {
			return [
				'status' => 'error',
				'msg' => 'O nome é inválido'
			];
		}
		
		if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/', $nome)) {
			return [
				'status' => 'error',
				'msg' => 'O nome é inválido'
			];
		}

		return [
			'status' => 'success',
			'msg' => 'Dados validados',
			'nome' => $nome
		];
	}
}