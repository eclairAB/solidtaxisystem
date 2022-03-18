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




					if(isset($_GET['itemadd']))
					{
						if(preg_match("/^[0-9]{1,}$/", $_GET['itemadd']))
						{
							$_SESSION['purchased_'.$_SESSION['purchased_index']] = $_GET['itemadd'];
							$_SESSION['purchased_index'] += 1;
							header("location:cashier_billing.php");
						}

					}



					if(isset($_GET['itemremove']))
					{
						if(preg_match("/^[0-9]{1,}$/", $_GET['itemremove']))
						{

							$ok = true;

							for($x=0;$x<$_SESSION['purchased_index'];$x++)
							{
								if(isset($_SESSION['purchased_'.$x]))
								{
									if($_SESSION['purchased_'.$x]==$_GET['itemremove'])
									{
										if($ok == true)
										{
											unset($_SESSION['purchased_'.$x]);
											$ok = false;
										}

									}
								}
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

<title>Taxi System - Cashier - Payment</title>
	
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

							<table class='table table-striped'>

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


			$overall_total = 0;


			if(isset($_SESSION['cashier_driver_id']))
			{

				echo "

					

							<h4><b>Purchased Service/Items</b></h4>

							<table class='table table-striped'>
								<thead>
									      <tr>
									      	<th>Product</th>
									        <th>Price</th>
									        <th>Date</th>
									      </tr>
									    </thead>

									    <tbody>";







										$sess_name105 = "data105_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row55 = MYSQL_SELECT("select * from billing where d_id = ". $_SESSION['cashier_driver_id'] . " order by b_id desc",$sess_name105,7);


								    	for($x=0;$x<$row55;$x++)
								    	{


								    		//check if paid
								    		$sess_name106 = "data106_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    		$row56 = MYSQL_SELECT("select amount_payed from billing_payments where b_id=".$_SESSION[$sess_name105.'_'.$x.'_0'],$sess_name106,0);


								    		$billing_overall_total = $_SESSION[$sess_name105.'_'.$x.'_6'] + $_SESSION[$sess_name105.'_'.$x.'_3'] - $_SESSION[$sess_name105.'_'.$x.'_5'];

								    		$billing_payments_total = 0;


								    		for($y=0;$y<$row56;$y++)
								    		{


								    			$billing_payments_total += $_SESSION[$sess_name106.'_'.$y.'_0'];


								    		}



								    		if($billing_payments_total==0 && $x == 0)
								    		{



								    			 //get rental taxi
										    	$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
										    	$row100 = MYSQL_SELECT("select taxi.body_no,billing_taxi.t_current_rent_price,in_out.in_time,in_out.out_time from taxi,billing_taxi,in_out where taxi.t_id=billing_taxi.t_id and in_out.b_id=billing_taxi.b_id and billing_taxi.b_id = ". $_SESSION[$sess_name105.'_'.$x.'_0'],$sess_name100,3);

										    	for($xx=0;$xx<$row100;$xx++)
										    	{

											    	if(isset($_SESSION[$sess_name100.'_'.$xx.'_0']))
											    	{
											    		$overall_total += $_SESSION[$sess_name100.'_'.$xx.'_1'];
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
										    	$row101 = MYSQL_SELECT("select gas_amount,current_gas_price,gas_time from gas where d_id = ". $_SESSION['cashier_driver_id'] . " and b_id=".$_SESSION[$sess_name105.'_'.$x.'_0']." order by g_id desc",$sess_name101,2);

										    	for($xxx=0;$xxx<$row101;$xxx++)
										    	{

											    	if(isset($_SESSION[$sess_name101.'_'.$xxx.'_0']))
											    	{
											    		$overall_total += $_SESSION[$sess_name101.'_'.$xxx.'_0'] * $_SESSION[$sess_name101.'_'.$xxx.'_1'];
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




								    		}
								    		else
								    		{
								    			if($billing_overall_total != $billing_payments_total)
								    			{

								    				$overall_total += $billing_overall_total-$billing_payments_total;

								    				echo "

									    		 				<tr style='background-color:darkgray'>
														      	<td>Balance</td>
														        <td>".number_format($billing_overall_total-$billing_payments_total,2)."</td>
														        <td>".DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7'])."</td>
														      	</tr>


									    		 			";
								    			}
								    		}



								    	}

									    


								    	if($overall_total==0)
								    	{
								    		$_SESSION['error'] = "No balance or payable service/items.";
								    		echo "<script>window.location.href='cashier.php';</script>";
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



							<form action='cashier_payment_add.php' method='post'>

							<div class='form-group'>
								<label id='search_label'>Enter Amount</label>
								<input type='number' step='any' name='enter_amount_tb' id='search_box' class='form-control enter_amount' oninput='UPDATE_CHANGE()' value='";

									if(isset($_SESSION['cashier_enter_amount']))
									{
										echo $_SESSION['cashier_enter_amount'];
									}
									


								echo "' required/>
							</div>


							<div class='form-group'>
								<label id='search_label'>Change</label>
								<input type='number' step='any' name='change_tb' id='search_box' class='form-control change' readonly/>
							</div>

							

						
							<center><input type='submit' value='Proceed' class='btn-success' style='padding:20px 40px 20px 40px' /></center>


							</form>


							<br>

							<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"cashier.php\"'>Go Back</button></center>




							<script>
							UPDATE_CHANGE();
							function UPDATE_CHANGE()
							{

								$(document).ready(function(){

									var val = $('.enter_amount').val();
									var amount = val - ".$overall_total.";

									if(val > 0)
									{

										
										if(amount > 0)
										{
											$('.change').val(amount);
										}
										else
										{
											$('.change').val(\"0\");
										}
									}

								});

								

							}
							</script>
							
							

				";




			}

			


		?>



		<br>
		<br>
		<hr>
		<br>




							



		
	</div>


	




</body>


</html>