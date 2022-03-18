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

<title>Taxi System - Admin - Gas Price</title>
	
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
		



		<?php


			include("functions/db.php");

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	MYSQL_SELECT("select gp_price from gas_price",$sess_name,0);


		    	echo "<h4><b>Current Gas Price: ".$_SESSION[$sess_name.'_0_0']."</b></h4>";


		?>

		<br>
		<br>

		<h4 style="color:red;"><b>Update Gas Price</b></h4>

		<form class='form' action='functions/gas_price.php' method='post'>

			<div class='form-group'>
				<label>Gas Price</label>
				<input type='number' step='any' name='gas_price_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_0']; ?>' required/>
			</div>

			<input type='submit' value='Update Price'/>

		</form>

		
	</div>


	




</body>


</html>