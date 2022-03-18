
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['driver_classification_tb']) && isset($_POST['id_tb']))
	{

		$ok = true;

		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../driverclassification_edit.php?id=".$_POST['id_tb']);
		}




		$_POST['driver_classification_tb'] = str_replace("'", "''", $_POST['driver_classification_tb']);




		if($ok == true)
		{


			MYSQL_UPDATE("update driver_class set dc_text='".$_POST['driver_classification_tb']."' where dc_id=".$_POST['id_tb']);

			include("logs.php");
			log_add("Updated a driver classification. Driver Classification Name: ".$_POST['driver_classification_tb'] . " / ID: ". $_POST['id_tb']);
			

			$_SESSION['success'] = "Driver Classification updated.";
			header("location:../driverclassification.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../driverclassification_edit.php?id=".$_POST['id_tb']);
	}
}
else
{
	header("location:../index.php");
}



?>