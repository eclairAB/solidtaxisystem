
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['driver_classification_tb']))
	{

		$ok = true;

		$_POST['driver_classification_tb'] = str_replace("'", "''", $_POST['driver_classification_tb']);



		if($ok == true)
		{
			MYSQL_INSERT("driver_class","dc_text","'".$_POST['driver_classification_tb']."'");

			include("logs.php");
			log_add("Added a new driver classification. Driver Classification Name: ".$_POST['driver_classification_tb']);

			$_SESSION['success'] = "Driver Classification added.";
			header("location:../driverclassification.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../driverclassification_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>