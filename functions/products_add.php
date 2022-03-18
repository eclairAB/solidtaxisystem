
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['product_tb']) && isset($_POST['price_tb']))
	{

		$ok = true;

		$_POST['product_tb'] = str_replace("'", "''", $_POST['product_tb']);

		if(!is_numeric($_POST['price_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../products_add.php");
			$ok = false;
		}


		if($ok == true)
		{
			MYSQL_INSERT("products","p_text,p_price","'".$_POST['product_tb']."',".$_POST['price_tb']);

			include("logs.php");
			log_add("Added a Product. Product Name: ".$_POST['product_tb'] . " / Price: " . $_POST['price_tb']);

			$_SESSION['success'] = "Product added.";
			header("location:../products.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../products_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>