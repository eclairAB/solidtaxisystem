
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['refill_tb']))
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
				$ok = false;
			}
		}


		if($ok == true)
		{
			

			date_default_timezone_set('Asia/Manila');


			MYSQL_INSERT("gas_inventory","refill_amount,gt_date,tank_no",$_POST['refill_tb'].",'".Date("Y-m-d H:i:s")."',1");

			include("logs.php");
			log_add("Refill Tank 1. Liters: ".$_POST['refill_tb']);

			$_SESSION['success'] = "Gas Added.";
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