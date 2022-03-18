
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['maintenance_job_tb']) && isset($_POST['id_tb']))
	{

		$ok = true;

		$_POST['maintenance_job_tb'] = str_replace("'", "''", $_POST['maintenance_job_tb']);

		if(empty($_POST['maintenance_job_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Please fill up all field(s).";
			header("location:../maintenance.php");
		}


		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../maintenance.php");
		}



		if($ok == true)
		{
			MYSQL_UPDATE("update taxi_maintenance_jobs set tmp_text='".$_POST['maintenance_job_tb']."' where tmp_id=".$_POST['id_tb']);

			include("logs.php");
			log_add("Updated a maintenance job. Maintenance Job: ".$_POST['maintenance_job_tb'] . " / ID: " . $_POST['id_tb']);

			$_SESSION['success'] = "Maintenance Job updated.";
			header("location:../maintenance.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../maintenance.php");
	}
}
else
{
	header("location:../index.php");
}



?>