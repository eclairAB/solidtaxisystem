<?php


		session_start();


		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISGUARD()==true)
			{
				unset($_SESSION['guard_driver_id']);
				unset($_SESSION['guard_taxi_id']);
				header("location:guard.php");
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


