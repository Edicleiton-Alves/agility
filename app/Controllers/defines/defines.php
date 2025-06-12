<?php
//token
define('TOKEN', md5('agltDash'));
define('TOKEN_SECUNDARY', md5('agltDashSec'));

//metodos
define('METODO', $_SERVER['REQUEST_METHOD']);
define('METODOS_PERMITIDOS', ['GET', 'POST', 'PUT', 'DELETE']);

//pastas do sistema
define('PATH', [
	'Classes' => '../app/Controllers/Classes/',
	'Controllers' => '../app/Controllers/',
	'Views' => '../app/Views/',
	'Requests' => '../app/Model/',
]);

define('VERSION', '1.0.0');

//database conection
define('DATABASE', [
	'host' => 'agilityindependencia.com.br',
	'dbname' => 'anton755_rede_aglt',
	'user' => 'anton755_rede',
	'pass' => 'dR1LanZGEr]I'
]);
