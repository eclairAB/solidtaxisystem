<?php

session_start();
include("includes/isloggedin.php");


if(ISLOGGEDIN()==true)
{
	include("functions/db.php");
	include("functions/logs.php");
	log_add("Logout");

	for($x=0;$x<=6;$x++)
	{
		unset($_SESSION['login_details_0_'.$x]);
	}

	unset($_SESSION['login_position_0_0']);
}

session_destroy();

header("location:index.php");

?>