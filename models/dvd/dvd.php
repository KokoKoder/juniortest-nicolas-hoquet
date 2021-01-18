<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Models\Product;

use Vendor\Connect\Connect;

class DVD extends Product
{
	private $size;
	
	public function setProductSpecificAttributes($att)
	{
		
		if (count($att) == 1) {
			$this->size = (int) $att[0];
			$this->saveProduct();
		} else {
			$err = "Missing required data: Size";
			Product::returnError($err);
		}
	}
	
	public function saveProduct()
	{ 
		$conn = Connect::conn();
		$sql = "INSERT INTO products (SKU, NAME, PRICE, TYPE, SIZE) VALUES ('$this->sku', '$this->name', '$this->price', '$this->type', '$this->size')";
		if ($conn->query($sql) === TRUE) {
			header ("Location: /product/list/");
			exit;
		} else {
			$err = "Error: (".$conn->errno .") ".$conn->error;
			Product::returnError($err);
		}
	}
	
	public function displayAttributes($row)
	{
		echo "<span>".filter_var($row["SIZE"], FILTER_SANITIZE_STRING)."</span></div></div></div></div>";
	}	
}
// EOF
