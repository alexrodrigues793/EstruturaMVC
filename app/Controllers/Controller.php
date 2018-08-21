<?php
namespace App\Controllers;

use App\Core\Request;
use App\Core\FilteredMap;

abstract class Controller
{
	private $request;
	
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	// retorna os parametros do objeto request
	protected function request()
	{
		return $this->request->params;
	}
	
	// renderiza a view
	protected function render(string $page, array $params = [''])
	{
		$params = $this->setParams($params);
		session_start();
		require ROOT_PATH.'/views/'.$page;
	}

	// configura os parametros para que seja mais fácil de utilizar na view
	private function setParams(array $params)
	{
		if(empty($params))
			return [''];

		foreach (array_keys($params) as $key => $param) {
			if (is_array($params[$param])) {
				foreach (array_keys($params[$param]) as $value) {
					$result[$param.".".$value] = $params[$param][$value];
				}
			} else {
				$result[$param] = $params[$param];
			}
		}

		return $result;
	}
}
