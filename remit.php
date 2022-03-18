<?php


		session_start();


		include("functions/db.php");
		 include("includes/utils.php");

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISREMIT()==true)
			{

				

				unset($_SESSION['cashier_enter_amount']);
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

<title>Taxi System - Remittance SSS/HDMF/PHIC</title>
	
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

	<?php include("includes/remit_nav.php"); PRINT_NAV(); ?>









	
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




		if(isset($_SESSION['cashier_taxi_id']) && isset($_SESSION['cashier_driver_id']))
		{
		}
		else
		{
			echo "

			<form action='remit.php' method ='get'>

			<div class='form-group'>
						<label id='search_label'>Search Driver</label>
						<input type='text' name='searchdriver' id='search_box' class='form-control' placeholder='Driver name' requried>
			</div>

			</form>


			<br>
			<br>";
		}

		
		if(isset($_SESSION['cashier_driver_id']))
		{
			echo "

				<hr>
				<br>

			";
		}


		?>

		
		





		<?php


			if(isset($_GET['driverremove']))
			{
				if(preg_match("/^[0-9]{1,}$/", $_GET['driverremove']))
				{

					$_SESSION['purchased_index'] = 0;
					unset($_SESSION['purchased_index']);

					unset($_SESSION['cashier_others_amount']);
					unset($_SESSION['cashier_others_reason']);
					unset($_SESSION['cashier_discount_amount']);
					unset($_SESSION['cashier_discount_reason']);
					
					unset($_SESSION['cashier_enter_amount']);

					unset($_SESSION['cashier_driver_id']);
					header("location:remit.php");
				}
				else
				{
					header("location:remit.php");
				}

			}


			if(isset($_GET['driverid']))
			{
				if(preg_match("/^[0-9]{1,}$/", $_GET['driverid']))
				{


					$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


					MYSQL_SELECT("select * from driver where d_id=".$_GET['driverid'],$sess_name3,9);



					if(isset($_SESSION[$sess_name3.'_0_0']))
					{
						if(empty($_SESSION[$sess_name3.'_0_0']))
						{
							header("location:index.php");
						}
						else
						{


							if(!isset($_SESSION['cashier_driver_id']))
							{
								$_SESSION['cashier_driver_id'] = $_GET['driverid'];
								header("location:remit.php");
							}
							else
							{
								header("location:remit.php");
							}


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
			





			if(isset($_SESSION['cashier_driver_id']))
			{



					$sess_name4 = "data4_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row = 0;

		    
		    		$row = MYSQL_SELECT("select * from driver where d_id=".$_SESSION['cashier_driver_id'],$sess_name4,9);

					 if($row != 0)
					 {
					 	echo "
						 	<h4><b>Selected Driver</b></h4>

							<table class='table table-striped'>

								<thead style='color:white;'>
							      <tr>
							      	<th >Profile Pic</th>
							        <th>Full Name</th>
							        <th>Address</th>
							        <th>Driver Classification</th>
							        <th>Action</th>
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
				    		<td><a href='remit.php?driverremove=".$_SESSION[$sess_name4.'_'.$x.'_0']."'><button type='button' id='_buttons' class='btn-danger'>Remove</button></a></td>
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





			if(isset($_SESSION['cashier_driver_id']))
			{

				echo "

				<center>



				<button type='button' class='btn-success' style='padding:20px 20px 20px 20px' onclick='window.location.href=\"remit_sss.php\"'>SSS</button>

				<button type='button' class='btn-success' style='padding:20px 20px 20px 20px' onclick='window.location.href=\"remit_pagibig.php\"'>PAG-IBIG</button>

				<button type='button' class='btn-success' style='padding:20px 20px 20px 20px' onclick='window.location.href=\"remit_philhealth.php\"'>PHILHEALTH</button>

				<button type='button' class='btn-success' style='padding:20px 20px 20px 20px' onclick='window.location.href=\"remit_cashbond.php\"'>Cash Bond</button>


				</center>

				";




			}

			

			if(isset($_SESSION['cashier_driver_id']))
			{
				echo "
					<br>
					<br>
					<hr>
					<br>";

			}


		?>



		




		<?php

			


				//search driver

		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    	$row = 0;

		    	if(isset($_GET['searchdriver']))
		    	{
		    		$_SESSION['purchased_index'] = 0;
					unset($_SESSION['purchased_index']);

					unset($_SESSION['cashier_others_amount']);
					unset($_SESSION['cashier_others_reason']);
					unset($_SESSION['cashier_discount_amount']);
					unset($_SESSION['cashier_discount_reason']);

					unset($_SESSION['cashier_enter_amount']);

					
				
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
				        <th>Address</th>
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
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_6']."</td>
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




		 if(isset($_SESSION['pdf_name']))
		{
			echo "<script>window.open(\"".$_SESSION['pdf_name']."\");</script>";
			unset($_SESSION['pdf_name']);
		}




		?>




		
	</div>


	




</body>


</html>