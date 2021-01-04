<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

namespace Vendor\Product;

abstract class Product
{	
	public $sku;
	public $name;
	public $price;
	public $type;
	public $err;
	
	public function setProduct($sku, $name, $price, $type)
	{	
		$this->sku = (string) $sku;
		$this->name = (string) $name;
		$this->price = (float)  $price;
		$this->type = (string) $type;
	}
	
	public function displayProduct($row)
	{
		echo "<div class='col-md-3 '><span class='sku'><div class='card'><div class='card-body'><input type='radio' name='" . filter_var($row["SKU"], FILTER_SANITIZE_STRING) . "'><br>
			<div class='card-text text-center'><span class='sku'><b>".filter_var($row["SKU"], FILTER_SANITIZE_STRING)."</b></span><br>
			<span class='name'>".filter_var($row["NAME"], FILTER_SANITIZE_STRING)."</span><br>
			<span class='price'>$".filter_var($row["PRICE"], FILTER_SANITIZE_STRING)."</span><br>"; 
	}
	
	static function returnError($err)
	{
		session_start();
		$_SESSION['err'] = $err;
		header("Location: create_product_view.php");
		exit;
	}
}

// EOF
