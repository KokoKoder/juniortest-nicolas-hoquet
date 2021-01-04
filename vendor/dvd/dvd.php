<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor\Product;

class DVD extends Product
{
	private $size;
	
	public function setProductSpecificAttributes($att, $conn)
	{
		
		if (count($att) == 1) {
			$this->size = (int) $att[0];
			$this->saveProduct($conn);
		} else {
			$this->err = "Missing required data: Size";
			$this->returnError($this->err);
		}
	}
	
	public function saveProduct($conn)
	{ //$size variable is not useful here
		$sql = "INSERT INTO products (SKU, NAME, PRICE, TYPE, SIZE) VALUES ('$this->sku', '$this->name', '$this->price', '$this->type', '$this->size')";
		if ($conn->query($sql) === TRUE) {
			header ("Location: product_list.php");
			exit;
		} else {
			$this->err = "Error: (".$conn->errno .") ".$conn->error;
			$this->returnError($this->err);
		}
	}
	
	public function displayAttributes($row)
	{
		echo "<span>".filter_var($row["SIZE"], FILTER_SANITIZE_STRING)."</span></div></div></div></div>";
	}	
}
// EOF
