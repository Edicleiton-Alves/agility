<?php

namespace Classes;

class Routes
{
	private $reqUrl;
	private $param;

	public function proccess($urlRoute, $function)
	{

		$this->param = null;
		
		$reqUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		
		$param = explode(':', $urlRoute);

		if (count($param) > 1) {
			$urlRoute = $param[0];
			$posicaoUrl = strlen($param[0]) - strlen($reqUrl);
			$this->param = substr($reqUrl, $posicaoUrl);
		}

		if ($reqUrl == $urlRoute.$this->param) {
			$function($this->param);
			exit;
		}

	}

	public function erro_404($function)
	{
		return $function();
	}

	public function get($urlRoute, $function)
	{
		if (METODO == 'GET') {
			$this->proccess($urlRoute, $function);
		}
	}

	public function post($urlRoute, $function)
	{
		if (METODO == 'POST') {
			$this->proccess($urlRoute, $function);
		}
	}

	public function put($urlRoute, $function)
	{
		if (METODO == 'PUT') {
			$this->proccess($urlRoute, $function);
		}
	}

	public function delete($urlRoute, $function)
	{
		if (METODO == 'DELETE') {
			$this->proccess($urlRoute, $function);
		}
	}
}