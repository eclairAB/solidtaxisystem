
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['taxi_classification_tb']) && isset($_POST['id_tb']) && isset($_POST['rental_price_tb']))
	{

		$ok = true;

		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../taxiclassification_edit.php?id=".$_POST['id_tb']);
		}


		if(!is_numeric($_POST['rental_price_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../taxiclassification_edit.php?id=".$_POST['id_tb']);
			$ok = false;
		}



		$_POST['taxi_classification_tb'] = str_replace("'", "''", $_POST['taxi_classification_tb']);




		if($ok == true)
		{


			MYSQL_UPDATE("update taxi_class set tc_text='".$_POST['taxi_classification_tb']."',rental_price=".$_POST['rental_price_tb']." where tc_id=".$_POST['id_tb']);

			include("logs.php");
			log_add("Updated a taxi classification. Taxi Classification: ".$_POST['taxi_classification_tb'] . " / ID: ".$_POST['id_tb']);

			$_SESSION['success'] = "Taxi Classification updated.";
			header("location:../taxiclassification.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../taxiclassification_edit.php?id=".$_POST['id_tb']);
	}
}
else
{
	header("location:../index.php");
}



?>