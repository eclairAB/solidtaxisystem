<?php

	session_start();

	include("includes/isloggedin.php");
	
		if(ISLOGGEDIN()==true)
		{
			if(ISDISPATCHER()==true)
			{
				if(isset($_SESSION['dispatcher_taxi_id']) && isset($_SESSION['dispatcher_driver_id']))
				{

					include("functions/db.php");

					date_default_timezone_set('Asia/Manila');

					MYSQL_INSERT("in_out","d_id,t_id,in_time,out_time,b_id",$_SESSION['dispatcher_driver_id'].",".$_SESSION['dispatcher_taxi_id'].",'".Date("Y-m-d H:i:s")."','',0");

					$sess_name11 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


					MYSQL_SELECT("select body_no from taxi where t_id=". $_SESSION['dispatcher_taxi_id'],$sess_name11,0);



					include("functions/logs.php");
					log_add("Taxi Out. Body no: ".str_replace("'", "''",$_SESSION[$sess_name11.'_0_0'])." / ID: ". $_SESSION['dispatcher_taxi_id']);







					unset($_SESSION['dispatcher_driver_id']);
					unset($_SESSION['dispatcher_taxi_id']);

					$_SESSION['success'] = "Driver successfully rented a taxi.";

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
		}
		else
		{
			header("location:index.php");
		}


?>