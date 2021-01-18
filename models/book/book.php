<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Models\Product;

use Vendor\Connect\Connect;

class Book extends Product
{	
	private $weight;
	
	public function setProductSpecificAttributes($att)
	{
		if (count($att) == 1) {
			$this->weight = (float) $att[0];
			$this->saveProduct();
		} else {
			$err = "Missing required data: Weight";
			Product::returnError($err);
		}
	}
	
	private function saveProduct()
	{
		$conn = Connect::conn();
		echo $this->sku;
		$sql = "INSERT INTO products (SKU, NAME, PRICE, TYPE, WEIGHT) VALUES ('$this->sku','$this->name','$this->price', '$this->type',  '$this->weight')";
		
		if ($conn->query($sql) === TRUE) {
			//header ("Location: /product/list/");
		} else {
			$err = " Error: (".$conn->errno .") ".$conn->error;
			Product::returnError($err);
		}
	}
	
	public function displayAttributes($row)
	{
		echo "<span>".filter_var($row["WEIGHT"], FILTER_SANITIZE_STRING)."</span></div></div></div></div>" ;
	}

}
// EOF
