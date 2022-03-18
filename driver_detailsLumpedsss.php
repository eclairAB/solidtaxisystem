<?php


		session_start();

		include("includes/isloggedin.php");
		include("includes/utils.php");

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


				MYSQL_SELECT("select * from driver where d_id=".$_GET['id'],$sess_name,9);

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

<title>Taxi System - Admin - Driver - Details</title>
	
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

	

	<div style='padding:10px'>
		

		

		<?php
			



			$sess_name4 = "data4_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row = 0;

		    
		    		$row = MYSQL_SELECT("select * from driver where d_id=".$_SESSION[$sess_name.'_0_0'],$sess_name4,9);

					
					 	echo "
						 	<h4><b>Driver Details</b></h4>

							<table class='table table-striped' id='selected_table' style='background-color: green;border:2px solid green;'>

								<thead style='color:white;'>
							      <tr>
							      	<th>Profile Pic</th>
							        <th>Full Name</th>
							        <th>Gender</th>
							        <th>Birthday</th>
							        <th>Age</th>
							        <th>Address</th>
							        <th>Contact No</th>
							        <th>Driver Classification</th>
							        <th>Status</th>
							      </tr>
							    </thead>

							    <tbody>
					    		";
					 	

				

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
				    		<td>".$_SESSION[$sess_name4.'_0_4']."</td>
				    		<td>".DateNumToText($_SESSION[$sess_name4.'_0_5'])."</td>
				    		<td>".BirthdayToAge($_SESSION[$sess_name4.'_0_5'])."</td>
				    		<td>".$_SESSION[$sess_name4.'_0_6']."</td>
				    		<td>".$_SESSION[$sess_name4.'_0_7']."</td>
				    		<td>".$_SESSION[$sess_name5.'_0_0']."</td>";
				    		


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


								if($ok2==true)
					    		{
					    			echo "<td style='color:green'>Available</td>";
					    		}
					    		else
					    		{
					    			echo "<td style='color:red'>Not Available</td>";
					    		}


				    		echo "</tr>";
				    	}

				    	
					  

					   	echo "
					    	
					    </tbody>
					  
						</table>

						<br>
						<br>


						<div class='row'>

							<div class='col-sm-3'>
							</div>

							<div class='col-sm-6'>

								<form action='driver_details.php' method ='get'>
							 		<input type='hidden' name='id' value = '".$_GET['id']."'/>
									<div class='form-group'>
											<label>Filter by Date From</label>
											<input type='date' name='searchdatefrom' class='form-control' value= '";

											if(isset($_GET['searchdatefrom'])){echo $_GET['searchdatefrom'];} echo "'  requried>
									</div>

									<div class='form-group'>
										<label>To</label>
											<input type='date' name='searchdateto' class='form-control' value= '";
											 if(isset($_GET['searchdatefrom'])){echo $_GET['searchdateto'];} echo "' requried>
									</div>

									<center><input type='submit' value='Filter Data' style='padding:20px 40px 20px 40px' class='btn-success'/></center>

								</form>

							</div>

							
							<div class='col-sm-3'>
							</div>

						</div>


						<br>

						<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"driver.php\"'>Go Back</button></center>

						<br>
						<hr>



						";



						$total_taxi = 0;
						$total_transaction = 0;

						$total_contribution_count_sss = 0;
						$total_contribution_count_pagibig = 0;
						$total_contribution_count_philhealth = 0;
						$total_contribution_count_cashbond = 0;

						$total_remitance_count_sss = 0;
						$total_remitance_count_pagibig = 0;
						$total_remitance_count_philhealth = 0;
						$total_remitance_count_cashbond = 0;



						echo "

					 	<h4><b>Taxi(s)</b></h4>

					 	<div style='height:500px;overflow-x:scroll'>

					 	<table class='table table-striped'>

								<thead>
							      <tr>
							      	<th>Body No</th>
							      	<th>Plate No</th>
							        <th>Date</th>
							      </tr>
							    </thead>

							    <tbody>";



							    $sess_name900 = "data900_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


							    $query1 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name.'_0_0'] . " and in_out.t_id=taxi.t_id order by in_out.io_id desc";



							     if(isset($_GET['searchdatefrom']) && isset($_GET['searchdateto']))
							    	{

							    		if($_GET['searchdatefrom'] != "" && $_GET['searchdateto'] == "")
							    		{
							    			$search_this = str_replace("'", "''", $_GET['searchdatefrom']);

							    			$query1 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name.'_0_0'] . " and in_out.in_time like '%".$search_this."%' and in_out.t_id=taxi.t_id order by in_out.io_id desc";

							    		}
							    		else
							    		{


							    			
							    				$search_this = str_replace("'", "''", $_GET['searchdatefrom']);

								    			$search_this2 = str_replace("'", "''", $_GET['searchdateto']);


								    			$query1 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name.'_0_0'] . " and (in_out.in_time between '".$search_this." 00:00:00' and '".$search_this2." 23:59:59') and in_out.t_id=taxi.t_id order by in_out.io_id desc";

								    			
							    			
							    		}



							    		
							    	}


					    
					    		$row900 = MYSQL_SELECT($query1,$sess_name900,3);

					    		$total_taxi = $row900;

					    		for($x=0;$x<$row900;$x++)
					    		{
					    			echo "<tr>
					    			<td>".$_SESSION[$sess_name900.'_'.$x.'_0']."</td>
					    			<td>".$_SESSION[$sess_name900.'_'.$x.'_1']."</td>";

						    		



						    		//get status
						    		$ok2 = true;

						    		if($x == 0)
						    		{

				    					if(isset($_SESSION[$sess_name900.'_0_3']))
										{
											if($_SESSION[$sess_name900.'_0_3']=="0000-00-00 00:00:00")
											{
												$ok2 = false;
											}
										}
										else
										{


											$sess_name333 = "data333_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x;
											$row33 = 0;
											$row33 = MYSQL_SELECT("select out_time from in_out where d_id=".$_SESSION[$sess_name.'_0_0'],$sess_name333,0);

											if($row33 != 0)
											{
												$ok2 = false;
											}

											
										}

									}




									$inout = "";

									if($ok2 == false)
									{
										$inout = DateNumToTextAndTime($_SESSION[$sess_name900.'_'.$x.'_2']) . " - Current";
									}
									else
									{
										$inout = DateNumToTextAndTime($_SESSION[$sess_name900.'_'.$x.'_2']) . " - " . DateNumToTextAndTime($_SESSION[$sess_name900.'_'.$x.'_3']);
									}



						    		echo "
						    			 <td>".$inout."</td>
						    			 </tr>";
					    		}






						echo "	
							    	
							    </tbody>

						</table>

						</div>

						<hr>";

						$total_rental = 0;
						$total_gas_pump = 0;
						$total_balance = 0;


						$sss = array(array(),array(),array(),array());
						$sss_index = 0;

						$PAGIBIG = array(array(),array(),array(),array());
						$PAGIBIG_index = 0;

						$PHILHEALTH = array(array(),array(),array(),array());
						$PHILHEALTH_index = 0;

						$cashbond = array(array(),array(),array(),array());
						$cashbond_index = 0;



						echo "

					
							<br>
							<center><h1><b>Transaction(s)</b></h1></center>
							<br>
							<br>


							<div style='height:600px;overflow-x:scroll'>";

							


										$query2 = "select * from billing where d_id = ". $_SESSION[$sess_name.'_0_0'] . " order by b_id desc";


										if(isset($_GET['searchdatefrom']) && isset($_GET['searchdateto']))
								    	{

								    		if($_GET['searchdatefrom'] != "" && $_GET['searchdateto'] == "")
								    		{
								    			$search_this = str_replace("'", "''", $_GET['searchdatefrom']);

								    			$query2 = "select * from billing where d_id = ". $_SESSION[$sess_name.'_0_0'] . " and b_time like '%".$search_this."%' order by b_id desc";

								    			

								    		}
								    		else
								    		{


								    			
								    				$search_this = str_replace("'", "''", $_GET['searchdatefrom']);

									    			$search_this2 = str_replace("'", "''", $_GET['searchdateto']);


									    			$query2 = "select * from billing where d_id = ". $_SESSION[$sess_name.'_0_0'] . " and (b_time between '".$search_this." 00:00:00' and '".$search_this2." 23:59:59') order by b_id desc";


									    			
									    			
								    			
								    		}



								    		
								    	}





										$sess_name105 = "data105_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row55 = MYSQL_SELECT($query2,$sess_name105,7);

								    	$count = $row55;

								    	$total_transaction = $row55;

								    	for($x=0;$x<$row55;$x++)
								    	{

								    		$overall_total = 0;

								    		echo "
								    		<h4><b>Transaction ".$count."</b></h1>
								    		<table class='table table-striped' style='border:2px solid #5e78a3'>
											<thead style='color:white;background-color:#5e78a3' >
												      <tr>
												      	<th>Product</th>
												        <th>Price</th>
												        <th>Date</th>
												      </tr>
												    </thead>

												    <tbody>";

											$count --;

								    		//check if paid
								    		$sess_name106 = "data106_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    		$row56 = MYSQL_SELECT("select amount_payed,pay_time from billing_payments where b_id=".$_SESSION[$sess_name105.'_'.$x.'_0']." order by b_pay_id asc",$sess_name106,1);


								    		$billing_overall_total = $_SESSION[$sess_name105.'_'.$x.'_6'] + $_SESSION[$sess_name105.'_'.$x.'_3'] - $_SESSION[$sess_name105.'_'.$x.'_5'];

								    		$billing_payments_total = 0;


								    		for($y=0;$y<$row56;$y++)
								    		{


								    			$billing_payments_total += $_SESSION[$sess_name106.'_'.$y.'_0'];


								    		}



								    		



								    			 //get rental taxi
										    	$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
										    	$row100 = MYSQL_SELECT("select taxi.body_no,billing_taxi.t_current_rent_price,in_out.in_time,in_out.out_time from taxi,billing_taxi,in_out where taxi.t_id=billing_taxi.t_id and in_out.b_id=billing_taxi.b_id and billing_taxi.b_id = ". $_SESSION[$sess_name105.'_'.$x.'_0'],$sess_name100,3);

										    	for($xx=0;$xx<$row100;$xx++)
										    	{

											    	if(isset($_SESSION[$sess_name100.'_'.$xx.'_0']))
											    	{
											    		$overall_total += $_SESSION[$sess_name100.'_'.$xx.'_1'];

											    		$total_rental += $_SESSION[$sess_name100.'_'.$xx.'_1'];

											    		echo "

											    		 				<tr>
																      	<td>Taxi Body No - ".$_SESSION[$sess_name100.'_'.$xx.'_0']."</td>
																        <td>".number_format($_SESSION[$sess_name100.'_'.$xx.'_1'],2)."</td>
																        <td>".DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$xx.'_2'])." - ".DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$xx.'_3'])."</td>
																      	</tr>


											    		 			";
											    	}
										    	}



										    	//get gas
										    	$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
										    	$row101 = MYSQL_SELECT("select gas_amount,current_gas_price,gas_time from gas where d_id = ". $_SESSION[$sess_name.'_0_0'] . " and b_id=".$_SESSION[$sess_name105.'_'.$x.'_0']." order by g_id desc",$sess_name101,2);

										    	for($xxx=0;$xxx<$row101;$xxx++)
										    	{

											    	if(isset($_SESSION[$sess_name101.'_'.$xxx.'_0']))
											    	{
											    		$overall_total += $_SESSION[$sess_name101.'_'.$xxx.'_0'] * $_SESSION[$sess_name101.'_'.$xxx.'_1'];

											    		$total_gas_pump += $_SESSION[$sess_name101.'_'.$xxx.'_0'];

											    		echo "

											    		 				<tr>
																      	<td>Gas</td>
																        <td>".number_format(($_SESSION[$sess_name101.'_'.$xxx.'_0'] * $_SESSION[$sess_name101.'_'.$xxx.'_1']),2)."</td>
																        <td>".DateNumToTextAndTime($_SESSION[$sess_name101.'_'.$xxx.'_2'])."</td>
																      	</tr>


											    		 			";
											    	}
											    }



											    //get products
										    	$sess_name107 = "data107_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
										    	$row107 = MYSQL_SELECT("select p_current_name,p_current_price from billing_products where b_id=".$_SESSION[$sess_name105.'_'.$x.'_0'],$sess_name107,1);

										    	for($xxxx=0;$xxxx<$row107;$xxxx++)
										    	{

											    	if(isset($_SESSION[$sess_name107.'_'.$xxxx.'_0']))
											    	{
											    		$overall_total += $_SESSION[$sess_name107.'_'.$xxxx.'_1'];



											    		if(strpos(strtolower($_SESSION[$sess_name107.'_'.$xxxx.'_0']),'sss')===0)
											    		{
											    			$sss[$sss_index][0] = $_SESSION[$sess_name107.'_'.$xxxx.'_0'];
											    			$sss[$sss_index][1] = $_SESSION[$sess_name107.'_'.$xxxx.'_1'];
											    			$sss[$sss_index][2] = $_SESSION[$sess_name105.'_'.$x.'_7'];
											    			$sss_index++;

											    		}

											    		if(strpos(strtolower($_SESSION[$sess_name107.'_'.$xxxx.'_0']),'pagibig')===0)
											    		{
											    			$PAGIBIG[$PAGIBIG_index][0] = $_SESSION[$sess_name107.'_'.$xxxx.'_0'];
											    			$PAGIBIG[$PAGIBIG_index][1] = $_SESSION[$sess_name107.'_'.$xxxx.'_1'];
											    			$PAGIBIG[$PAGIBIG_index][2] = $_SESSION[$sess_name105.'_'.$x.'_7'];
											    			$PAGIBIG_index++;

											    		}

											    		if(strpos(strtolower($_SESSION[$sess_name107.'_'.$xxxx.'_0']),'philhealth')===0)
											    		{
											    			$PHILHEALTH[$PHILHEALTH_index][0] = $_SESSION[$sess_name107.'_'.$xxxx.'_0'];
											    			$PHILHEALTH[$PHILHEALTH_index][1] = $_SESSION[$sess_name107.'_'.$xxxx.'_1'];
											    			$PHILHEALTH[$PHILHEALTH_index][2] = $_SESSION[$sess_name105.'_'.$x.'_7'];
											    			$PHILHEALTH_index++;

											    		}

											    		if(strpos(strtolower($_SESSION[$sess_name107.'_'.$xxxx.'_0']),'cash bond')===0)
											    		{
											    			$cashbond[$cashbond_index][0] = $_SESSION[$sess_name107.'_'.$xxxx.'_0'];
											    			$cashbond[$cashbond_index][1] = $_SESSION[$sess_name107.'_'.$xxxx.'_1'];
											    			$cashbond[$cashbond_index][2] = $_SESSION[$sess_name105.'_'.$x.'_7'];
											    			$cashbond_index++;

											    		}




											    		
											    		echo "

											    		 				<tr>
																      	<td>".$_SESSION[$sess_name107.'_'.$xxxx.'_0']."</td>
																        <td>".number_format(($_SESSION[$sess_name107.'_'.$xxxx.'_1']),2)."</td>
																        <td>".DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7'])."</td>
																      	</tr>


											    		 			";
											    	}
											    }


											    if($_SESSION[$sess_name105.'_'.$x.'_3'] != 0)
											    {
											    	$overall_total += $_SESSION[$sess_name105.'_'.$x.'_3'];
											    	echo "

											    		 				<tr>
																      	<td>".$_SESSION[$sess_name105.'_'.$x.'_2']."</td>
																        <td>".number_format(($_SESSION[$sess_name105.'_'.$x.'_3']),2)."</td>
																        <td>".DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7'])."</td>
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


											    if($_SESSION[$sess_name105.'_'.$x.'_5'] != 0)
											    {

											    	$overall_total -= $_SESSION[$sess_name105.'_'.$x.'_5'];

											    	echo "

											    		 				<tr>
																      	<td>".$_SESSION[$sess_name105.'_'.$x.'_4']."</td>
																        <td>- ".number_format(($_SESSION[$sess_name105.'_'.$x.'_5']),2)."</td>
																        <td>".DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7'])."</td>
																      	</tr>


											    		 			";
											    }



											    echo "

									    		 				<tr style='background-color:darkgray'>
														      	<td><b>Overall Total</b></td>
														        <td><b>".number_format($overall_total,2)."</b></td>
														        <td></td>
														      	</tr>


									    		 			";


									    		 echo "

									    		 				<tr>
														      	<td></td>
														        <td></td>
														        <td></td>
														      	</tr>


									    		 			";



									    		 for($y=0;$y<$row56;$y++)
									    		{


									    			echo "

									    		 				<tr style='background-color:#5ee579'>
														      	<td><b>Payment</b></td>
														        <td><b>".number_format($_SESSION[$sess_name106.'_'.$y.'_0'],2)."</b></td>
														        <td>".DateNumToTextAndTime( $_SESSION[$sess_name106.'_'.$y.'_1'])."</td>
														      	</tr>


									    		 			";

									    			


									    		}


									    		echo "

									    		 				<tr>
														      	<td></td>
														        <td></td>
														        <td></td>
														      	</tr>


									    		 			";



								    		
								    			if($billing_overall_total != $billing_payments_total)
								    			{

								    				$total_balance += $billing_overall_total-$billing_payments_total;

								    				echo "

									    		 				<tr style='background-color:#f97777'>
														      	<td><b>Balance</b></td>
														        <td><b>".number_format($billing_overall_total-$billing_payments_total,2)."</b></td>
														        <td>".DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7'])."</td>
														      	</tr>


									    		 			";
								    			}



								    			
								    		


								    		echo "

												    </tbody>
										</table>

										

										<br>
										<br>";

								    	}

									    

								    	echo "</div>

								    	<br>
								    	<br>

								    	<div class='row'>

											

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Total Rental: <b style='color:#c65825'>".number_format($total_rental,2)."</b></h2></center>
												</div>
											</div>

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Total Gas Pump: <b style='color:#c65825'>".number_format($total_gas_pump,2)." Liters</b></h2></center>
												</div>
											</div>

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:#f97777'>
												<center><h2 style='color:black'>Total Balance: <b style='color:black'>".number_format($total_balance,2)."</b></h2></center>
												</div>
											</div>

										</div>

										<br>
										<br>
										<br>






















										<hr>
										<br>
										<center><h1><b>SSS-HDMF-PHIC</b></h1></center>
										<br>
										<br>


										<div style='height:600px;overflow-x:scroll;'>

											<table class='table table-striped' style='border:2px solid #5e78a3'>
												<thead style='color:white;background-color:#5e78a3' >
													      <tr>
													      	<th>SSS</th>
													        <th>Contribution</th>
													        <th>Date</th>
													      </tr>
													    </thead>
													    <tbody>";

													    $sss_group = array(array(),array(),array());
													    $sss_group_index = 0;

													    $sss_group_total = 0;

													    $total_contribution_count_sss = $sss_index;

													    for($x=0;$x<$sss_index;$x++)
													    {

													    	$notinside = true;

													    	for($y=0;$y<$sss_group_index;$y++)
													    	{
													    		if($sss[$x][0]==$sss_group[$y][0])
													    		{
													    			$sss_group[$y][1] += $sss[$x][1];
													    			$notinside = false; 
													    		}
													    	}

													    	if($notinside==true)
													    	{
													    		$sss_group[$sss_group_index][0] = $sss[$x][0];
													    		$sss_group[$sss_group_index][1] = $sss[$x][1];
													    		$sss_group_index++;
													    	}



													    	echo "

													    	<tr>
													      	<td>".$sss[$x][0]."</td>
													        <td>".number_format($sss[$x][1],2)."</td>
													        <td>".DateNumToTextAndTime($sss[$x][2])."</td>
													      	</tr>

													    	";
													    }


											echo "
													    </tbody>
											</table>

											<br>

											<center><h1><b>Grouped SSS-HDMF-PHIC</b></h1></center>
											<br>
											<br>

											<table class='table table-striped' style='border:2px solid #5e78a3'>
												<thead style='color:white;background-color:#5e78a3' >
													      <tr>
													      	<th>SSS</th>
													        <th>Total Contribution</th>
													      </tr>
													    </thead>
													    <tbody>";

													    $sss_group_total = 0;

													    for($x=0;$x<$sss_group_index;$x++)
													    {
													    	echo "

													    		<tr>
														      	<td>".$sss_group[$x][0]."</td>
														        <td>".number_format($sss_group[$x][1],2)."</td>
														        </tr>
													    		";

													    	$sss_group_total += $sss_group[$x][1];
													    }



												echo "</tbody>
											</table>


											<br>

											<center><h1><b>SSS-HDMF-PHIC Remitance History</b></h1></center>
											<br>
											<br>

											<table class='table table-striped' style='border:2px solid #5e78a3'>
												<thead style='color:white;background-color:#5e78a3' >
													      <tr>
													      	<th>Amount</th>
													        <th>Date</th>
													      </tr>
													    </thead>
													    <tbody>";

													    $sess_name10555 = "data10555_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s')."sss";
								    					$row5555sss = MYSQL_SELECT("select * from driver_remitance where d_id = ". $_SESSION[$sess_name.'_0_0'] . " and remitance_type='sss' order by d_rem_id desc",$sess_name10555,4);

								    					$total_remitance_count_sss = $row5555sss;


								    					$sss_total_remitance = 0;

								    					for($x=0;$x<$row5555sss;$x++)
								    					{
								    						$sss_total_remitance += $_SESSION[$sess_name10555.'_'.$x.'_2'];
								    						echo "
								    						<tr>
								    							<td>".number_format($_SESSION[$sess_name10555.'_'.$x.'_2'],2)."</td>
								    							<td>".DateNumToTextAndTime($_SESSION[$sess_name10555.'_'.$x.'_3'],2)."</td>
								    						</tr>

								    						";
								    					}



												echo "</tbody>
											</table>


											<br>
								    	<br>

								    	

										<br>
										<br>
										<br>




											";


									echo "</div>

									<br>
									<br>


									<div class='row'>

											

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Total SSS-HDMF-PHIC Contribution: <b style='color:#c65825'>".number_format($sss_group_total,2)."</b></h2></center>
												</div>
											</div>

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Total SSS-HDMF-PHIC Remitance: <b style='color:#c65825'>".number_format($sss_total_remitance,2)."</b></h2></center>
												</div>
											</div>

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Available: <b style='color:#c65825'>".number_format($sss_group_total-$sss_total_remitance,2)."</b></h2></center>
												</div>
											</div>

										</div>





									<br>
									<br>
									<br>
									<hr>
									

										<br>
									<br>
									<br>
									<hr>
									<br>
										<center><h1><b>Cash Bond</b></h1></center>
										<br>
										<br>


										<div style='height:600px;overflow-x:scroll'>

											<table class='table table-striped' style='border:2px solid #5e78a3'>
												<thead style='color:white;background-color:#5e78a3' >
													      <tr>
													      	<th>Cash Bond</th>
													        <th>Contribution</th>
													        <th>Date</th>
													      </tr>
													    </thead>
													    <tbody>";

													    $cashbond_group = array(array(),array(),array());
													    $cashbond_group_index = 0;

													    $cashbond_group_total = 0;

													    $total_contribution_count_cashbond = $cashbond_index;


													    for($x=0;$x<$cashbond_index;$x++)
													    {

													    	$notinside = true;

													    	for($y=0;$y<$cashbond_group_index;$y++)
													    	{
													    		if($cashbond[$x][0]==$cashbond_group[$y][0])
													    		{
													    			$cashbond_group[$y][1] += $cashbond[$x][1];
													    			$notinside = false; 
													    		}
													    	}

													    	if($notinside==true)
													    	{
													    		$cashbond_group[$cashbond_group_index][0] = $cashbond[$x][0];
													    		$cashbond_group[$cashbond_group_index][1] = $cashbond[$x][1];
													    		$cashbond_group_index++;
													    	}



													    	echo "

													    	<tr>
													      	<td>".$cashbond[$x][0]."</td>
													        <td>".number_format($cashbond[$x][1],2)."</td>
													        <td>".DateNumToTextAndTime($cashbond[$x][2])."</td>
													      	</tr>

													    	";
													    }


											echo "
													    </tbody>
											</table>

											<br>

											<center><h1><b>Grouped Cash Bond</b></h1></center>
											<br>
											<br>

											<table class='table table-striped' style='border:2px solid #5e78a3'>
												<thead style='color:white;background-color:#5e78a3' >
													      <tr>
													      	<th>Cash Bond</th>
													        <th>Total Contribution</th>
													      </tr>
													    </thead>
													    <tbody>";

													    $cashbond_group_total = 0;

													    for($x=0;$x<$cashbond_group_index;$x++)
													    {
													    	echo "

													    		<tr>
														      	<td>".$cashbond_group[$x][0]."</td>
														        <td>".number_format($cashbond_group[$x][1],2)."</td>
														        </tr>
													    		";

													    	$cashbond_group_total += $cashbond_group[$x][1];
													    }



												echo "</tbody>
											</table>


											<br>

											<center><h1><b>Cash Bond Remitance History</b></h1></center>
											<br>
											<br>

											<table class='table table-striped' style='border:2px solid #5e78a3'>
												<thead style='color:white;background-color:#5e78a3' >
													      <tr>
													      	<th>Amount</th>
													        <th>Date</th>
													      </tr>
													    </thead>
													    <tbody>";

													    $sess_name10555 = "data10555_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s')."cashbond";
								    					$row5555cashbond = MYSQL_SELECT("select * from driver_remitance where d_id = ". $_SESSION[$sess_name.'_0_0'] . " and remitance_type='cash bond' order by d_rem_id desc",$sess_name10555,4);

								    					$cashbond_total_remitance = 0;

								    					$total_remitance_count_cashbond = $row5555cashbond;

								    					for($x=0;$x<$row5555cashbond;$x++)
								    					{
								    						$cashbond_total_remitance += $_SESSION[$sess_name10555.'_'.$x.'_2'];
								    						echo "
								    						<tr>
								    							<td>".number_format($_SESSION[$sess_name10555.'_'.$x.'_2'],2)."</td>
								    							<td>".DateNumToTextAndTime($_SESSION[$sess_name10555.'_'.$x.'_3'],2)."</td>
								    						</tr>

								    						";
								    					}



												echo "</tbody>
											</table>


											<br>
								    	<br>

								    	

										<br>
										<br>
										<br>

										</div>

										<br>
										<br>

										<div class='row'>

											

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Total Cash Bond Contribution: <b style='color:#c65825'>".number_format($cashbond_group_total,2)."</b></h2></center>
												</div>
											</div>

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Total Cash Bond Remitance: <b style='color:#c65825'>".number_format($cashbond_total_remitance,2)."</b></h2></center>
												</div>
											</div>

											<div class='col-sm-4'>
												<div style='padding:20px;border:2px solid black;background-color:lightgray'>
												<center><h2 style='color:black'>Cash Bond Available: <b style='color:#c65825'>".number_format($cashbond_group_total-$cashbond_total_remitance,2)."</b></h2></center>
												</div>
											</div>

										</div>

										<br>
										<br>
										<br>
										<br>
										<hr>
										<br>
										<br>

										<center>

										<h1><b>SUMMARY</b></h1>
										<br>

										<h4>Total Taxi Rented: ".$total_taxi."</h4>
										<h4>Total Transaction(s): ".$total_transaction ."</h4>


										<br>
										<h4>Total SSS-HDMF-PHIC Contribution Count: ".$total_contribution_count_sss ."</h4>
										<h4>Total SSS-HDMF-PHIC Remitance Count: ".$total_remitance_count_sss ."</h4>

										<br>
										<h4>Total Cash Bond Contribution Count: ".$total_contribution_count_cashbond ."</h4>
										<h4>Total Cash Bond Remitance Count: ".$total_remitance_count_cashbond ."</h4>

										</center>


										<br>
										<br>

										<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"driver.php\"'>Go Back</button></center>

										<br>


										<br>
										<br>
										<br>
										<br>





								    	";











								    	



								    	


		?>


							
		
		

		
	</div>

	




</body>


</html>