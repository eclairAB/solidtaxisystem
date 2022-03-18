<?php

	session_start();

	include("includes/isloggedin.php");
	
		if(ISLOGGEDIN()==true)
		{
			if(ISGUARD()==true)
			{
				if(isset($_SESSION['guard_taxi_id']) && isset($_SESSION['guard_driver_id']))
				{


					include("functions/db.php");

					date_default_timezone_set('Asia/Manila');



					MYSQL_UPDATE("update in_out set out_time='".Date("Y-m-d H:i:s")."' where io_id=".$_SESSION['guard_io_id']);



					$sess_name11 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


					MYSQL_SELECT("select body_no from taxi where t_id=". $_SESSION['guard_taxi_id'],$sess_name11,0);



					include("functions/logs.php");
					log_add("Taxi In. Body no: ".str_replace("'", "''",$_SESSION[$sess_name11.'_0_0'])." / ID: ". $_SESSION['guard_taxi_id']);





					unset($_SESSION['guard_driver_id']);
					unset($_SESSION['guard_taxi_id']);

					$_SESSION['success'] = "Driver returned the taxi.";

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
		}
		else
		{
			header("location:index.php");
		}


?>