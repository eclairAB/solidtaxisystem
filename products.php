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

<title>Taxi System - Admin - Products</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>
<link rel='stylesheet' href='css_/custom.css'>


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
		


		<h4><b>Add New Product</b></h4>
		<button style='color:black!important' onclick='window.location.href="products_add.php"'>Add New</button>
		<br>
		<br>

		<h4><b>List of Products</b></h4>

		<table class='table table-striped table-bordered'>

			<thead>
		      <tr>
		        <th>Product</th>
		        <th>Price</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <tbody>


		    	<?php 

		    	include("functions/db.php");

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	$row = MYSQL_SELECT("select * from products",$sess_name,2);

		    	for($x=0;$x<$row;$x++)
		    	{

		    		echo "<tr>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_1']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_2']."</td>
		    		<td><a href='products_edit.php?id=".$_SESSION[$sess_name.'_'.$x.'_0']."'>Edit</a></td>
		    		</tr>";
		    	}

		    	?>

		    	
		    </tbody>

		</table>

		
	</div>


	




</body>


</html>