<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor;

class Connect
{
	public function conn()
	{
		$servername = 'localhost:3306';
		$username = 'root';
		$password = '';
		$dbname = 'product_db';

		$conn = new \mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: ".$conn->connect_error);
		}

		#set the enconding to utf-8
		mysqli_query($conn, "SET NAMES 'utf8'");
		return $conn;
		
	}
}
// EOF
