<?php

class Router
{
	private $url;
	private $route_collection= Array(
		Array('/product/add/'=>'views/create_product_view.php','method'=>'GET'),
		Array('/'=>'views/product_list.php','method'=>'GET'),
		Array('/product/create/'=>'controllers/productscontroller.php','action'=>'ProductsController::createProduct','method'=>'POST'),
		Array('/product/delete/'=>'controllers/productscontroller.php','action'=>'ProductsController::deleteProduct','method'=>'POST'),
		Array('/product/list/'=>'views/product_list.php','method'=>'GET')
	);
	
	public function __construct($uri)
	{
		$this->url = $uri;
	}
	
	public function route()
	{
		foreach ($this->route_collection as $route)
		{
			if (array_key_exists($this->url,$route)){			
				if ($route['method'] == 'GET')
				{
					include $route[$this->url];
				} else if ($route['method'] == 'POST')
				{
					$action = explode('::',$route['action']);
					require $route[$this->url];
					$controller = new $action[0];
					$controller_method = $action[1];
					$controller->$controller_method();
				}
			}
		}
	}
	
}
//EOF
