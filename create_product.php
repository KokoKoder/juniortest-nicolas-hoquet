<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor;

include "vendor/autoloader.php";

$connection = new Connect;
$conn = $connection->conn();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
	//passing the error message to the destination page
	$err = "";
	
	if (empty( $_POST["sku"])) {
		$err = "Missing required data";
	} else {
		$sku= $conn->real_escape_string( $_POST["sku"] );
	}
	if (empty($_POST["name"])) {
		$err = "Missing required data";
	} else {
		$name = $conn->real_escape_string($_POST["name"]);
	}
	if (empty($_POST["price"])) {
		$err = "Missing required data";
	} else {
		$price =(float) $conn->real_escape_string($_POST["price"]);
	}
	if (empty($_POST["type"])) {
		$err = "Missing required data";
	} else {
		$type = $conn->real_escape_string($_POST["type"]);
		$product_class = 'Vendor\Product\\'.$type;
		$product_type = new $product_class;
	}
	$att = array();
	if (!empty($_POST["size"])) {
		$size = $conn->real_escape_string($_POST["size"]);
		array_push($att, $size);
	}
	if (!empty($_POST["weight"])) {
		$weight = $conn->real_escape_string($_POST["weight"]);
		array_push($att,$weight);
	}
	if (!empty($_POST["length"])) {
		$length = $conn->real_escape_string($_POST["length"]);
		array_push($att, $length);
	}
	if (!empty($_POST["width"])) {
		$width = $conn->real_escape_string($_POST["width"]);
		array_push($att, $width);
	} 
	if (!empty($_POST["height"])) {
		$height = $conn->real_escape_string($_POST["height"]);
		array_push($att, $height);
	}
	
	if (!$err) {
		$product_class = 'Vendor\Product\\'.$type;
		$product_model = new $product_class;
		$product_model->setProduct($sku, $name, $price, $type);
		$product_model->setProductSpecificAttributes($att,$conn);		
	} else {
		Product\Product::returnError($err);
	}	
}
// EOF
