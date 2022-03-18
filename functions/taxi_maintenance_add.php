
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['maintenance_job']) && isset($_POST['remarks_tb']) && isset($_POST['id_tb']))
	{

		$ok = true;

		$_POST['maintenance_job'] = str_replace("'", "''", $_POST['maintenance_job']);
		$_POST['remarks_tb'] = str_replace("'", "''", $_POST['remarks_tb']);
		$_POST['others_tb'] = str_replace("'", "''", $_POST['others_tb']);



		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../taxi.php");
		}




		if(empty($_POST['maintenance_job']))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);
		}



		$_POST['remarks_tb'] = str_replace("'", "''", $_POST['remarks_tb']);

		if(empty($_POST['remarks_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);
		}

		if(empty($_POST['job_order_number_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);
		}
		
		if(empty($_POST['amount_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);
		}
		else{
			if(!is_numeric($_POST['amount_tb'])){
				$ok = false;
				$_SESSION['error'] = "Invalid amount.";
				header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);
			}
		}


		if($ok == true)
		{


			$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


			MYSQL_SELECT("select tmp_id from taxi_maintenance_jobs where tmp_text='".$_POST['maintenance_job']."'",$sess_name,0);



			date_default_timezone_set('Asia/Manila');


			MYSQL_INSERT("taxi_maintenance","t_id,tmp_id,remarks,tm_date,job_order_number,others,amount",$_POST['id_tb'].
			",".$_SESSION[$sess_name.'_0_0'].",'".$_POST['remarks_tb']."','".Date("Y-m-d H:i:s")."','".$_POST["job_order_number_tb"]."','".$_POST["others_tb"]."'," . $_POST["amount_tb"]);


			$sess_name11 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


			MYSQL_SELECT("select body_no from taxi where t_id=". $_POST['id_tb'],$sess_name11,0);


			include("logs.php");
			log_add("Added a taxi maintenance. Body no: ".str_replace("'", "''",$_SESSION[$sess_name11.'_0_0'])." / ID: ". $_POST['id_tb']);


			$_SESSION['success'] = "Maintenance added.";
			header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../taxi_maintenance.php?id=".$_POST['id_tb']);
	}
}
else
{
	header("location:../index.php");
}



?>