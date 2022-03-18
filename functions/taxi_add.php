
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['body_no_tb']) && isset($_POST['plate_no_tb']) && isset($_POST['start_date_tb'])&& isset($_POST['taxi_classification_cb']))
	{


if(empty($_POST['body_no_tb']) ||
empty($_POST['plate_no_tb']) ||
empty($_POST['start_date_tb']) ||
empty($_POST['taxi_classification_cb']))
{
$_SESSION['error'] = "Please fill up all fields.";
header("location:../taxi_add.php");
exit();
}


		$ok = true;


		$_POST['body_no_tb'] = str_replace("'", "''", $_POST['body_no_tb']);
		$_POST['plate_no_tb'] = str_replace("'", "''", $_POST['plate_no_tb']);
		$_POST['taxi_classification_cb'] = str_replace("'", "''", $_POST['taxi_classification_cb']);
		$_POST['start_date_tb'] = str_replace("'", "''", $_POST['start_date_tb']);



		$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		MYSQL_SELECT("select tc_id from taxi_class where tc_text = '".$_POST['taxi_classification_cb']."'",$sess_name,0);



		if($ok == true)
		{


			
				MYSQL_INSERT("taxi","body_no,plate_no,start_date,tc_id","'".$_POST['body_no_tb']."','".$_POST['plate_no_tb']."','".$_POST['start_date_tb']."',".$_SESSION[$sess_name.'_0_0']);
				
				include("logs.php");
				log_add("Added a taxi. Body no: ".$_POST['body_no_tb'] . " / Plate no: " . $_POST['plate_no_tb']);


				$_SESSION['success'] = "Taxi added.";
				header("location:../taxi.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../taxi_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>