
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['gas_amount_tb']) && isset($_POST['odo_tb']) && isset($_POST['tank_no']))
	{

		$ok = true;


		if(!is_numeric($_POST['gas_amount_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../gas.php");
			$ok = false;
		}
		else
		{
			if($_POST['gas_amount_tb'] < 1)
			{
				$_SESSION['error'] = "Not a number.";
				header("location:../gas.php");
				$ok = false;
			}
		}



		if($_POST['tank_no'] == 1 || $_POST['tank_no'] == 2)
		{

		}
		else
		{
			$_SESSION['error'] = "Invalid tank no.";
			header("location:../gas.php");
			$ok = false;
		}




		if(!is_numeric($_POST['odo_tb']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../gas.php");
			$ok = false;
		}
		else
		{
			if($_POST['odo_tb'] < 1)
			{
				$_SESSION['error'] = "Not a number.";
				header("location:../gas.php");
				$ok = false;
			}
		}





		if($ok == true)
		{


			$sess_name11 = "data11_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			MYSQL_SELECT("select odo from gas where t_id=".$_SESSION['gas_taxi_id'] . " order by g_id desc limit 1",$sess_name11,0);

			$total_trip = 0;

			if(isset($_SESSION[$sess_name11.'_0_0']))
			{
				$total_trip = $_POST['odo_tb'] - $_SESSION[$sess_name11.'_0_0'];
			}



			$sess_name12 = "data12_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			MYSQL_SELECT("select gp_price from gas_price where gp_id=1",$sess_name12,0);




			date_default_timezone_set('Asia/Manila');


			MYSQL_INSERT("gas","d_id,t_id,gas_amount,current_gas_price,odo,total_trip,gas_time,b_id,tank_no",$_SESSION['gas_driver_id'].",".$_SESSION['gas_taxi_id'].",".$_POST['gas_amount_tb'].",".$_SESSION[$sess_name12.'_0_0'].",".$_POST['odo_tb'].",".$total_trip.",'".Date("Y-m-d H:i:s")."',0,".$_POST['tank_no']);




			$sess_name11 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


			MYSQL_SELECT("select body_no from taxi where t_id=". $_SESSION['gas_taxi_id'],$sess_name11,0);


			include("logs.php");
			log_add("Added a gas. Body no: ".str_replace("'", "''",$_SESSION[$sess_name11.'_0_0'])." / Liters: ".$_POST['gas_amount_tb'] . " / Driver ID: ".$_SESSION['gas_driver_id']);



			$_SESSION['success'] = "Gas added.";

			unset($_SESSION['odo_tb']);
			unset($_SESSION['gas_amount_tb']);
			unset($_SESSION['gas_driver_id']);
			unset($_SESSION['gas_taxi_id']);


			header("location:../gas.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../gas.php");
	}
}
else
{
	header("location:../index.php");
}



?>