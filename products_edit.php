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


				MYSQL_SELECT("select * from products where p_id=".$_GET['id'],$sess_name,2);

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

<title>Taxi System - Admin - Products - Edit</title>
	
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

		

		<h4><b>Edit Product</b></h4>

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
		
		<form action='functions/products_edit.php' method='post'>


					<input type='hidden' name='id_tb' class='form-control' value='<?php echo $_GET['id']; ?>' />

					<div class='form-group'>
						<label>Product</label>
						<input type='text' name='product_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_1']; ?>' requried/>
					</div>

					<div class='form-group'>
						<label>Price</label>
						<input type='number' step="any" name='price_tb' class='form-control' value='<?php echo $_SESSION[$sess_name.'_0_2']; ?>'  requried/>
					</div>

			

					<div class='form-group'>
						<input type='submit' class='form-control' value='Update Product'/>
					</div>
					
		</form>

		
	</div>


	




</body>


</html>