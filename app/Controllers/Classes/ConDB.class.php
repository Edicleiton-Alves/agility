<?php

namespace Classes;

use PDO;

class ConDB
{
	private $host;
	private $dbname;
	private $user;
	private $pass;

	public function __construct()
	{
		$this->host = DATABASE['host'];
		$this->dbname = DATABASE['dbname'];
		$this->user = DATABASE['user'];
		$this->pass = DATABASE['pass'];
	}

	public function conectar(){
		try {

			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname", 
				"$this->user", 
				"$this->pass"
			);

			return $conexao;
			
		} catch (PDOException $e) {

			// echo 'Erro: '.$e->getMessage().'<hr>';
			echo '<p style="text-align: center;">EM MANUTENÇÃO</p>';

		}
	}
}