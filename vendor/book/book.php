<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor\Product;

class Book extends Product
{	
	private $weight;
	
	public function setProductSpecificAttributes($att,$conn)
	{
		if (count($att) == 1) {
			$this->weight = (float) $att[0];
			$this->saveProduct($conn);
		} else {
			$this->err = "Missing required data: Weight";
			$this->returnError($this->err);
		}
	}
	
	private function saveProduct($conn)
	{
		$sql = "INSERT INTO products (SKU, NAME, PRICE, TYPE, WEIGHT) VALUES ('$this->sku','$this->name','$this->price', '$this->type',  '$this->weight')";
		if ($conn->query($sql) === TRUE) {
			header ("Location: product_list.php");
		} else {
			$this->err = " Error: (".$conn->errno .") ".$conn->error;
			$this->returnError($this->err);
		}
	}
	
	public function displayAttributes($row)
	{
		echo "<span>".filter_var($row["WEIGHT"], FILTER_SANITIZE_STRING)."</span></div></div></div></div>" ;
	}

}
// EOF
