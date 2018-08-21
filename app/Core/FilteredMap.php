<?php

// ***********************************************************************************
// Classe que armazena os dados enviados pelo usuário
// ***********************************************************************************

namespace App\Core;

class FilteredMap
{
	private $params;
	
	public function __construct(array $params)
	{
		$this->params = $params;
	}

	public function addParams(array $params)
	{
		$this->params = array_merge($this->params, $params);
	}
	
	public function has(string $key): bool
	{
		return (isset($this->params[$key]))? true : false;
	}
	
	public function getString(string $key, bool $filtered = false): string
	{
		if ($filtered) {
			$params = isset($this->params[$key])? htmlspecialchars($this->params[$key]) : "";
		} else {
			$params = isset($this->params[$key])? $this->params[$key] : "";
		}

		return $params;
	}
	
	public function getInt(string $key): int
	{
		return (int)$this->params[$key];
	}
	
	public function getFloat(string $key): float
	{
		return (float)$this->params[$key];
	}
}