
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['username_tb']) && isset($_POST['password_tb']))
	{

		$ok = true;

		if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $_POST['username_tb']))
		{	
			$ok = false;
			$_SESSION['error'] = "Invalid username.";
			header("location:../index.php");
		}

		if(!preg_match("/^[a-zA-Z0-9]{1,}$/", $_POST['password_tb']))
		{	
			$ok = false;
			$_SESSION['error'] = "Invalid password.";
			header("location:../index.php");
		}

		if($ok == true)
		{
			MYSQL_SELECT("select * from account where username='".$_POST['username_tb']."' && password='".$_POST['password_tb']."'","login_details",6);

			if(isset($_SESSION['login_details_0_0']))
			{
				if($_SESSION['login_details_0_0'] != 0)
				{


						MYSQL_SELECT("select ac_text from account_class where ac_id=" . $_SESSION['login_details_0_6'],"login_position",0);

						include("logs.php");
						log_add("Login");
						

						header("location:../redirect.php");
				}
				else
				{
					$_SESSION['error'] = "Incorrect username or password.";
					header("location:../index.php");
				}
			}
			else
			{
				$_SESSION['error'] = "Incorrect username or password.";
				header("location:../index.php");
			}
		}

	}
	else
	{
		$_SESSION['error'] = "Incorrect username or password.";
		header("location:../index.php");
	}
}
else
{
	header("location:../index.php");
}



?>