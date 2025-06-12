<?php
namespace Classes;

class Email
{
	public function validar($email)
	{
		if (strpos($email, '@') && strpos($email, '.com') && strlen($email) > 7) {
			list($user, $domain) = explode("@", $email);
			if (checkdnsrr($domain, "MX")) {
				return [
					'status' => 'success',
					'msg' => 'Dados validados',
					'email' => $email
				];
			}else{
				return [
					'status' => 'error',
					'msg' => 'Provedor de email inválido',
				];
			}
		}else{
			return [
				'status' => 'error',
				'msg' => 'Email inválido',
			];
		}
	}
}