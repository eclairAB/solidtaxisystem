<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISENCODER() == true)
			{

			}
			else
			{
				header("location:index.php");
			}
		}
		else
		{
			header("location:index.php");
		}

?>


<!DOCTYPE html>

<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}

.row {
    display: flex;
}

/* Create two equal columns that sits next to each other */
.column {
    flex: 50%;
    padding: 10px;
    /* height: 300px; Should be removed. Only for demonstration */
}
</style>

<title>Taxi System - Taxi</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>


</head>


<body>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>


		<center><h3>Select Category</h3></center>
		<br>




<div class="row">
  <div class="column" style="background-color:#aaa;">
		<button id='menu_buttons' onclick='window.location.href="en-driver.php"'>Driver</button>
  </div>
  <div class="column" style="background-color:#aaa;">
		<button id='menu_buttons' onclick='window.location.href="en-taxi.php"'>Taxi</button>
  </div>
</div>


</body>


</html>