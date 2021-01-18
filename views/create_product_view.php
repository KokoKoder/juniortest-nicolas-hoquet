<?php

/**
*@package: Scandiweb assignment
*@Author: Nicolas HOQUET
**/

use Models\Product\Product;

?>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel='stylesheet' type='text/css' href='/style.css'>
</head>
<body>
	<div class='container'>
		<div class='row'>
			<form  name="createProduct"  onsubmit="return validateForm()" action="/product/create/" method="post">
				<div class='row'>
					<div class='col-md-6'>
						<h1>Add Product</h1>
					</div>
					<div class='col-md-6 text-end'>
						<input type="submit" value="Save" class="btn btn-success"> <a href="/product/list/" class="btn btn-warning">Cancel</a>
					</div>
				</div>
				<hr>
				<span id="errorbox"><?php Product::displayError(); ?></span><br>
				<label  for="name">Product Name:</label><br>
				<input type="text" id="name" name="name"><br>
				<label for="sku">SKU:</label><br>
				<input type="text" id="sku" name="sku"><br>
				<label  for="price" >Price ($):</label><br>
				<input pattern="[0-9]*[.]?[0-9]*" type="text" id="price" name="price" title="Enter a numerical value with decimal separated by a dot"><br>
				<label for="type">Type:</label><br>
				<select onchange="changeType()" type="text" id="type" name="type">
					<option value="">Select Product Type</option>
					<option value="DVD">DVD</option>
					<option value="Book">Book</option>
					<option value="Furniture">Furniture</option>
				</select><br>
				<span id="infobox"></span><br>
				<label id="sizeLabel" for="size" style="display:none">Size (in MB):</label><br>
				<input type="number" id="size" name="size" style="display:none"><br>
				<span class="book-attribute" style="position:absolute; top:400px">
					<label id="weightLabel" for="weight" style="display:none">Weight (in Kg):</label><br>
					<input type="text" pattern="[0-9]*[.]?[0-9]*" id="weight" name="weight" style="display:none" title="Enter a numerical value with decimal separated by a dot"><br>
				</span>
				<fieldset id="dimensions" style="display:none;border:0;position:absolute; top:400px">
					<label id="lengthLabel" for="length" >Length (cm):</label><br>
					<input  type="number" id="length" name="length" ><br>
					<label id="widthLabel" for="width" >Width (cm):</label><br>
					<input  type="number" id="width" name="width" ><br>
					<label id="heightLabel" for="height" >Height (cm):</label><br>
					<input  type="number" id="height" name="height"><br>
				</fieldset>
			</form>
		</div>
		<hr>
		<div class="footer text-center">
			<p>Scandiweb test assignment</p>
		</div>
	</div>

<script>

function changeType()
{
	//get select current value
	var type = document.getElementById("type").value;
	var infobox = document.getElementById("infobox").innerHTML;
	var sizeLabel = document.getElementById("sizeLabel");
	var size = document.getElementById("size");
	var weightLabel = document.getElementById("weightLabel");
	var weightInput = document.getElementById("weight");
	var lengthLabel = document.getElementById("lengthLabel");
	var lengthInput = document.getElementById("length");
	var widthLabel = document.getElementById("widthLabel");
	var widthInput = document.getElementById("width");
	var heightLabel = document.getElementById("heightLabel");
	var heightInput = document.getElementById("height");
	var dimensions = document.getElementById("dimensions");

	//change the corresponding label and input style to display block
	//display the appropriate instruction
	//reinitialize unwanted fields
	switch(type){
		case type = 'DVD':
			infobox = "Please, provide size";
			document.getElementById("sizeLabel").style.display = "initial";
			document.getElementById("size").style.display = "block";
			document.getElementById("weightLabel").style.display = "none";
			document.getElementById("weight").style.display = "none";
			document.getElementById("weight").value = "";
			dimensions.style.display = "none";
			lengthInput.value = "";
			widthInput.value = "";
			heightInput.value = "";
			break;
		case type = 'Book':
			infobox=="Please, provide weight";
			document.getElementById("sizeLabel").style.display = "none";
			document.getElementById("size").style.display = "none";
			document.getElementById("size").value = "";
			document.getElementById("weightLabel").style.display = "initial";
			document.getElementById("weight").style.display = "block";
			dimensions.style.display = "none";
			lengthInput.value = "";
			widthInput.value = "";
			heightInput.value = "";
			break;
		case type = 'Furniture':
			infobox = "Please, provide dimensions";
			sizeLabel.style.display = "none";
			size.style.display = "none";
			size.valu = "";
			weightLabel.style.display = "none";
			weight.style.display = "none";
			weight.value = "";
			dimensions.style.display = "block";
	}

}

function validateForm(){
	//check that all required fields are not empty
	var form = document.forms["createProduct"];
	var errfield=document.getElementById("errorbox");
	if (form["name"].value == "") {
		errfield.innerHTML="Please, submit required data";
		return false;
	}
	if (form["sku"].value == "") {
		errfield.innerHTML="Please, submit required data";
		return false;
	}
	if (form["price"].value == "") {
		errfield.innerHTML = "Please, submit required data";
		return false;
	}
	if (form["type"].value == "") {
		errfield.innerHTML = "Please, submit required data";
		return false;
	}
	if (form["type"].value == "DVD" && form["size"].value == "") {
		errfield.innerHTML = "Please, submit required data";
		return false;		
	}
	if (form["type"].value == "Book" && form["weight"].value == "") {
		errfield.innerHTML = "Please, submit required data";
		return false;
	}
	if (form["type"].value == "Furniture") {
		if (form["length"].value == "" || form["width"].value == "" || form["height"].value == ""){
			errfield.innerHTML = "Please, submit required data";
			return false;
		} 
	} 
}

</script>
</body>
</html>
