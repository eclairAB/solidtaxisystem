
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['gas_price_tb']))
	{

		$ok = true;

		if(!is_numeric($_POST['gas_price_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../gasprice.php");
			$ok = false;
		}
		else
		{
			if($_POST['gas_price_tb'] < 1)
			{
				$_SESSION['error'] = "Gas price should be greater than 1.";
				header("location:../gasprice.php");
			}
		}


		if($ok == true)
		{
			MYSQL_UPDATE("update gas_price set gp_price=".$_POST['gas_price_tb']);

			include("logs.php");
			log_add("Updated Gas Price. New Price: ".$_POST['gas_price_tb']);

			$_SESSION['success'] = "Gas price updated.";
			header("location:../gasprice.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../gasprice.php");
	}
}
else
{
	header("location:../index.php");
}



?>