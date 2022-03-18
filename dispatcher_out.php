<?php


		session_start();


		include("functions/db.php");
		 include("includes/utils.php");

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISDISPATCHER()==true)
			{
				if(isset($_SESSION['dispatcher_taxi_id']) && isset($_SESSION['dispatcher_driver_id']))
				{
				}
				else
				{
					header("location:cashier.php");
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

<title>Taxi System - Dispatcher - Out</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>
<link rel='stylesheet' href='css_/gas.css'>
<link rel='stylesheet' href='css_/custom.css'>


</head>


<body>
	
	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>

	<?php include("includes/dispatcher_nav.php"); PRINT_NAV(); ?>









	
	<div id='body_div'>




		<?php



			if(isset($_SESSION['error']))
			{
				echo "<br><center><p style='color:red'>".$_SESSION['error']."</p></center><br>";
				unset($_SESSION['error']);
			}

			if(isset($_SESSION['success']))
			{
				echo "<br><center><p style='color:green'>".$_SESSION['success']."</p></center><br>";
				unset($_SESSION['success']);
			}



			echo "<center><h1>Rent a Taxi</h1></center>";



		?>

		
		<hr>
		<br>





		<?php




			
			if(isset($_SESSION['dispatcher_driver_id']))
			{



					$sess_name4 = "data4_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row = 0;

		    
		    		$row = MYSQL_SELECT("select * from driver where d_id=".$_SESSION['dispatcher_driver_id'],$sess_name4,9);


							// Start Experiment
								
					$week_ride = 0;


					$sess_name911 = "data911_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


					$query119 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name4.'_0_0'] . " and in_time between date_sub(now(),INTERVAL 1 WEEK) and now() and in_out.t_id=taxi.t_id order by in_out.io_id desc";


					    
					$row911 = MYSQL_SELECT($query119,$sess_name911,3);

					$week_ride = $row911;

					// End Experiment
		    	


					 if($row != 0)
					 {
					 	echo "
						 	<h4><b>Selected Driver</b></h4>

							<table class='table table-striped'>

								<thead style='color:white;'>
							      <tr>
							      	<th>Profile Pic</th>
							        <th>Full Name</th>
							        <th>Weekly Bonus</th>
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
				    		

				// Singular and Plural

				function singleOrPlural($amount, $singular, $plural) {
  					return (abs($amount)>=2
    					? $amount.' '.$plural 
    					: $amount.' '.$singular
  					);
				}


							$bonustext = "";

							if ($week_ride>=5) {
								$bonustext = "- Qualified!";
								}
							else {
								$bonustext = "- Not yet qualified.";
							
							}				    		






				    		
				    		
				    		echo "
				    		<td>".$_SESSION[$sess_name4.'_'.$x.'_1']." ".$_SESSION[$sess_name4.'_'.$x.'_2']." ".$_SESSION[$sess_name4.'_'.$x.'_3']."</td>";



				    		//weekly ride

				    		if(date('D') == 'Sun') { 
  							echo "
				    		<td>".singleOrPlural($week_ride,"day","days")." ".$bonustext."</td>
				    			";

								} else {

							echo "
				    		<td>".'No Bonuses Today'."</td>
				    			";
  							
								}

							// end weekly ride


				    		echo "
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





			if(isset($_SESSION['dispatcher_taxi_id']))
			{



					$sess_name9 = "data9_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row3 = 0;

		    
		    		$row3 = MYSQL_SELECT("select * from taxi where t_id=".$_SESSION['dispatcher_taxi_id'],$sess_name9,4);

					 if($row3 != 0)
					 {
					 	echo "
						 	<h4><b>Selected Taxi</b></h4>

							<table class='table table-striped'>

								<thead style='color:white;'>
							      <tr>
							      	<th>Body no</th>
							        <th>Plate no</th>
							        <th>Taxi Classification</th>
							        <th>Rental Price</th>
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
				    		<td>".number_format($_SESSION[$sess_name10.'_0_1'],2)."</td>
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




			if(isset($_SESSION['dispatcher_taxi_id']) && isset($_SESSION['dispatcher_driver_id']))
			{

				echo "

				<center><h4>Please confirm.</h4></center>

				<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"dispatcher_out_add.php\"'>Confirm</button></center>

				<br>

				<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"dispatcher.php\"'>Go Back</button></center>


				";




			}

			


		?>



		<br>
		<br>
		<hr>
		<br>




		<?php

			


				//search driver

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	$row = 0;

		    	if(isset($_GET['searchdriver']))
		    	{
		    		if(!empty($_GET['searchdriver']))
		    		{
			    		$search_this = str_replace("'", "''", $_GET['searchdriver']); 

			    		$row = MYSQL_SELECT("select * from driver where CONCAT(f_name,' ',m_name,' ',l_name) like '%".$_GET['searchdriver']."%'",$sess_name,9);
		    		}
		    	}

		 if($row != 0)
		 {
		 	echo "
			 	<h4><b>List of Driver(s)</b></h4>

				<table class='table table-striped'>

					<thead>
				      <tr>
				      	<th>Profile Pic</th>
				        <th>Full Name</th>
				        <th>Weekly Bonus</th>
				        <th>Driver Classification</th>
				        <th>Action</th>
				      </tr>
				    </thead>

				    <tbody>
		    		";
		 	}

		


		    	
		    	

		    	

		    	for($x=0;$x<$row;$x++)
		    	{

		    		$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    		MYSQL_SELECT("select dc_text from driver_class where dc_id=".$_SESSION[$sess_name.'_'.$x.'_9'],$sess_name2,0);

		    		echo "<tr>";

		    		if($_SESSION[$sess_name.'_'.$x.'_8'] != "")
		    		{
		    			echo "<td><img class='img-responsive' src='img/profile_pic/".$_SESSION[$sess_name.'_'.$x.'_8']."' height=\"100px\" width=\"100px\"/></td>";
		    		}
		    		else
		    		{
		    			echo "<td>No Image</td>";
		    		}
		    		

		    		
		    		
		    		echo "
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_1']." ".$_SESSION[$sess_name.'_'.$x.'_2']." ".$_SESSION[$sess_name.'_'.$x.'_3']."</td>
		    		<td>".singleOrPlural($week_ride,"day","days")." ".$bonustext."</td>
		    		<td>".$_SESSION[$sess_name2.'_0_0']."</td>
		    		<td><a href='cashier.php?driverid=".$_SESSION[$sess_name.'_'.$x.'_0']."'><button type='button' id='_buttons' class='btn-success'>Select Driver</button></a></td>
		    		</tr>";
		    	}

		    	
		   if($row != 0)
		   {

		   	echo "
		    	
		    </tbody>
		  
			</table>
			";


		 }



		 	//search taxi

		    	$sess_name6 = "data6_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	$row2 = 0;

		    	if(isset($_GET['searchtaxi']))
		    	{
		    		if(!empty($_GET['searchtaxi']))
		    		{
			    		$search_this = str_replace("'", "''", $_GET['searchtaxi']); 

			    		$row2 = MYSQL_SELECT("select * from taxi where CONCAT(body_no,plate_no) like '%".$_GET['searchtaxi']."%'",$sess_name6,4);
		    		}
		    	}

				 if($row2 != 0)
				 {
				 	echo "
					 	<h4><b>List of Taxi(s)</b></h4>

						<table class='table table-striped'>

							<thead>
						      <tr>
						      	<th>Body no</th>
						        <th>Plate no</th>
						        <th>Taxi Classification</th>
						        <th>Rental Price</th>
						        <th>Action</th>
						      </tr>
						    </thead>

						    <tbody>
				    		";
				 	}

		
		    	

		    	for($x=0;$x<$row2;$x++)
		    	{

		    		$sess_name7 = "data7_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    		MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=".$_SESSION[$sess_name6.'_'.$x.'_4'],$sess_name7,1);

		    		echo "<tr>
		    		<td>".$_SESSION[$sess_name6.'_'.$x.'_1']."</td>
		    		<td>".$_SESSION[$sess_name6.'_'.$x.'_2']."</td>
		    		<td>".$_SESSION[$sess_name7.'_0_0']."</td>
		    		<td>".number_format($_SESSION[$sess_name7.'_0_1'],2)."</td>
		    		<td><a href='cashier.php?taxiid=".$_SESSION[$sess_name6.'_'.$x.'_0']."'><button type='button' id='_buttons' class='btn-success'>Select Taxi</button></a></td>
		    		</tr>";
		    	}

		    	
			   if($row2 != 0)
			   {

			   	echo "
			    	
			    </tbody>
			  
				</table>
				";


			 	}









		?>




		
	</div>


	




</body>


</html>