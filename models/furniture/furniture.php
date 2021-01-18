<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Models\Product;

use Vendor\Connect\Connect;

class Furniture extends Product
{
	
	private $length;
	private $width;
	private $height;
	
	public function setProductSpecificAttributes($att)
	{
		if (count($att) == 3) {
			$this->length = (int) $att[0];
			$this->width = (int) $att[1];
			$this->height = (int) $att[2];
			$this->saveProduct();
		} else {
			$err = "Missing required data: length, width, height";
			Product::returnError($err);
		}
	}
	
	public function saveProduct()
	{
		$conn = Connect::conn();
		$sql = "INSERT INTO products (SKU, NAME, PRICE, TYPE,  LENGTH, WIDTH, HEIGHT) VALUES ('$this->sku', '$this->name', '$this->price', '$this->type', '$this->length', '$this->width', '$this->height')";
		if ($conn->query($sql) === TRUE){
			header ("Location: /product/list/");
			exit;
		} else {
			$err = " Error: ( ".$conn->errno ." ) ".$conn->error;
			Product::returnError($this->err);		
		}
	}
	
	public function displayAttributes($row)
	{
		echo"<span class='dimensions'>Dimensions: ".filter_var($row["LENGTH"], FILTER_SANITIZE_STRING)."x".filter_var($row["WIDTH"], FILTER_SANITIZE_STRING)."x".filter_var($row["HEIGHT"], FILTER_SANITIZE_STRING)."</span></div></div></div></div>";	
	}
}
// EOF
