<?php

namespace Classes;

use PDO;

class Metodos
{
	private $conexao;
	private $query;
	private $select;
	private $table;
	private $where;
	private $condWhere;
	private $value;
	private $condKeyValue;
	private $condValue;
	private $set;
	private $condSet;
	private $notExists;
	private $order;
	private $limit;

	public function __construct(ConDB $conexao)
	{

		$this->conexao = $conexao->conectar();
	}
	public function select($select)
	{
		if (empty($select)) {
			die('Erro: É necessario especificar um valor no metodo select.');
		}

		$this->select = $select;
		return $this;
	}

	public function table($table)
	{
		if (empty($table)) {
			die('Erro: É necessario especificar um valor no metodo table.');
		}

		$this->table = $table;
		return $this;
	}

	public function where($coluna, $operador, $valor)
	{

		if (empty($coluna) || empty($operador) || empty($valor)) {
			die('Erro: É necessario especificar a coluna, o operador e um valor no metodo where.');
		}
		$prts = [null, null];

		$this->where[] = [
			'coluna' => $coluna,
			'valor' => $valor
		];
		$vColuna = $coluna;
		if ($operador == 'in') {

			$prts = ['(', ')'];

			if (is_array($valor)) {
				$vColuna = $coluna . "0";

				for ($i = 1; $i < count($valor); $i++) {

					$vColuna .= ", :$coluna$i";
				}
			}
		}

		if (is_null($this->condWhere)) {

			$this->condWhere = "where $coluna $operador $prts[0] :$vColuna $prts[1]";
		} else {

			$this->condWhere .= " and $coluna $operador :$vColuna";
		}

		return $this;
	}

	public function value($coluna, $valor)
	{

		if (empty($valor)) {
			$valor = null;
		}

		$this->value[] = [
			'coluna' => $coluna,
			'valor' => $valor
		];

		if (is_null($this->condValue)) {

			$this->condKeyValue = $coluna;
			$this->condValue = ":$coluna";
		} else {

			$this->condKeyValue .= ", $coluna";
			$this->condValue .= ", :$coluna";
		}

		return $this;
	}

	public function set($coluna, $valor)
	{

		if (empty($coluna)) {
			die('Erro: É necessario especificar a coluna e um valor no metodo set.');
		}

		$this->set[] = [
			'coluna' => $coluna,
			'valor' => $valor
		];

		if (is_null($this->condSet)) {

			$this->condSet = "set $coluna = :$coluna";
		} else {

			$this->condSet .= ", $coluna = :$coluna";
		}

		return $this;
	}

	public function notExists($coluna)
	{
		if (empty($coluna)) {
			die('Erro: É necessario especificar um valor no metodo notExists.');
		}

		if (is_null($this->table) || empty($this->table)) {
			die('Erro: É necessario especificar uma tabela com o metodo table.');
		}

		if (is_null($this->notExists)) {

			$this->notExists = "FROM DUAL WHERE NOT EXISTS(SELECT 1 FROM $this->table WHERE $coluna = :$coluna)";
		} else {
			$this->notExists = rtrim($this->notExists, ')');
			$this->notExists .= " or $coluna = :$coluna)";
		}

		return $this;
	}
	public function order($coluna, $order)
	{
		if (empty($coluna)) {
			die('Erro: É necessario especificar a coluna no metodo order.');
		}
		if (empty($order)) {
			die('Erro: É necessario especificar a ordem no metodo order.');
		}

		if (is_null($this->order)) {

			$this->order = "order by $coluna $order";
		} else {
			$this->order .= ", $coluna $order";
		}
		return $this;
	}
	public function limit($offset, $limit)
	{
		if ($limit === null) {
			die('Erro: É necessário especificar o limite no método limit.');
		}

		if ($offset === null) {
			$offset = 0; // Define o offset como 0 se não for fornecido
		}

		$this->limit = "limit $offset, $limit";
		return $this;
	}

