<?php


		session_start();


		include("functions/db.php");
		 include("includes/utils.php");

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISCASHIER()==true)
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

<title>Taxi System - Casier</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>
<link rel='stylesheet' href='css_/gas.css'>


<link rel="stylesheet" href="plugins/jquery.numpad.css">
<script type="text/javascript" src="plugins/jquery.numpad.js"></script>


</head>


<body>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>

	<?php include("includes/cashier_nav.php"); PRINT_NAV(); ?>









	
	<div id='body_div'>


		<form class='daily-report-custom-form' action='functions/dailyreport.php' method='post'>
			<input type="date" name='date' required>
			<button type='submit' name='submit' style='color:black!important;padding:20px' class='btn-default'>Show Report</button>
		</form>

		
	</div>


	




</body>


</html>