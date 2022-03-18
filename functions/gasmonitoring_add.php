
<?php

session_start();
require_once("db.php");

if($_POST)
{


	if(isset($_POST['amount_tb']))
	{

		$ok = true;

		$_POST['maintenance_job_tb'] = str_replace("'", "''", $_POST['maintenance_job_tb']);

		if(empty($_POST['amount_tb']) || empty($_POST["tank_no_tb"]))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../gasmonitoring.php");
			exit();
		}

		if(!is_numeric($_POST['amount_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Invalid Gas Amount.";
			header("location:../gasmonitoring.php");
			exit();
		}

		
		if($_POST['tank_no_tb'] != "1" && $_POST['tank_no_tb'] != "2")
		{
			$ok = false;
			$_SESSION['error'] = "Invalid Tank Number.";
			header("location:../gasmonitoring.php");
			exit();
		}

		if($ok == true)
		{
			$DB = DB();

			$query = "
					INSERT into gas_monitoring(gas_amount,monitored_date,tank_no)
					VALUES (:gas_amount,NOW(),:tank_no)
					";

			$insertQuery = $DB->prepare($query);
			$insertQuery->bindParam("gas_amount", $_POST["amount_tb"]);
			$insertQuery->bindParam("tank_no", $_POST["tank_no_tb"]);
			$insertQuery->execute();

			require_once("logs.php");
			log_add("Added a gas reading. Gas Amount: ".$_POST["amount_tb"].", Tank No: ".$_POST["tank_no_tb"].", Reading ID: ".$DB->lastInsertId());

			$_SESSION['success'] = "Gas Reading Added.";
			header("location:../gasmonitoring.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../gasmonitoring.php");
	}
}
else
{
	header("location:../index.php");
}



?>