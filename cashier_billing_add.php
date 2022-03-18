<?php


		session_start();


		include("functions/db.php");
		 include("includes/utils.php");

		include("includes/isloggedin.php");


		if(!isset($_SESSION['purchased_index']))
		{
			$_SESSION['purchased_index'] = 0;
		}



		if(ISLOGGEDIN()==true)
		{
			if(ISCASHIER()==true)
			{
				if(isset($_SESSION['cashier_driver_id']))
				{


					unset($_SESSION['cashier_others_amount']);
					unset($_SESSION['cashier_others_reason']);
					unset($_SESSION['cashier_discount_amount']);
					unset($_SESSION['cashier_discount_reason']);


					if($_POST)
					{
						if(isset($_POST['others_amount_tb']) && isset($_POST['others_reason_tb']))
						{
							if(is_numeric($_POST['others_amount_tb'])==true)
							{
								if($_POST['others_amount_tb'] > 0)
								{
									$_SESSION['cashier_others_amount'] = $_POST['others_amount_tb'];
									$_SESSION['cashier_others_reason'] = $_POST['others_reason_tb'];
								}
								

							}
							

						}


						if(isset($_POST['discount_amount_tb']) && isset($_POST['discount_reason_tb']))
						{
							if(is_numeric($_POST['discount_amount_tb'])==true)
							{
								if($_POST['discount_amount_tb'] > 0)
								{
									$_SESSION['cashier_discount_amount'] = $_POST['discount_amount_tb'];
									$_SESSION['cashier_discount_reason'] = $_POST['discount_reason_tb'];
								}
								

							}
							

						}


					}
					else
					{
						header("location:cashier.php");
					}




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

<title>Taxi System - Cashier - Billing - Add</title>
	
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

	<?php include("includes/cashier_nav.php"); PRINT_NAV(); ?>









	
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



		


		?>

		
		<hr>
		<br>





		<?php







			if(isset($_SESSION['cashier_driver_id']))
			{



					$sess_name4 = "data4_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row = 0;

		    
		    		$row = MYSQL_SELECT("select * from driver where d_id=".$_SESSION['cashier_driver_id'],$sess_name4,9);

					 if($row != 0)
					 {
					 	echo "
						 	<h4><b>Selected Driver</b></h4>

							<table class='table table-striped' style='border:2px solid #5e78a3'>

								<thead style='color:white;'>
							      <tr>
							      	<th>Profile Pic</th>
							        <th>Full Name</th>
							        <th>Address</th>
							        <th>Driver Classification</th>
							        <th>Weekly Bonus</th>
							      </tr>
							    </thead>

							    <tbody>
					    		";
					 	}

					
					// Start Experiment
								
					$week_ride = 0;


					$sess_name911 = "data911_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


					/*$query119 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name4.'_'.$x.'_0'] . " and out_time between date_sub(now(),INTERVAL 1 WEEK) and now() and in_out.t_id=taxi.t_id order by in_out.io_id desc";*/

					$query119 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name4.'_0_0'] . " and YEARWEEK(out_time) = YEARWEEK(NOW() - INTERVAL 1 WEEK) and in_out.t_id=taxi.t_id order by in_out.io_id desc";

					    
					$row911 = MYSQL_SELECT($query119,$sess_name911,3);

					$week_ride = $row911;

					// End Experiment


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
				    		<td>".$_SESSION[$sess_name5.'_0_0']."</td>";


				    						    		//weekly ride

				    		if(date('D') == 'Mon') { 
  							echo "
				    		<td>".singleOrPlural($week_ride,"day","days")." ".$bonustext."</td>
				    			";

								} else {

							echo "<td>".'No Bonuses Today'."</td>";
  								}
				    		";
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


			$overall_total = 0;


			if(isset($_SESSION['cashier_driver_id']))
			{

				echo "

					

							<h4><b>Purchased Service/Items</b></h4>

							<table class='table table-striped' style='border:2px solid #5e78a3'>
								<thead style='color:white;background-color:#5e78a3' >
									      <tr>
									      	<th>Product</th>
									        <th>Price</th>
									        <th>Date</th>
									      </tr>
									    </thead>

									    <tbody>";


									    //get rental taxi
								    	$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row100 = MYSQL_SELECT("select taxi.body_no,taxi_class.rental_price,in_out.in_time,in_out.out_time from taxi,taxi_class,in_out where taxi.tc_id=taxi_class.tc_id and taxi.t_id=in_out.t_id and in_out.d_id = ". $_SESSION['cashier_driver_id'] . " and in_out.b_id=0 order by in_out.io_id desc",$sess_name100,3);

								    	for($x=0;$x<$row100;$x++)
								    	{

									    	if(isset($_SESSION[$sess_name100.'_'.$x.'_0']))
									    	{
									    		$overall_total += $_SESSION[$sess_name100.'_'.$x.'_1'];
									    		echo "

									    		 				<tr>
														      	<td>Taxi Body No - ".$_SESSION[$sess_name100.'_'.$x.'_0']."</td>
														        <td>".number_format($_SESSION[$sess_name100.'_'.$x.'_1'],2)."</td>
														        <td>".DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$x.'_2'])." - ".DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$x.'_3'])."</td>
														      	</tr>


									    		 			";
									    	}
								    	}




								    	//get gas
								    	$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row101 = MYSQL_SELECT("select gas_amount,current_gas_price,gas_time from gas where d_id = ". $_SESSION['cashier_driver_id'] . " and b_id=0 order by g_id desc",$sess_name101,2);

								    	for($x=0;$x<$row101;$x++)
								    	{

									    	if(isset($_SESSION[$sess_name101.'_'.$x.'_0']))
									    	{
									    		$overall_total += $_SESSION[$sess_name101.'_'.$x.'_0'] * $_SESSION[$sess_name101.'_'.$x.'_1'];
									    		echo "

									    		 				<tr>
														      	<td>Gas</td>
														        <td>".number_format(($_SESSION[$sess_name101.'_'.$x.'_0'] * $_SESSION[$sess_name101.'_'.$x.'_1']),2)."</td>
														        <td>".DateNumToTextAndTime($_SESSION[$sess_name101.'_'.$x.'_2'])."</td>
														      	</tr>


									    		 			";
									    	}
									    }

									   

									    date_default_timezone_set('Asia/Manila');


								    	for($x = 0;$x < $_SESSION['purchased_index'];$x++)
								    	{


								    		if(isset($_SESSION['purchased_'.$x]))
								    		{
								    			if(is_numeric($_SESSION['purchased_'.$x]))
								    			{
								    				$sess_name21 = "data21_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    		 		MYSQL_SELECT("select * from products where p_id = ". $_SESSION['purchased_'.$x],$sess_name21,2);


								    		 		if(isset($_SESSION[$sess_name21.'_0_0']))
								    		 		{
								    		 			
								    		 			$overall_total += $_SESSION[$sess_name21.'_0_2'];
								    		 			echo "

								    		 				<tr>
													      	<td>".$_SESSION[$sess_name21.'_0_1']."</td>
													        <td>".number_format($_SESSION[$sess_name21.'_0_2'],2)."</td>
													        <td>Current</td>
													      	</tr>


								    		 			";
								    		 		}

								    			}
								    		}


								    	}



								    	
								    	if(isset($_SESSION['cashier_others_amount']))
								    	{
								    		$overall_total += $_SESSION['cashier_others_amount'];

								    		echo "
								    						<tr>
													      	<td>Others - ".$_SESSION['cashier_others_reason']."</td>
													        <td>".number_format($_SESSION['cashier_others_amount'],2)."</td>
													        <td>Current</td>
													      	</tr>

								    		";
								    	}




								    		echo "
								    						<tr style='background-color:darkgray'>
													      	<td><b>Total</b></td>
													        <td><b>".number_format($overall_total,2)."</b></td>
													        <td></td>
													      	</tr>

								    		";
								    


								    	if(isset($_SESSION['cashier_discount_amount']))
								    	{
								    		$overall_total -= $_SESSION['cashier_discount_amount'];

								    		echo "
								    						<tr>
													      	<td>Discount - ".$_SESSION['cashier_discount_reason']."</td>
													        <td>- ".number_format($_SESSION['cashier_discount_amount'],2)."</td>
													        <td>Current</td>
													      	</tr>

								    		";
								    	}
							    
							    		



						echo "

									    </tbody>
							</table>

							<div class='row'>

								<div class='col-sm-6'>

								</div>

								<div class='col-sm-6'>
									<div style='padding:20px;border:2px solid black;background-color:lightgray'>
									<center><h2 style='color:black'>Overall Total: <b style='color:#c65825'>".number_format($overall_total,2)."</b></h2></center>
									</div>
								</div>

							</div>


							
							



						



				";




			}

			


		?>



		<br>
		<br>
		<hr>
		<br>




							<br>


							<form action='functions/cashier_billing_add.php' method='post'>

							<center><h4>Please confirm.</h4></center>
							<center><input type='submit' value='Confirm' name='create_billing' class='btn-success' style='padding:20px 40px 20px 40px' /></center>


							</form>

							<br>

							<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href="cashier_billing.php"'>Go Back</button></center>


							<br>
							<br>
							<br>
							<br>



		
	</div>


	




</body>


</html>