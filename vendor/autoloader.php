<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor;

class Autoloader
{
	public static function autoload()
	{
		$required_classes = array(
		'connect\connect',
		'product\product',
		'book\book',
		'dvd\dvd',
		'furniture\furniture');
		foreach($required_classes as $class_name) {
			spl_autoload($class_name);
		}
	}
}

spl_autoload_register('Vendor\Autoloader::autoload');

// EOF
