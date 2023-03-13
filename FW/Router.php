<?php

namespace FW;

class Router 
{
	private $routes = [];
	private $prefix = "";

	/**
	 * Add the folder path if not serving from the domain root.
	 *
	 * @param string $path
	 * @return void
	 */
	public function setBasePath($path) {
		$this->prefix = $path;
	}

	public function add($method, $path, $controller, $action) {
		$this->routes[] = [
			'method' => $method,
			'path' => $path,
			'controller' => $controller,
			'action' => $action
		];
	}

	public function match($request) {
		$method = $request['REQUEST_METHOD'];
		$path = str_replace($this->prefix, '', $request['REQUEST_URI']);
		$path = $path ?: '/';
		
		$segments = explode('/', $path);
		
		foreach ($this->routes as $route) {
			$route_segments = explode('/', $route['path']);
			$num_segments = count($route_segments);
			if ($num_segments == count($segments) && $route['method'] == $method) {
				$params = array();
				$match = true;
				for ($i = 0; $i < $num_segments; $i++) {
					if (strpos($route_segments[$i], '{') === false) {
						if ($route_segments[$i] != $segments[$i]) {
							$match = false;
							break;
						}
					} else {
						//$param_name = substr($route_segments[$i], 1, -1); // removed matching variable name requirement
						$params[/* $param_name */] = $segments[$i];
					}
				}
				if ($match) {
					$controller = new $route['controller']();
					$action = $route['action'];
					return call_user_func_array(array($controller, $action), $params);
				}
			}
		}
	
		http_response_code(404);
		die('Not Found');
	}
	
}
