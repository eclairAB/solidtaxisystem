
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['taxi_classification_tb']) && isset($_POST['rental_price_tb']))
	{

		$ok = true;

		$_POST['taxi_classification_tb'] = str_replace("'", "''", $_POST['taxi_classification_tb']);

		if(!is_numeric($_POST['rental_price_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../taxiclassification_add.php");
			$ok = false;
		}


		if($ok == true)
		{
			MYSQL_INSERT("taxi_class","tc_text,rental_price","'".$_POST['taxi_classification_tb']."',".$_POST['rental_price_tb']);

			include("logs.php");
			log_add("Added a new taxi classification. Taxi Classification: ".$_POST['taxi_classification_tb']);

			$_SESSION['success'] = "Taxi Classification added.";
			header("location:../taxiclassification.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../taxiclassification_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>