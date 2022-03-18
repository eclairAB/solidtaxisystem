
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['id_tb']))
	{

		$ok = true;



		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../taxi.php");
		}

		



		if($ok == true)
		{


			$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


			MYSQL_SELECT("select odo from gas where t_id=". $_POST['id_tb'] . " order by g_id desc limit 1",$sess_name,0);



			date_default_timezone_set('Asia/Manila');


			MYSQL_INSERT("taxi_change_oil","t_id,odo,tco_date",$_POST['id_tb'].",".$_SESSION[$sess_name.'_0_0'].",'".Date("Y-m-d H:i:s")."'");





			$sess_name11 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


			MYSQL_SELECT("select body_no from taxi where t_id=". $_POST['id_tb'],$sess_name11,0);


			include("logs.php");
			log_add("Changed oil a taxi. Body no: ".str_replace("'", "''",$_SESSION[$sess_name11.'_0_0'])." / ID: ". $_POST['id_tb']);



			$_SESSION['success'] = "Success!";
			header("location:../taxi_change_oil.php?id=".$_POST['id_tb']);

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../taxi_change_oil.php?id=".$_POST['id_tb']);
	}
}
else
{
	header("location:../index.php");
}










?>