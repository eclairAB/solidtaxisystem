
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['refill_tb'])  && isset($_POST['id_tb']))
	{

		$ok = true;

		if(!is_numeric($_POST['refill_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../gas_inventory.php");
			$ok = false;
		}
		else
		{
			if($_POST['refill_tb'] < 1)
			{
				$_SESSION['error'] = "Gas price should be greater than 1.";
				header("location:../gas_inventory.php");
			}
		}


		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../gas_inventory.php");
		}


		if($ok == true)
		{
			

			date_default_timezone_set('Asia/Manila');


			MYSQL_UPDATE("update gas_inventory set refill_amount=".$_POST['refill_tb']." where gt_id=".$_POST['id_tb']);

			include("logs.php");
			log_add("Updated Refill Tank 2. New Liters: ".$_POST['refill_tb'] . " / ID: ".$_POST['id_tb']);

			$_SESSION['success'] = "Gas Updated.";
			header("location:../gas_inventory.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../gas_inventory.php");
	}
}
else
{
	header("location:../index.php");
}



?>