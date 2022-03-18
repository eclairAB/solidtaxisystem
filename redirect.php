<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN())
			{
				header("location:admin.php");
			}

			if(ISCASHIER())
			{
				header("location:cashier.php");
			}

			if(ISGASBOY())
			{
				header("location:gas.php");
			}

			if(ISGUARD())
			{
				header("location:guard.php");
			}

			if(ISDISPATCHER())
			{
				header("location:dispatcher.php");
			}

			if(ISMAINTENANCE())
			{
				header("location:taxi.php");
			}

			if(ISBROADCASTER())
			{
				header("location:broadcaster.php");
			}

			if(ISREPORTS())
			{
				header("location:report.php");
			}

			if(ISENCODER())
			{
				header("location:encoder.php");
			}

			if(ISREMIT())
			{
				header("location:remit.php");
			}

			if(ISGASMONITORING())
			{
				header("location:gasmonitoring.php");
			}

		}
		else
		{
			header("location:index.php");
		}


?>