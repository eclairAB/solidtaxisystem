<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true || ISREPORTS())
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

<title>Taxi System - Admin - Driver</title>
	
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

	<?php if(ISADMIN()==true){include("includes/admin_nav.php"); PRINT_NAV();} ?>

	



	<br>
	<br>
	<br>


	<?php

	if(isset($_SESSION['error']))
	{
				echo "<br><center><p style='color:red'>".$_SESSION['error']."</p></center><br>";
				unset($_SESSION['error']);
	}

	?>

	
	<div class='container'>

		<center><h1>REPORTS</h1></center>

		<br>
		<br>


		<form action='report_view.php' method ='post'>

						<div class='form-group'>
									<label>From</label>
									<input type='date' name='datefrom' class='form-control' requried/>
									
						</div>

						<div class='form-group'>
							<label>To</label>
							<input type='date' name='dateto' class='form-control'/>
						</div>


						<div class='form-group'>

						<label>Taxi Classification</label>

							<select name='taxi_classification_cb' class='form-control'>

								<option>All</option>

								<?php
									include("functions/db.php");

									$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

									$row = MYSQL_SELECT("select tc_text from taxi_class",$sess_name,0);


									for($x=0;$x<$row;$x++)
									{
										echo "<option>".$_SESSION[$sess_name.'_'.$x.'_0']."</option>";
									}
								?>

								

							</select>
						</div>



						<div class='form-group'>

						<label>Report Type</label>

							<select name='report_type_cb' class='form-control'>

								<option>Daily</option>
								<option>Monthly</option>
							

							</select>
						</div>


						<div class='form-group'>

						<label>Show No Rental Amount</label>

							<select name='show_no_taxi_rented_cb' class='form-control'>

								<option>Yes</option>
								<option>No</option>
							

							</select>
						</div>



						
						<input type='submit' value='Proceed'/>

		</form>
		
	</div>


	




</body>


</html>