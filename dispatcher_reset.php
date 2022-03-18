<?php


		session_start();


		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISDISPATCHER()==true)
			{
				unset($_SESSION['dispatcher_driver_id']);
				unset($_SESSION['dispatcher_taxi_id']);
				header("location:dispatcher.php");
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


