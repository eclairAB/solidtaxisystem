<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true)
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

<title>Taxi System - Admin</title>
	
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


	<br>
	<br>
	<br>

	<div class='container'>


		<div class='col-sm-3' id='grid'>

			<center><h3>Accounts</h3></center>
			<br>

			<button id='menu_buttons' class='btn btn-primary btn-lg' onclick='window.location.href="accounts.php"'>Accounts</button>

		</div>



		<div class='col-sm-3' id='grid'>

			<center><h3>Driver</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driverclassification.php"'>Driver Classification</button>
			<br>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driver.php"'>Driver</button>



		</div>

		<div class='col-sm-3' id='grid'>

			<center><h3>Taxi</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="taxiclassification.php"'>Taxi Classification</button>
			<br>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="taxi.php"'>Taxi</button>

		</div>


		<div class='col-sm-3' id='grid'>

			<center><h3>Products</h3></center>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="products.php"'>Products</button>
		</div>

	
	</div>


	<div class='container'>

		<div class='col-sm-3' id='grid'>
			<center><h3>Gas</h3></center>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="gasprice.php"'>Gas Price</button>
			<br><br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="gas_inventory.php"'>Gas Inventory</button>
		</div>

		<div class='col-sm-3' id='grid'>

			<center><h3>Maintenance</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="maintenance.php"'>Maintenance</button>



		</div>

		<div class='col-sm-3' id='grid'>

			<center><h3>Reports</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="report.php"'>Reports</button>
			<br><br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driver_stats.php"'>Driver Stats</button>
			<br><br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="gasmonreport.php"'>Gas Monitoring</button>

		</div>


		<div class='col-sm-3' id='grid'>

			<center><h3>Logs</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="logs.php"'>View Logs</button>

		</div>

		

	</div>




</body>


</html>