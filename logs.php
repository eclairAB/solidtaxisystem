<?php


		session_start();

		include("includes/isloggedin.php");
		include("functions/db.php");

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

<title>Taxi System - Admin - Logs</title>
	
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


		<center><h1>LOGS</h1></center>

		<br>
		<br>

		<form action='logs_view.php' method ='post'>

						<div class='form-group'>
									<label>From</label>
									<input type='date' name='datefrom' class='form-control' requried/>
									
						</div>

						<div class='form-group'>
							<label>To</label>
							<input type='date' name='dateto' class='form-control'/>
						</div>


						<div class='form-group'>

						<label>Account Classification</label>

							<select name='account_class_cb' class='form-control'>

								<option>All</option>

								<?php
									

									$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

									$row = MYSQL_SELECT("select ac_text from account_class",$sess_name,0);


									for($x=0;$x<$row;$x++)
									{
										echo "<option>".$_SESSION[$sess_name.'_'.$x.'_0']."</option>";
									}
								?>

								

							</select>
						</div>


						<div class='form-group'>

							<label>Specific Account</label>

							<select name='account_cb' class='form-control'>

								<option>All</option>

								<?php

									$sess_name1 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

									$row1 = MYSQL_SELECT("select f_name,m_name,l_name from account",$sess_name1,2);


									for($x=0;$x<$row1;$x++)
									{
										echo "<option>".$_SESSION[$sess_name1.'_'.$x.'_0'] . " " . $_SESSION[$sess_name1.'_'.$x.'_1'] . " ".$_SESSION[$sess_name1.'_'.$x.'_2']."</option>";
									}
								?>

								

							</select>
						</div>

					


						


						
						<input type='submit' value='Proceed'/>

		</form>
		
	</div>


	




</body>


</html>