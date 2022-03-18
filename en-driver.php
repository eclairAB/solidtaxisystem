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

<title>Taxi System - Admin - Driver</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>



    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

			<style>
				body{
					background-color: #bac6d1;
					overflow-x:hidden;
				}
			</style>


</head>


<body>


	<link rel='stylesheet' href='css_/custom.css'>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>


	<br>


	<div class="container">

		<button id='menu_buttons' onclick='window.location.href="encoder.php"'><font face="arial" size="6"><b>HOME</b></font></button>
	
	</div>
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
		

		<br>
		<h4><b>Add New Driver</b></h4>
		<button style='color:black!important' onclick='window.location.href="en-driver_add.php"'>Add New</button>
		<br>
		<br>

		<h4><b>List of Drivers</b></h4>

		<table class='table table-striped'>

			<thead>
		      <tr>
		      	<th>Profile Pic</th>
		        <th>First Name</th>
		        <th>Middle Name</th>
		        <th>Last Name</th>
		        <th>Gender</th>
		        <th>Birthday</th>
		        <th>Age</th>
		        <th>Address</th>
		        <th>Contact No</th>
		        <th>Driver Classification</th>
		        <th>Status</th>
		        <!-- <th>Action</th> -->
		      </tr>
		    </thead>

		    <tbody>


		    	<?php 

		    	include("functions/db.php");
		    	include("includes/utils.php");

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		    	if(isset($_GET['search']))
		    	{
		    		$search_this = str_replace("'", "''", $_GET['search']); 

		    		$row = MYSQL_SELECT("select * from driver where CONCAT(f_name,' ',m_name,' ',l_name) like '%".$_GET['search']."%'",$sess_name,9);
		    	}
		    	else
		    	{
		    		$row = MYSQL_SELECT("select * from driver",$sess_name,9);
		    	}


		    	

		    	for($x=0;$x<$row;$x++)
		    	{

		    		$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    		MYSQL_SELECT("select dc_text from driver_class where dc_id=".$_SESSION[$sess_name.'_'.$x.'_9'],$sess_name2,0);

		    		echo "<tr>";

		    		if($_SESSION[$sess_name.'_'.$x.'_8'] != "")
		    		{
		    			echo "<td><img class='img-responsive' src='img/profile_pic/".$_SESSION[$sess_name.'_'.$x.'_8']."' height=\"80px\" width=\"80px\"/></td>";
		    		}
		    		else
		    		{
		    			echo "<td>No Image</td>";
		    		}
		    		


		    		$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;

		    		MYSQL_SELECT("select out_time from in_out where d_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " order by io_id desc limit 1",$sess_name3,0);


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


									$sess_name333 = "data333_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') .$x;
									$row3 = 0;
									$row3 = MYSQL_SELECT("select out_time from in_out where d_id=".$_SESSION[$sess_name.'_'.$x.'_0'],$sess_name333,0);

									if($row3 != 0)
									{
										$ok2 = false;
									}

									
								}


		    		
		    		
		    		echo "
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_1']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_2']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_3']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_4']."</td>
		    		<td>".DateNumToText($_SESSION[$sess_name.'_'.$x.'_5'])."</td>
		    		<td>".BirthdayToAge($_SESSION[$sess_name.'_'.$x.'_5'])."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_6']."</td>
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_7']."</td>
		    		<td>".$_SESSION[$sess_name2.'_0_0']."</td>";

		    		if($ok2==true)
		    		{
		    			echo "<td style='color:green'>Available</td>";
		    		}
		    		else
		    		{
		    			echo "<td style='color:red'>Not Available</td>";
		    		}

/* 		    		echo "
		    		<td><a href='driver_edit.php?id=".$_SESSION[$sess_name.'_'.$x.'_0']."'>Edit</a> | <a href='driver_details.php?id=".$_SESSION[$sess_name.'_'.$x.'_0']."'>Details</a></td>
		    		</tr>"; */
		    	}

		    	?>

		    	
		    </tbody>

		</table>
		<br><br>
	</div>


	
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable({

            	"order": [[3, "asc"]],

            	"columnDefs": [
            		{
            			"targets": 2,
            			"visible": false
            		}
            	]

            });



        });

    </script>
	




</body>


</html>