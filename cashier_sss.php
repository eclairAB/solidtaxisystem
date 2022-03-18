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

<title>Taxi System - Cashier - SSS</title>
	
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




			if(isset($_SESSION['cashier_driver_id']))
			{

				echo "

					

							<h4><b>SSS Remitance History</b></h4>

							<table class='table table-striped' style='border:2px solid #5e78a3'>
								<thead style='color:white;background-color:#5e78a3' >
									      <tr>
									      	<th>Amount</th>
									        <th>Date</th>
									      </tr>
									    </thead>

									    <tbody>";


									    //remitance history
								    	$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row100 = MYSQL_SELECT("select remit,d_rem_date from driver_remitance where d_id = ". $_SESSION['cashier_driver_id'] . " and remitance_type='sss' order by d_rem_id desc",$sess_name100,1);

								    	$total_remitance = 0;

								    	for($x=0;$x<$row100;$x++)
								    	{

								    			$total_remitance += $_SESSION[$sess_name100.'_'.$x.'_0'];
									    	
									    		echo "

									    		 				<tr>
														      	<td>".number_format($_SESSION[$sess_name100.'_'.$x.'_0'],2)."</td>
														        <td>".DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$x.'_1'])."</td>
														      	</tr>


									    		 			";
									    	
								    	}




								    	//total contribution
								    	$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	MYSQL_SELECT("select sum(billing_products.p_current_price) from billing_products,billing where billing.d_id = ". $_SESSION['cashier_driver_id'] . " and billing_products.b_id=billing.b_id and billing_products.p_current_name like 'sss%'",$sess_name101,0);

								    	
								    	$total_contribution = 0;

								    	if(isset($_SESSION[$sess_name101.'_0_0']))
								    	{
								    		$total_contribution = $_SESSION[$sess_name101.'_0_0'];
								    	}


								    	

							    
							    		



						echo "

									    </tbody>
							</table>

							<br>

							<div class='row'>

								<div class='col-sm-6'>

								</div>

								<div class='col-sm-6'>
									<div style='padding:20px;border:2px solid black;background-color:lightgray'>
									<center><h2 style='color:black'>Available: <b style='color:#c65825'>".number_format($total_contribution - $total_remitance,2)."</b></h2></center>
									</div>
								</div>

							</div>


							<br>

								


							<form action='cashier_sss_add.php' method='post'>

							<div class='form-group'>
								<label id='search_label'>Remitance Amount</label>
								<input type='number' step='any' name='remitance_amount' id='search_box' class='form-control' required/>
							</div>

							
							<center><input type='submit' value='Remit' class='btn-success' style='padding:20px 40px 20px 40px' /></center>


							</form>


							<br>

							<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"cashier.php\"'>Go Back</button></center>




						


						



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