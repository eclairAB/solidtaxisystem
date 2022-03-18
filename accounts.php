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

<title>Taxi System - Admin - Accounts</title>
	
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
		


		<h4><b>Add New Account</b></h4>
		<button style='color:black!important' onclick='window.location.href="accounts_add.php"'>Add New</button>
		<br>
		<br>

		<h4><b>List of Accounts</b></h4>

		<table class='table table-striped'>

			<thead style="background-color: #19194f; color: cyan;">
		      <tr>
		        <th>First Name</th>
		        <th>Middle Name</th>
		        <th>Last Name</th>
		        <th>Username</th>
		        <th>Password</th>
		        <th>Position</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <tbody>


		    	<?php 

		    	include("functions/db.php");

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	$row = MYSQL_SELECT("select * from account",$sess_name,6);

		    	for($x=0;$x<$row;$x++)
		    	{

		    		$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    		MYSQL_SELECT("select ac_text from account_class where ac_id=".$_SESSION[$sess_name.'_'.$x.'_6'],$sess_name2,0);

		    		echo "<tr>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_1']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_2']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_3']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_4']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_5']."</td>
		    		<td>".$_SESSION[$sess_name2.'_0_0']."</td>
		    		<td><a href='accounts_edit.php?id=".$_SESSION[$sess_name.'_'.$x.'_0']."'>Edit</a></td>
		    		</tr>";
		    	}

		    	?>

		    	
		    </tbody>

		</table>

		
	</div>


	




</body>


</html>