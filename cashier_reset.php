<?php


		session_start();


		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISCASHIER()==true)
			{
				unset($_SESSION['cashier_driver_id']);
				$_SESSION['purchased_index'] = 0;
				unset($_SESSION['purchased_index']);

				unset($_SESSION['cashier_others_amount']);
				unset($_SESSION['cashier_others_reason']);
				unset($_SESSION['cashier_discount_amount']);
				unset($_SESSION['cashier_discount_reason']);

				unset($_SESSION['cashier_enter_amount']);
				
				header("location:cashier.php");
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


