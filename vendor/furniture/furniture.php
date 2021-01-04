<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor\Product;

class Furniture extends Product
{
	
	private $length;
	private $width;
	private $height;
	
	public function setProductSpecificAttributes($att, $conn)
	{
		if (count($att) == 3) {
			$this->length = (int) $att[0];
			$this->width = (int) $att[1];
			$this->height = (int) $att[2];
			$this->saveProduct($conn);
		} else {
			$this->err = "Missing required data: length, width, height";
			$this->returnError($this->err);
		}
	}
	
	public function saveProduct($conn)
	{
		$sql = "INSERT INTO products (SKU, NAME, PRICE, TYPE,  LENGTH, WIDTH, HEIGHT) VALUES ('$this->sku', '$this->name', '$this->price', '$this->type', '$this->length', '$this->width', '$this->height')";
		if ($conn->query($sql) === TRUE){
			header ("Location: product_list.php");
			exit;
		} else {
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
				$url = 'https://';
			} else {
				$url = 'http://';
			}
			$app_host = $_SERVER['HTTP_HOST'];
			$path_array = explode('/', $_SERVER['REQUEST_URI']);
			$app_dir = $path_array[count($path_array)-4];
			if ($app_dir != $app_host) {
				$url .= $app_host.$app_dir.'create_product.php';
			} else {
				$url .= $app_host.'create_product.php';
			}
			$err = " Error: ( ".$conn->errno ." ) ".$conn->error;
			$this->returnError($this->err);		
		}
	}
	
	public function displayAttributes($row)
	{
		echo"<span class='dimensions'>Dimensions: ".filter_var($row["LENGTH"], FILTER_SANITIZE_STRING)."x".filter_var($row["WIDTH"], FILTER_SANITIZE_STRING)."x".filter_var($row["HEIGHT"], FILTER_SANITIZE_STRING)."</span></div></div></div></div>";	
	}
}

// EOF
