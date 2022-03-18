<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true || ISENCODER())
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

<title>Taxi System - Admin - Taxi - Add</title>
	
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
		<div class="container">

		<button id='menu_buttons' onclick='window.location.href="en-taxi.php"'><font face="arial" size="6"><b><< BACK</b></font></button>
	
	</div>

	<br>

	
	<div class='container'>

		

		<h4><b>Add New Taxi</b></h4>

		<?php
			if(isset($_SESSION['error']))
			{
				echo "<br><p style='color:red'>".$_SESSION['error']."</p><br>";
				unset($_SESSION['error']);
			}

			if(isset($_SESSION['success']))
			{
				echo "<br><p style='color:green'>".$_SESSION['success']."</p><br>";
				unset($_SESSION['success']);
			}

		?>
		
		<form action='functions/en_taxi_add.php' method='post' enctype="multipart/form-data">
					<div class='form-group'>
						<label>Body no</label>
						<input type='text' name='body_no_tb' class='form-control' requried/>
					</div>

					<div class='form-group'>
						<label>Plate no</label>
						<input type='text' name='plate_no_tb' class='form-control' requried/>
					</div>

					<div class='form-group'>
						<label>Date Acquired</label>
						<input type='date' name='start_date_tb' class='form-control' requried/>
					</div>


					<div class='form-group'>
						<label>Taxi Classification</label>

						<select name='taxi_classification_cb' class='form-control'>

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
						<input type='submit' class='form-control' value='Add Taxi'/>
					</div>
					
		</form>

		
	</div>


	




</body>


</html>