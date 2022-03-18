
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['maintenance_job_tb']))
	{

		$ok = true;

		$_POST['maintenance_job_tb'] = str_replace("'", "''", $_POST['maintenance_job_tb']);

		if(empty($_POST['maintenance_job_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../maintenance_add.php");
		}


		if($ok == true)
		{
			MYSQL_INSERT("taxi_maintenance_jobs","tmp_text","'".$_POST['maintenance_job_tb']."'");

			include("logs.php");
			log_add("Added a maintenance job. Maintenance Job: ".$_POST['maintenance_job_tb']);

			$_SESSION['success'] = "Maintenance Job added.";
			header("location:../maintenance.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../maintenance_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>