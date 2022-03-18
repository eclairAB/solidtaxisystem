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

<title>Taxi System - Admin - Taxi</title>
	
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
	<div class="container">

		<button id='menu_buttons' onclick='window.location.href="encoder.php"'><font face="arial" size="6"><b>HOME</b></font></button>
	
	</div>
	<br>
	
	<div class='container'>


		<form action='taxi.php' method ='get'>

			<div class='form-group'>
						<label>Search here</label>
						<input type='text' name='search' class='form-control' placeholder="Taxi body no or plate no" requried>
			</div>

		</form>

		<br>



		



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

		if(ISADMIN()==true)
		{
			echo "<h4><b>Add New Taxi</b></h4>
				<button style='color:black!important' onclick='window.location.href=\"taxi_add.php\"'>Add New</button>
				<br>
				<br>";
		}

		

		?>

		<h4><b>Add New Taxi</b></h4>
		<button style='color:black!important' onclick='window.location.href="en-taxi_add.php"'>Add New</button>
		<br>
		<br>

		<h4><b>List of Taxi</b></h4>

		<table class='table table-striped'>

			<thead>
		      <tr>
		      	<th>Body no</th>
		        <th>Plate no</th>
		        <th>Date Acquired</th>
		        <th>Taxi Classification</th>
		        <th>Rental Price</th>
		        <th>Status</th>
		        <th>Maintenance</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <tbody>


		    	<?php 

		    	include("functions/db.php");
		    	include("includes/utils.php");

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	$query = "select * from taxi";




		    	if(isset($_GET['search']))
		    	{
		    		$search_this = str_replace("'", "''", $_GET['search']); 

		    		$query = "select * from taxi where CONCAT(body_no,plate_no) like '%".$search_this."%'";
		    	}
		    	



		    	



		    	$row = MYSQL_SELECT($query,$sess_name,4);


		    	

		    	for($x=0;$x<$row;$x++)
		    	{

		    		$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    		MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=".$_SESSION[$sess_name.'_'.$x.'_4'],$sess_name2,1);



		    		$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x;

		    		MYSQL_SELECT("select out_time from in_out where t_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " order by io_id desc limit 1",$sess_name3,0);


		    			$ok2 = true;


		    					if(isset($_SESSION[$sess_name3.'_0_0']))
								{
									if($_SESSION[$sess_name3.'_0_0']=="0000-00-00 00:00:00")
									{
										$ok2 = false;
									}
								}
								else
								{


									$sess_name333 = "data333_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x;
									$row3 = 0;
									$row3 = MYSQL_SELECT("select out_time from in_out where t_id=".$_SESSION[$sess_name.'_'.$x.'_0'],$sess_name333,0);

									if($row3 != 0)
									{
										$ok2 = false;
									}

									
								}








		    		echo "<tr>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_1']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_2']."</td>
		    		<td>".DateNumToText($_SESSION[$sess_name.'_'.$x.'_3'])."</td>
		    		<td>".$_SESSION[$sess_name2.'_0_0']."</td>
		    		<td>".number_format($_SESSION[$sess_name2.'_0_1'],2)."</td>";

		    		if($ok2==true)
		    		{
		    			echo "<td style='color:green'>Available</td>";
		    		}
		    		else
		    		{
		    			echo "<td style='color:red'>Not Available</td>";
		    		}


		    		$ok3 = true;

		    		$sess_name3000 = "data3000_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x;

		    		MYSQL_SELECT("select odo from taxi_change_oil where t_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " order by tco_id desc limit 1",$sess_name3000,0);


		    		if(isset($_SESSION[$sess_name3000.'_0_0']))
		    		{
		    			$sess_name3001 = "data3001_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x;

		    			MYSQL_SELECT("select odo from gas where t_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " order by g_id desc limit 1",$sess_name3001,0);


		    			if($_SESSION[$sess_name3001.'_0_0'] - $_SESSION[$sess_name3000.'_0_0'] >= 10000)
		    			{
		    				$ok3 = false;
		    			}


		    		}


		    		if($ok3==true)
		    		{
		    			echo "<td style='color:green'>OK</td>";
		    		}
		    		else
		    		{
		    			echo "<td style='color:red'>Need Change Oil</td>";
		    		}



		    		echo "
		    		<td>"; if(ISADMIN()==true){echo "<a href='taxi_edit.php?id=".$_SESSION[$sess_name.'_'.$x.'_0']."'>Edit</a> | ";} echo "<a href='taxi_details.php?id=".$_SESSION[$sess_name.'_'.$x.'_0']."'>Details</a></td>
		    		</tr>";
		    	}

		    	?>

		    	
		    </tbody>

		</table>

		<?php

		if(ISADMIN()==true)
		{
			echo "<h4><b>Add New Taxi</b></h4>
				<button style='color:black!important' onclick='window.location.href=\"en-taxi_add.php\"'>Add New</button>
				<br>
				<br>";
		}

		

		?>

		<h4><b>Add New Taxi</b></h4>
		<button style='color:black!important' onclick='window.location.href="en-taxi_add.php"'>Add New</button>
		<br>
		<br>

		
	</div>


	




</body>


</html>