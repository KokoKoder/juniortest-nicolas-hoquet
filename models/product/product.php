<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Models\Product;

use Vendor\Connect\Connect;

abstract class Product
{	
	public $sku;
	public $name;
	public $price;
	public $type;
	
	public function setProduct($sku, $name, $price, $type)
	{	
		$this->sku = (string) $sku;
		$this->name = (string) $name;
		$this->price = (float)  $price;
		$this->type = (string) $type;
	}
	
	public static function displayProduct()
	{
		$sql = "SELECT * FROM products";
		$results = Connect::conn()->query($sql);
		if ($results->num_rows > 0) {
			echo "<div class='row'>";
			while ($row = $results->fetch_assoc()) {
				$product_class = "Models\Product\\".$row["TYPE"];
				$product_type = new $product_class;
				echo 
				"<div class='col-md-3 '>
				<span class='sku'>
				<div class='card'>
				<div class='card-body'>
				<input type='radio' name='" . filter_var($row["SKU"], FILTER_SANITIZE_STRING) . "'><br>
				<div class='card-text text-center'>
				<span class='sku'>
				<b>".filter_var($row["SKU"], FILTER_SANITIZE_STRING)."</b>
				</span><br>
				<span class='name'>".filter_var($row["NAME"], FILTER_SANITIZE_STRING)."</span><br>
				<span class='price'>$".filter_var($row["PRICE"], FILTER_SANITIZE_STRING)."</span><br>"; 
				$product_type->displayAttributes($row);
			}
			echo "</div>";
		} else {
			echo "Database empty<br>";
			echo "<a href='/product/add/'>Start adding products</a>";
		}

	}
	
	public static function returnError($err)
	{
		$_SESSION['err'] = $err;
		header("Location: /product/add/");
	}
	
	public static function displayError()
	{
		if (!is_null($_SESSION['err']))
		{
			echo $_SESSION['err'];	
		}
		$_SESSION['err'] = null;
	}
	
}
// EOF
