<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

include "vendor/autoloader.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$connection = new Vendor\Connect;
	$conn = $connection->conn();
	foreach ($_POST as $key => $sku) {
		$sku = $conn->real_escape_string($key);
		$sql = "DELETE FROM products WHERE SKU='$sku'";
		$conn->query($sql);
	}		
}

header("Location: product_list.php");

//EOF
