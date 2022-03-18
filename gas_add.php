<?php


		session_start();


		if(!$_POST)
		{
			header("location:index.php");
		}
		else
		{
			if(!isset($_POST['gas_amount_tb']) || !isset($_POST['odo_tb']))
			{
				header("location:index.php");
			}
			else
			{
				$_SESSION['gas_amount_tb'] = $_POST['gas_amount_tb'];
				$_SESSION['odo_tb'] = $_POST['odo_tb'];

			}


			if(isset($_SESSION['gas_taxi_id']) && isset($_SESSION['gas_driver_id']))
			{

			}
			else
			{
				header("location:index.php");
			}
		}


		include("functions/db.php");
		 include("includes/utils.php");

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISGASBOY()==true)
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

<title>Taxi System - Gas Boy/Girl - Add</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>
<link rel='stylesheet' href='css_/gas.css'>


</head>


<body>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>

	<?php include("includes/gas_nav.php"); PRINT_NAV(); ?>









	
	<div id='body_div'>



		
		<hr>
		<br>





		<?php


			


			if(isset($_SESSION['gas_driver_id']))
			{



					$sess_name4 = "data4_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row = 0;

		    
		    		$row = MYSQL_SELECT("select * from driver where d_id=".$_SESSION['gas_driver_id'],$sess_name4,9);

					 if($row != 0)
					 {
					 	echo "
						 	<h4><b>Selected Driver</b></h4>

							<table class='table table-striped' id='selected_table'>

								<thead style='color:white;'>
							      <tr>
							      	<th>Profile Pic</th>
							        <th>Full Name</th>
							        <th>Address</th>
							        <th>Driver Classification</th>
							      </tr>
							    </thead>

							    <tbody>
					    		";
					 	}

				

				    	for($x=0;$x<$row;$x++)
				    	{

				    		$sess_name5 = "data5_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				    		MYSQL_SELECT("select dc_text from driver_class where dc_id=".$_SESSION[$sess_name4.'_'.$x.'_9'],$sess_name5,0);

				    		echo "<tr>";

				    		if($_SESSION[$sess_name4.'_'.$x.'_8'] != "")
				    		{
				    			echo "<td><img class='img-responsive' src='img/profile_pic/".$_SESSION[$sess_name4.'_'.$x.'_8']."' height=\"100px\" width=\"100px\"/></td>";
				    		}
				    		else
				    		{
				    			echo "<td>No Image</td>";
				    		}
				    		

				    		
				    		
				    		echo "
				    		<td>".$_SESSION[$sess_name4.'_'.$x.'_1']." ".$_SESSION[$sess_name4.'_'.$x.'_2']." ".$_SESSION[$sess_name4.'_'.$x.'_3']."</td>
				    		<td>".$_SESSION[$sess_name4.'_0_6']."</td>
				    		<td>".$_SESSION[$sess_name5.'_0_0']."</td>
				    		</tr>";
				    	}

				    	
					   if($row != 0)
					   {

					   	echo "
					    	
					    </tbody>
					  
						</table>
						";


					 	}


			}




			if(isset($_SESSION['gas_taxi_id']))
			{



					$sess_name9 = "data9_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row3 = 0;

		    
		    		$row3 = MYSQL_SELECT("select * from taxi where t_id=".$_SESSION['gas_taxi_id'],$sess_name9,4);

					 if($row3 != 0)
					 {
					 	echo "
						 	<h4><b>Selected Taxi</b></h4>

							<table class='table table-striped' id='selected_table'>

								<thead style='color:white;'>
							      <tr>
							      	<th>Body no</th>
							        <th>Plate no</th>
							        <th>Taxi Classification</th>
							        
							        <th>Action</th>
							      </tr>
							    </thead>

							    <tbody>
					    		";
					 	}

				

				    	for($x=0;$x<$row3;$x++)
				    	{

				    		$sess_name10 = "data10_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				    		MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=".$_SESSION[$sess_name9.'_'.$x.'_4'],$sess_name10,1);

				    		echo "<tr>
				    		<td>".$_SESSION[$sess_name9.'_'.$x.'_1']."</td>
				    		<td>".$_SESSION[$sess_name9.'_'.$x.'_2']."</td>
				    		<td>".$_SESSION[$sess_name10.'_0_0']."</td>
				    		
				    		<td><a href='gas.php?taxiremove=".$_SESSION[$sess_name9.'_'.$x.'_0']."'><button type='button' id='_buttons' class='btn-danger'>Remove</button></a></td>
				    		</tr>";
				    	}

				    	
					   if($row3 != 0)
					   {

					   	echo "
					    	
					    </tbody>
					  
						</table>
						";


					 	}


			}




		?>



		<br>
		<br>
		<hr>
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



			//GET TOTAL TRIP


			$sess_name11 = "data11_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			MYSQL_SELECT("select odo from gas where t_id=".$_SESSION['gas_taxi_id'] . " order by g_id desc limit 1",$sess_name11,0);

			$total_trip = 0;
			$gas_needed = 0;


			if(isset($_SESSION[$sess_name11.'_0_0']))
			{
				$total_trip = $_POST['odo_tb'] - $_SESSION[$sess_name11.'_0_0'];
			}


			if($total_trip != 0)
			{
				$gas_needed = number_format($total_trip / 10,2) . " liters";	//GAS RATIO 10liters:1Km
			}
			else
			{
				$total_trip = "Cannot measure.";
				$gas_needed = "Cannot measure.";
			}


			echo "


				<form action='functions/gas_add.php' method='post'>
					<div class='form-group'>
						<label id='search_label'>No. of liters</label>
						<input type='number' step='any' name='gas_amount_tb' id='search_box' class='form-control' value='".$_POST['gas_amount_tb']."' readonly/>
					</div>

					<div class='form-group'>
						<label id='search_label'>ODO</label>
						<input type='number' step='any' name='odo_tb' id='search_box' class='form-control' value='".$_POST['odo_tb']."' readonly/>
					</div>


					<div class='form-group'>
						<label id='search_label'>Total Trip</label>
						<input type='text' name='total_trip_tb' id='search_box' class='form-control' value='".$total_trip."' readonly/>
					</div>


					<div class='form-group'>
						<label id='search_label'>Expected no. of liters</label>
						<input type='text' name='gas_needed' id='search_box' class='form-control' value='".$gas_needed."' readonly/>
					</div>

					<div class='form-group'>
						<label id='search_label'>Pump No.</label> 

							<input type='text' name='tank_no' id='search_box' class='form-control' value='".$_POST['tank_no']."' readonly/>

					</div>

					<center><h4>Please confirm.</h4></center>
				
					<center><input type='submit' value='Confirm' class='btn-success' style='padding:20px 40px 20px 40px' /></center>


				</form>

				<br>

				<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"gas.php\"'>Go Back</button></center>


				";

				


		?>




		
	</div>


	
	<br>
	<br>
	<br>
	<br>



</body>


</html>