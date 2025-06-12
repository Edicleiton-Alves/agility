<?php

namespace Classes;

class Dados
{
	public function emptyData($dado)
	{
		if (is_array($dado)) {
			$status = 'success';
			$msg = [];
			foreach ($dado as $key => $value) {
				if (empty($value)) {
					$status = 'error';
					$msg[] = "O campo $key está vazio<br>";
				}
			}
			$emptyData = [
				'status' => $status,
				'msg' => $msg
			];
			return $emptyData;
		}else{
			if (empty($dado)) {
				$emptyData = [
					'status' => 'error',
					'msg' => "O dado está vazio"
				];
				return $emptyData;
			}
		}
		$emptyData = [
			'status' => 'success',
			'msg' => "O dado não está vazio",
		];
		return $emptyData;
	}

	public function htmlRemove($dado)
	{
		if (is_array($dado)) {
			$dados = [];
			foreach ($dado as $key => $value) {
				$value = preg_replace('/[^a-zA-ZÀ-ÿ0-9\s\.,;:!?@()\'"-]/u', '', $value);
				$dados[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
			}
			$htmlRemove = $dados;
			return $htmlRemove;
		}else{
			$value = preg_replace('/[^a-zA-ZÀ-ÿ0-9\s\.,;:!?@()\'"-]/u', '', $value);
			$htmlRemove = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
			return $htmlRemove;
		}
	}
}