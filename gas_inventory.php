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

?>


<!DOCTYPE html>

<html>

<head>

<title>Taxi System - Admin - Gas Inventory</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>
<link rel='stylesheet' href='css_/custom.css'>


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

	

<center>
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
		</center>
		<div class='container'>

		<div class='row'>



			<div class='col-sm-6'>


													<?php


														include("functions/db.php");

													    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

													    	MYSQL_SELECT("select sum(refill_amount) from gas_inventory where tank_no=1",$sess_name,0);


													    	$sess_name1 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

													    	MYSQL_SELECT("select sum(gas_amount) from gas where tank_no=1",$sess_name1,0);


													    	echo "<center><h1>GAS TANK 1</h1></center>";
													    	echo "<h4><b>Total Tank 1 Gas: ".number_format(($_SESSION[$sess_name.'_0_0'] - $_SESSION[$sess_name1.'_0_0']),2)." Liters</b></h4>";





													?>

													<br>
													<br>

		



		


										<h4><b>Refill Gas Tank 1</b></h4>

										<form class='form' action='functions/gas_inventory.php' method='post'>

											<div class='form-group'>
												<label>No. of Liters</label>
												<input type='number' step='any' name='refill_tb' class='form-control' placeholder="No of liters" value='' required/>
											</div>

											<input type='submit' value='Refill Gas'/>

										</form>





										<br>
										<br>



										<h4><b>Gas Tank 1 Refill History</b></h4>


											<table class='table table-striped'>

												<thead>
											      <tr>
											        <th>No. of Liters</th>
											        <th>Date</th>
											        <!-- <th>Action</th> -->
											      </tr>
											    </thead>

											    <tbody>


											    	<?php 



											    	$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

											    	$row = MYSQL_SELECT("select * from gas_inventory where tank_no=1 order by gt_id desc",$sess_name3,2);

											    	for($x=0;$x<$row;$x++)
											    	{

											    		echo "<tr>
											    		<td>".$_SESSION[$sess_name3.'_'.$x.'_1']."</td>
											    		<td>".DateNumToTextAndTime($_SESSION[$sess_name3.'_'.$x.'_2'])."</td>
											    		</tr>";
											    	}



											    		// echo "<tr>
											    		// <td>".$_SESSION[$sess_name3.'_'.$x.'_1']."</td>
											    		// <td>".DateNumToTextAndTime($_SESSION[$sess_name3.'_'.$x.'_2'])."</td>
											    		// <td><a href='gas_inventory_edit.php?id=".$_SESSION[$sess_name3.'_'.$x.'_0']."'>Edit</a></td>
											    		// </tr>";
											    	?>

											    	
											    </tbody>

											</table>




			</div>



								


								<div class='col-sm-6'>


													<?php




													    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s')."x2";

													    	MYSQL_SELECT("select sum(refill_amount) from gas_inventory where tank_no=2",$sess_name,0);


													    	$sess_name1 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s')."x2";

													    	MYSQL_SELECT("select sum(gas_amount) from gas where tank_no=2",$sess_name1,0);


													    	echo "<center><h1>GAS TANK 2</h1></center>";
													    	echo "<h4><b>Total Tank 2 Gas: ".number_format(($_SESSION[$sess_name.'_0_0'] - $_SESSION[$sess_name1.'_0_0']),2)." Liters</b></h4>";





													?>

													<br>
													<br>


													<h4><b>Refill Gas Tank 2</b></h4>

													

													<form class='form' action='functions/gas_inventory2.php' method='post'>

														<div class='form-group'>
															<label>No. of Liters</label>
															<input type='number' step='any' name='refill_tb' class='form-control' placeholder="No of liters" value='' required/>
														</div>

														<input type='submit' value='Refill Gas'/>

													</form>


													<br>
													<br>


													<h4><b>Gas Tank 2 Refill History</b></h4>


														<table class='table table-striped'>

															<thead>
														      <tr>
														        <th>No. of Liters</th>
														        <th>Date</th>
														        <!-- <th>Action</th> -->
														      </tr>
														    </thead>

														    <tbody>


														    	<?php 



														    	$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s')."x2";

														    	$row = MYSQL_SELECT("select * from gas_inventory where tank_no=2 order by gt_id desc",$sess_name3,2);

														    	for($x=0;$x<$row;$x++)
														    	{

														    		echo "<tr>
														    		<td>".$_SESSION[$sess_name3.'_'.$x.'_1']."</td>
														    		<td>".DateNumToTextAndTime($_SESSION[$sess_name3.'_'.$x.'_2'])."</td>
														    		
														    		</tr>";
														    	}

														    	?>

														    	
														    </tbody>

														</table>


											</div>




		</div>

	</div>





</body>


</html>