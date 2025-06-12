<?php
namespace Classes;

class Telefone
{
	public function validar($telefone)
	{
		$ddd = ['119', '129', '139', '149', '159', '169', '179', '189', '199', '219', '229', '249', '279', '289', '319', '329', '339', '349', '359', '379', '389', '419', '429', '439', '449', '459', '469', '479', '489', '499', '519', '539', '549', '559', '619', '629', '639', '649', '659', '669', '679', '689', '699', '719', '739', '749', '759', '779', '799', '819', '829', '839', '849', '859', '869', '879', '889', '899', '919', '929', '939', '949', '959', '969', '979', '989', '999'];

		$telefone = preg_replace('/[^0-9]/', '', $telefone);

		if (strlen($telefone) != 11) {
			return [
				'status' => 'error',
				'msg' => 'O telefone precisa ter 11 dígitos'
			];
		}
		
		if (!in_array(substr($telefone, 0, 3), $ddd)) {
			return [
				'status' => 'error',
				'msg' => 'O telefone é inválido'
			];
		}

		return [
			'status' => 'success',
			'msg' => 'Dados validados',
			'telefone' => $telefone
		];
	}
}