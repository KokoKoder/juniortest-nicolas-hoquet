<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

use Models\Product\Product;

?>
<html lang='en'>
	<head>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<link rel='stylesheet' type='text/css' href='/style.css'>
	</head>
	<body>
		<div class='container'>
			<form action="/product/delete/" method="post">
			<div class='row'>
				<div class='col-md-6'>
					<h1>Product List</h1>
				</div>
				<div class='col-md-6 text-end'>
					<input type="submit" value="Delete selected products" class='btn btn-danger'>
					<a type='button' href='/product/add/' class='btn btn-primary'>Add Product</a>
				</div>
			</div>
			<hr>
			<?php
			Product::displayProduct()
			?>
			</form>
			<hr>
			<div class="footer text-center">
				<p>Scandiweb test assignment</p>
			</div>
		</div>
	</body>
</html>
