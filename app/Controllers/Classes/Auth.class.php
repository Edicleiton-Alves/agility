<?php

namespace Classes;

class Auth
{
	public function authSession($key, $valor, $func)
	{
		if (isset($_SESSION[$key]) && $_SESSION[$key] == $valor) {
			return $func([
				'status' => 'success',
				'msg' => 'Autorizado'
			]);
		}else{
			return $func([
				'status' => 'error',
				'msg' => 'Sem autorização, faça login para continuar <script> setTimeout(function(){window.location = "/";},6000)</script>'
			]);
		}		
	}
}