<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Models;

class Autoloader
{
	public static function autoload()
	{
		$required_classes = array(
		'Product\Product',
		'Book\Book',
		'Dvd\Dvd',
		'Furniture\Furniture');
		foreach($required_classes as $class_name) {
			spl_autoload($class_name);
		}
	}
}

spl_autoload_register('Models\Autoloader::autoload');

// EOF
