<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

use Vendor\Connect\Connect;
use Models\Product\Product;

class ProductsController
{
	
	public function createProduct()
	{
		if ($_SERVER["REQUEST_METHOD"] == 'POST') {
			//passing the error message to the destination page
			$err = "";
			
			if (empty( $_POST["sku"])) {
				$err = "Missing required data";
			} else {
				$sku= Connect::conn()->real_escape_string( $_POST["sku"] );
			}
			if (empty($_POST["name"])) {
				$err = "Missing required data";
			} else {
				$name = Connect::conn()->real_escape_string($_POST["name"]);
			}
			if (empty($_POST["price"])) {
				$err = "Missing required data";
			} else {
				$price =(float) Connect::conn()->real_escape_string($_POST["price"]);
			}
			if (empty($_POST["type"])) {
				$err = "Missing required data";
			} else {
				$type = Connect::conn()->real_escape_string($_POST["type"]);
				$product_class = 'Models\Product\\'.$type;
				$product_type = new $product_class;
			}
			$att = array();
			if (!empty($_POST["size"])) {
				$size = Connect::conn()->real_escape_string($_POST["size"]);
				array_push($att, $size);
			}
			if (!empty($_POST["weight"])) {
				$weight = Connect::conn()->real_escape_string($_POST["weight"]);
				array_push($att,$weight);
			}
			if (!empty($_POST["length"])) {
				$length = Connect::conn()->real_escape_string($_POST["length"]);
				array_push($att, $length);
			}
			if (!empty($_POST["width"])) {
				$width = Connect::conn()->real_escape_string($_POST["width"]);
				array_push($att, $width);
			} 
			if (!empty($_POST["height"])) {
				$height = Connect::conn()->real_escape_string($_POST["height"]);
				array_push($att, $height);
			}
			
			if (!$err) {
				$product_class = 'Models\Product\\'.$type;
				$product_model = new $product_class;
				$product_model->setProduct($sku, $name, $price, $type);
				$product_model->setProductSpecificAttributes($att);	
			} else {
				Product::returnError($err);
			}	
		}
		
	}
	
	public function deleteProduct()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			foreach ($_POST as $key => $sku) {
				$conn = Connect::conn();
				$sku = $conn->real_escape_string($key);
				$sql = "DELETE FROM products WHERE SKU='$sku'";
				$conn->query($sql);
			}		
		}
		header("Location: /product/list/");
	}

}
//EOF
