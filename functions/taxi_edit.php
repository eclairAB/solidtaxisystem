
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['body_no_tb']) && isset($_POST['plate_no_tb']) && isset($_POST['start_date_tb'])&& isset($_POST['taxi_classification_cb']) && isset($_POST['id_tb']))
	{

		$ok = true;


		$_POST['body_no_tb'] = str_replace("'", "''", $_POST['body_no_tb']);
		$_POST['plate_no_tb'] = str_replace("'", "''", $_POST['plate_no_tb']);
		$_POST['taxi_classification_cb'] = str_replace("'", "''", $_POST['taxi_classification_cb']);
		$_POST['start_date_tb'] = str_replace("'", "''", $_POST['start_date_tb']);


		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../taxi_edit.php?id=".$_POST['id_tb']);
		}



		$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		MYSQL_SELECT("select tc_id from taxi_class where tc_text = '".$_POST['taxi_classification_cb']."'",$sess_name,0);



		if($ok == true)
		{


				MYSQL_UPDATE("update taxi set body_no='".$_POST['body_no_tb']."',plate_no='".$_POST['plate_no_tb']."',start_date='".$_POST['start_date_tb']."',tc_id=".$_SESSION[$sess_name.'_0_0']." where t_id=".$_POST['id_tb']);

				include("logs.php");
				log_add("Updated a taxi. Body no: ".$_POST['body_no_tb'] . " / Plate no: " . $_POST['plate_no_tb'] . " / ID: ". $_POST['id_tb']);


				$_SESSION['success'] = "Taxi Updated.";
				header("location:../taxi.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../taxi_edit.php?id=".$_POST['id_tb']);
	}
}
else
{
	header("location:../index.php");
}



?>