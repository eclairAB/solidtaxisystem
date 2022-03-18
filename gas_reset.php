<?php


		session_start();


		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISGASBOY()==true)
			{
				unset($_SESSION['gas_driver_id']);
				unset($_SESSION['gas_taxi_id']);
				header("location:gas.php");
			}
			else
			{
				header("location:index.php");
			}
		}
		else
		{
			header("location:index.php");
		}

?>


