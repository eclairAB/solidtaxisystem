
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['username_tb']) && isset($_POST['password_tb']) && isset($_POST['first_name_tb'])&& isset($_POST['middle_name_tb'])&& isset($_POST['last_name_tb']))
	{

		$ok = true;

		if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $_POST['username_tb']))
		{	
			$ok = false;
			$_SESSION['error'] = "Invalid username.";
			header("location:../accounts_add.php");
		}

		if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $_POST['password_tb']))
		{	
			$ok = false;
			$_SESSION['error'] = "Invalid password.";
			header("location:../accounts_add.php");
		}




		$_POST['first_name_tb'] = str_replace("'", "''", $_POST['first_name_tb']);
		$_POST['middle_name_tb'] = str_replace("'", "''", $_POST['middle_name_tb']);
		$_POST['last_name_tb'] = str_replace("'", "''", $_POST['last_name_tb']);

		$_POST['position_cb'] = str_replace("'", "''", $_POST['position_cb']);


		$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		MYSQL_SELECT("select ac_id from account_class where ac_text = '".$_POST['position_cb']."'",$sess_name,0);



		if($ok == true)
		{
			MYSQL_INSERT("account","f_name,m_name,l_name,username,password,ac_id","'".$_POST['first_name_tb']."','".$_POST['middle_name_tb']."','".$_POST['last_name_tb']."','".$_POST['username_tb']."','".$_POST['password_tb']."',".$_SESSION[$sess_name.'_0_0']);

			include("logs.php");
			log_add("Added a new ". $_POST['position_cb']." account. Account Name: ".$_POST['first_name_tb']." ".$_POST['middle_name_tb']." ".$_POST['last_name_tb']."");


			$_SESSION['success'] = "Account added.";
			header("location:../accounts.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../accounts_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>