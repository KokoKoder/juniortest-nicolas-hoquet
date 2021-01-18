<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor\Connect;

class Connect
{
	private static $conn = null;
	
	public static function conn()
	{
		$servername = 'localhost:3306';
		$username = 'root';
		$password = '';
		$dbname = 'product_db';
		
		if (is_null(self::$conn))
		{
			self::$conn = new \mysqli($servername, $username, $password, $dbname);
		}

		if (self::$conn->connect_error) {
			die("Connection failed: ".self::$conn->connect_error);
		}
		
		#set the enconding to utf-8
		mysqli_query(self::$conn, "SET NAMES 'utf8'");
		
		return self::$conn;
	}
	
}
// EOF
