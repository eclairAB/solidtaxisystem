<?php


		session_start();


		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISBROADCASTER()==true)
			{
				header("location:broadcaster.php");
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


