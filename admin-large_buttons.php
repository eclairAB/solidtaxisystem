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

<!-- <link rel='stylesheet' href='css/bootstrap.min.css'> -->
<link rel='stylesheet' href='css_/admin.css'>


<script type="text/javascript">
	
	$(function () {
  					$('[data-toggle="tooltip"]').tooltip()
				})
</script>


</head>


<body>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div><br>



<center>
  <button class='btn btn-primary btn-lg' onclick='window.location.href="driverclassification.php"' data-toggle="tooltip" data-placement="top" title="Add Driver Classification">Accounts</button>

  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown">
    Driver <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#">Driver Details</a></li>
      <li><a href="#">Driver Classifications</a></li>
      <li><a href="#">Driver Statistics</a></li>
    </ul>
  </div>

    <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown">
    Taxi <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#">Taxi Details</a></li>
      <li><a href="#">Taxi Classifications</a></li>
    </ul>
  </div>

	<button class='btn btn-primary btn-lg' onclick='window.location.href="driverclassification.php"' data-toggle='tooltip' data-placement='top' title="Add Driver Classification">Products</button>


	<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown">
    Gas <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#">Gas Price</a></li>
      <li><a href="#">Gas Tank Details</a></li>
      <li><a href="#">Daily Gas Inventory</a></li>
    </ul>
  	</div>

	<button class='btn btn-primary btn-lg' onclick='window.location.href="driverclassification.php"' data-toggle='tooltip' data-placement='top' title="Add Maintenance">Maintenance</button>


	<button class='btn btn-primary btn-lg' onclick='window.location.href="driverclassification.php"' data-toggle='tooltip' data-placement='top' title="Add Maintenance">Report</button>

	<button class='btn btn-primary btn-lg' onclick='window.location.href="driverclassification.php"' data-toggle='tooltip' data-placement='top' title="Add Maintenance">Logs</button>
</center>




<hr>

	<br>
	<br>
	<br>

	<div class='container'>


		<div class='col-sm-3' id='grid'>

			<center><h3>Accounts</h3></center>
			<br>

			<button id='menu_buttons' class='btn btn-primary btn-lg' onclick='window.location.href="accounts.php"' data-toggle="tooltip" data-placement="top" title="Add User Accounts">Accounts</button>
			<br><br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driverclassification.php"' data-toggle="tooltip" data-placement="top" title="Add Driver Classification">Driver Classification</button>
			<br><br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driver.php"' data-toggle="tooltip" data-placement="bottom" title="Driver Accounts">Driver</button>
		</div>



		<div class='col-sm-3' id='grid'>

			<center><h3>Driver</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driverclassification.php"' data-toggle="tooltip" data-placement="top" title="Add Driver Classification">Driver Classification</button>
			<br>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="driver.php"' data-toggle="tooltip" data-placement="bottom" title="Driver Accounts">Driver</button>



		</div>

		<div class='col-sm-3' id='grid'>

			<center><h3>Taxi</h3></center>
			<br>

			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="taxiclassification.php"' data-toggle="tooltip" data-placement="top" title="Add Taxi Classification">Taxi Classification</button>
			<br>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="taxi.php"' data-toggle="tooltip" data-placement="bottom" title="Detailed Taxi Information">Taxi</button>

		</div>


		<div class='col-sm-3' id='grid'>

			<center><h3>Products</h3></center>
			<br>
			<button class='btn btn-primary btn-lg' id='menu_buttons' onclick='window.location.href="products.php"' data-toggle="tooltip" data-placement="top" title="List of Products">Products</button>
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