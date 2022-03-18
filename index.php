<?php
session_start();


		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			header("location:redirect.php");
		}

?>


<!DOCTYPE html>

<html>

<head>

<title>Taxi System - Login</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>



</head>


<body>
	
	<br>
	<br>
	<br>

	<center>
		<font size=7 color=#321ba8><b><u>SOLID EIGHTY-EIGHT</u></b></font><br>
		<font size=5>T a x i &nbsp;&nbsp;  S y s t e m</font>
		<br>
		<br>
		<br>

		<?php
			if(isset($_SESSION['error']))
			{
				echo "<p style='color:red'>".$_SESSION['error']."</p>";
				unset($_SESSION['error']);
			}
		?>

		<div class='row'>

			<div class='col-sm-4'>
			</div>

			<div class='col-sm-4'>
			
				<form action='functions/login.php' method='post'>
					<div class='form-group'>
						<label>Username</label>
						<input type='text' name='username_tb' class='form-control'/>
					</div>

					<div class='form-group'>
						<label>Password</label>
						<input type='password' name='password_tb' class='form-control'/>
					</div>

					<div class='form-group'>
						<input type='submit' class='form-control' value='Login'/>
					</div>
					
				</form>

			</div>

			<div class='col-sm-4'>
			</div>
		
		</div>

	</center>

</body>


</html>