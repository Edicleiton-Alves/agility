<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


session_set_cookie_params([
	'lifetime' => 0,  // Expira quando o navegador é fechado
	'path' => '/',
	'domain' => 'localhost',
	'secure' => true,  // Somente sobre HTTPS
	'httponly' => true,  // Acesso apenas via HTTP (não JavaScript)
	'samesite' => 'Strict',  // Limita o envio de cookies a solicitações do mesmo site
]);

session_start();

require_once '../app/Controllers/controller.php';
