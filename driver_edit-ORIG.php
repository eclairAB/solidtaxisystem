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




		include("functions/db.php");


		if(isset($_GET['id']))
		{
			if(preg_match("/^[0-9]{1,}$/", $_GET['id']))
			{
				$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


				MYSQL_SELECT("select * from driver where d_id=".$_GET['id'],$sess_name,9);

				if(isset($_SESSION[$sess_name.'_0_0']))
				{
					if(empty($_SESSION[$sess_name.'_0_0']))
					{
						header("location:index.php");
					}
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
		}
		else
		{
			header("location:index.php");
		}

		



?>


<!DOCTYPE html>

<html>

<head>

<title>Taxi System - Admin - Driver - Edit</title>
	
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

	<?php include("includes/admin_nav.php"); PRINT_NAV(); ?>


	<br>
	<br>
	<br>

	
	<div class='container'>

		

		<h4><b>Edit Driver</b></h4>

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
		
		<form action='functions/driver_edit.php' method='post' enctype="multipart/form-data">


					<input type='hidden' name='id_tb' class='form-control' value='<?php echo $_GET['id']; ?>' />

					<div class='form-group'>
						<label>First Name</label>
						<input type='text' name='first_name_tb' class='form-control' value='<?php echo  $_SESSION[$sess_name.'_0_1'];?>' requried/>
					</div>

					<div class='form-group'>
						<label>Middle Name</label>
						<input type='text' name='middle_name_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_2'];?>' requried/>
					</div>

					<div class='form-group'>
						<label>Last Name</label>
						<input type='text' name='last_name_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_3'];?>' requried/>
					</div>

					<div class='form-group'>
						<label>Gender</label>
						<select name='gender_cb' class='form-control'>
							<option <?php if($_SESSION[$sess_name.'_0_4']=="Male"){echo "selected";} ?>>Male</option>
							<option <?php if($_SESSION[$sess_name.'_0_4']=="Female"){echo "selected";} ?>>Female</option>
						</select>
					</div>

					<div class='form-group'>
						<label>Birthdate</label>
						<input type='date' name='birthdate_tb' class='form-control'  value='<?php echo  $_SESSION[$sess_name.'_0_5'];?>' requried/>
					</div>

					<div class='form-group'>
						<label>Address</label>
						<input type='text' name='address_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_6'];?>' requried/>
					</div>

					<div class='form-group'>
						<label>Contact No</label>
						<input type='text' name='contact_no_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_7'];?>' requried/>
					</div>


					<div class='form-group'>

						<label>Profile picture:</label>
					    <input type="file" name="profilepic" id='profilepic' accept='image/*'>

					</div>


					<div class='form-group'>
						<label>Driver Classification</label>

						<select name='driver_classification_cb' class='form-control'>

							<?php

								$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

								$row = MYSQL_SELECT("select dc_id,dc_text from driver_class",$sess_name2,1);


								for($x=0;$x<$row;$x++)
								{
									if($_SESSION[$sess_name.'_0_9'] == $_SESSION[$sess_name2.'_'.$x.'_0'])
									{
										echo "<option selected>".$_SESSION[$sess_name2.'_'.$x.'_1']."</option>";
									}
									else
									{
										echo "<option>".$_SESSION[$sess_name2.'_'.$x.'_1']."</option>";
									}

								}
							?>

							

						</select>



					</div>

					<div class='form-group'>
						<input type='submit' class='form-control' value='Update Account'/>
					</div>
					
		</form>

		
	</div>


	




</body>


</html>