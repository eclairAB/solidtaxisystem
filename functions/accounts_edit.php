
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['username_tb']) && isset($_POST['password_tb']) && isset($_POST['first_name_tb'])&& isset($_POST['middle_name_tb'])&& isset($_POST['last_name_tb']) && isset($_POST['id_tb']))
	{

		$ok = true;

		if(!preg_match("/^[0-9]{1,}$/", $_POST['id_tb']))
		{
			$ok = false;
			$_SESSION['error'] = "Error.";
			header("location:../accounts_edit.php?id=".$_POST['id_tb']);
		}

		if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $_POST['username_tb']))
		{	
			$ok = false;
			$_SESSION['error'] = "Invalid username.";
			header("location:../accounts_edit.php?id=".$_POST['id_tb']);
		}

		if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $_POST['password_tb']))
		{	
			$ok = false;
			$_SESSION['error'] = "Invalid password.";
			header("location:../accounts_edit.php?id=".$_POST['id_tb']);
		}




		$_POST['first_name_tb'] = str_replace("'", "''", $_POST['first_name_tb']);
		$_POST['middle_name_tb'] = str_replace("'", "''", $_POST['middle_name_tb']);
		$_POST['last_name_tb'] = str_replace("'", "''", $_POST['last_name_tb']);

		$_POST['position_cb'] = str_replace("'", "''", $_POST['position_cb']);


		$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		MYSQL_SELECT("select ac_id from account_class where ac_text = '".$_POST['position_cb']."'",$sess_name,0);



		if($ok == true)
		{


			MYSQL_UPDATE("update account set f_name='".$_POST['first_name_tb']."',m_name='".$_POST['middle_name_tb']."',l_name='".$_POST['last_name_tb']."',username='".$_POST['username_tb']."',password='".$_POST['password_tb']."',ac_id=".$_SESSION[$sess_name.'_0_0']." where a_id=".$_POST['id_tb']);


			include("logs.php");
			log_add("Updated an account. Account Name: ".$_POST['first_name_tb']." ".$_POST['middle_name_tb']." ".$_POST['last_name_tb']." / ID: ".$_POST['id_tb']);
			

			$_SESSION['success'] = "Account updated.";
			header("location:../accounts.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../accounts_edit.php?id=".$_POST['id_tb']);
	}
}
else
{
	header("location:../index.php");
}



?>