	public function count($disti = null)
	{
		if (is_null($this->table) || empty($this->table)) {
			die('Erro: É necessário especificar uma tabela com o método table.');
		}

		$this->condWhere = is_null($this->condWhere) ? '' : $this->condWhere;

		if (!is_null($disti) && !empty($disti)) {
			$this->query = "select count(distinct $disti) as total from $this->table";
		} else {
			$this->query = "select count(*) as total from $this->table $this->condWhere";
		}

		$stmt = $this->conexao->prepare($this->query);
		if (!empty($this->where)) {
			foreach ($this->where as $where) {
				if (!is_array($where['valor'])) {
					$stmt->bindValue(':' . $where['coluna'], $where['valor']);
				} else {
					foreach ($where['valor'] as $key => $valor) {
						$stmt->bindValue(':' . $where['coluna'] . $key, $valor);
					}
				}
			}
		}
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result->total;
	}

	public function get()
	{
		if (is_null($this->table) || empty($this->table)) {
			die('Erro: É necessario especificar uma tabela com o metodo table.');
		}

		$this->select = is_null($this->select) ? '*' : $this->select;
		$this->condWhere = is_null($this->condWhere) ? '' : $this->condWhere;
		$this->limit = is_null($this->limit) ? '' : $this->limit;
		$this->order = is_null($this->order) ? '' : $this->order;

		$this->query = "select $this->select from $this->table $this->condWhere $this->order $this->limit";

		$stmt = $this->conexao->prepare($this->query);
		if (!empty($this->where)) {
			foreach ($this->where as $where) {
				if (!is_array($where['valor'])) {
					$stmt->bindValue(':' . $where['coluna'], $where['valor']);
				} else {
					foreach ($where['valor'] as $key => $valor) {
						$stmt->bindValue(':' . $where['coluna'] . $key, $valor);
					}
				}
			}
		}
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function post()
	{
		if (is_null($this->table) || empty($this->table)) {
			die('Erro: É necessario especificar uma tabela com o metodo table.');
		}
		if (is_null($this->condValue) || empty($this->condValue)) {
			die('Erro: É necessario especificar os valores com o metodo value.');
		}
		$this->query = "insert into $this->table($this->condKeyValue) select $this->condValue $this->notExists";
		$stmt = $this->conexao->prepare($this->query);

		foreach ($this->value as $value) {
			$stmt->bindValue(':' . $value['coluna'], $value['valor']);
		}
		$stmt->execute();
		return $stmt->rowCount();
	}

	public function put()
	{
		if (is_null($this->table) || empty($this->table)) {
			die('Erro: É necessario especificar uma tabela com o metodo table.');
		}
		if (is_null($this->condSet) || empty($this->condSet)) {
			die('Erro: É necessario especificar os valores com o metodo set.');
		}
		if (is_null($this->condWhere) || empty($this->condWhere)) {
			die('Erro: É necessario especificar a coluna, o operador e um valor no metodo where.');
		}

		$this->query = "update $this->table $this->condSet $this->condWhere";
		$stmt = $this->conexao->prepare($this->query);

		foreach ($this->set as $set) {
			$stmt->bindValue(':' . $set['coluna'], $set['valor']);
		}
		foreach ($this->where as $where) {
			$stmt->bindValue(':' . $where['coluna'], $where['valor']);
		}
		$stmt->execute();
		return $stmt->rowCount();
	}
	public function delete()
	{
		if (is_null($this->table) || empty($this->table)) {
			die('Erro: É necessario especificar uma tabela com o metodo table.');
		}
		if (is_null($this->condWhere) || empty($this->condWhere)) {
			die('Erro: É necessario especificar uma uma condição com o metodo where.');
		}
		$this->query = "delete from $this->table $this->condWhere";
		$stmt = $this->conexao->prepare($this->query);
		foreach ($this->where as $where) {
			$stmt->bindValue(':' . $where['coluna'], $where['valor']);
		}
		$stmt->execute();
		return $stmt->rowCount();
	}

	public function distinct($distinct)
	{
		if (is_null($this->table) || empty($distinct)) {
			die('Erro: É necessário especificar uma tabela com o método table e pelo menos uma coluna.');
		}

		$this->select = "distinct $distinct";

		return $this;
	}
}
