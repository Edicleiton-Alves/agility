<?php

namespace Classes;

class CPF
{
	public function validar($cpf)
	{
		$cpf = preg_replace('/[^0-9]/', '', $cpf); //SOMENTE NUMEROS

	if (strlen($cpf) != 11) { // TER 11 CARACTERES
		return [
			'status' => 'error',
			'msg' => 'O CPF precisa ter 11 dígitos'
		];
	}

	if (preg_match('/(\d)\1{10}/', $cpf)) { //SE TODOS OS CARACTERES SÃO IGUAIS
		return [
			'status' => 'error',
			'msg' => 'CPF inválido, todos os dígitos são iguais'
		];
	}

	// Calcular o primeiro dígito verificador
	$soma = 0;
	for ($i = 0; $i < 9; $i++) {
		$soma += ($cpf[$i] * (10 - $i));
	}
	$resto = $soma % 11;
	$digito1 = ($resto < 2) ? 0 : (11 - $resto);

    // Calcular o segundo dígito verificador
	$soma = 0;
	for ($i = 0; $i < 10; $i++) {
		$soma += ($cpf[$i] * (11 - $i));
	}
	$resto = $soma % 11;
	$digito2 = ($resto < 2) ? 0 : (11 - $resto);

    // Verificar se os dígitos verificadores estão corretos
	if (($cpf[9] != $digito1) || ($cpf[10] != $digito2)) {
		return [
			'status' => 'error',
			'msg' => 'CPF inválido'
		];
	}
	
	return [
		'status' => 'success',
		'msg' => 'Dados validados',
		'cpf' => $cpf
	];
}
}