<?php


		session_start();

		include("includes/isloggedin.php");
		include("includes/utils.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true || ISMAINTENANCE()==true)
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


				MYSQL_SELECT("select * from taxi where t_id=".$_GET['id'],$sess_name,4);

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

<title>Taxi System - Admin - Taxi - Maintenance</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>
<link rel='stylesheet' href='css_/styles.css'>


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
	<br>
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



					//taxi details


					$sess_name9 = "data9_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row3 = 0;

		    
		    		$row3 = MYSQL_SELECT("select * from taxi where t_id=".$_SESSION[$sess_name.'_0_0'],$sess_name9,4);

					
					 	echo "
						 	<h4><b>Body No: ".$_SESSION[$sess_name.'_0_1']."</b></h4>

							 <table class='table table-striped' id='selected_table' style='background-color: #5658bf;border:2px solid #5658bf;'>

								<thead style='color:white;'>
							      <tr>
							        <th>Plate no</th>
							        <th>Acquired Date</th>
							        <th>Taxi Classification</th>
							        <th>Rental Price</th>
							        <th>Current ODO</th>
							        <th>Status</th>
									<th>Maintenance</th>
									<th>Total Maintenance Cost</th>
							      </tr>
							    </thead>

							    <tbody>
					    		";
					 	
				

				    	for($x=0;$x<$row3;$x++)
				    	{

				    		$sess_name10 = "data10_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				    		MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=".$_SESSION[$sess_name9.'_'.$x.'_4'],$sess_name10,1);

				    		echo "<tr>
				    		<td>".$_SESSION[$sess_name9.'_'.$x.'_2']."</td>
				    		<td>".DateNumToText($_SESSION[$sess_name9.'_'.$x.'_3'])."</td>
				    		<td>".$_SESSION[$sess_name10.'_0_0']."</td>
				    		<td>".number_format($_SESSION[$sess_name10.'_0_1'],2)."</td>";



				    		$odo = 0;

				    		$sess_name333 = "data333_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x;

		    				MYSQL_SELECT("select odo from gas where t_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " order by g_id desc limit 1",$sess_name333,0);


		    				if(isset($_SESSION[$sess_name333.'_0_0']))
		    				{
		    					$odo = $_SESSION[$sess_name333.'_0_0'];
		    				}


		    				echo "<td>".number_format($odo)."</td>";



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
								<td class='maintenance-cost'>0</td>
				    		</tr>";
				    	}

				    	
					  
					   	echo "
					    	
					    </tbody>
					  
						</table>


						<br>

						<center>

						<button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"taxi_details.php?id=".$_GET['id']."\"'>Go Back</button>

						


						</center>

						<br>
						<hr>
						

						";


					 	echo "
					 	<form action='functions/taxi_maintenance_add.php' method='post'>
					 	<input type='hidden' name='id_tb' class='form-control' value='". $_GET['id'] . "' />
						<div class='form-group'>
							<label>Maintenance Job</label>
							<select class='form-control form-control-maintenance-job' name='maintenance_job'>";



								$sess_name22222 = "data22222_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

						    	$row22222 = MYSQL_SELECT("select * from taxi_maintenance_jobs",$sess_name22222,1);

						    	for($x=0;$x<$row22222;$x++)
						    	{
						    		echo "<option>".$_SESSION[$sess_name22222.'_'.$x.'_1']."</option>";
						    	}




								
							echo "
							</select>
							
						</div>

						<div class='form-group form-group-others'>
							<label>Others</label>
							<input type='text' name='others_tb' class='form-control' requried/>
						</div>

						<script>
							document.querySelector('.form-control-maintenance-job').addEventListener('change', toggleOthersTextbox);
							var othersTextboxGroup = document.querySelector('.form-group-others');
							var othersTextbox = document.querySelector('.form-group-others input');
							function toggleOthersTextbox(e){
								othersTextbox.value = '';
								othersTextboxGroup.classList.toggle('active', e.target.value == 'Others');
							}
						</script>

						<div class='form-group'>
							<label>Remarks</label>
							<input type='text' name='remarks_tb' class='form-control' requried/>
						</div>
						
						<div class='form-group'>
							<label>Job Order Number</label>
							<input type='text' name='job_order_number_tb' class='form-control' requried/>
						</div>

						<div class='form-group'>
							<label>Amount</label>
							<input type='number' step='any' name='amount_tb' class='form-control' requried/>
						</div>

						<div class='form-group'>
							<input type='submit' class='form-control' value='Add Maintenance'/>
						</div>
						
						</form>

						<hr>";






					 	echo "

					 	<h4><b>Maintenance</b></h4>
					 	<table class='table table-striped'>

								<thead>
							      <tr>
									  <th>Maintenance Job</th>
									  <th>Others</th>
									  <th>Job Order Number</th>
									  <th>Amount</th>
							      	<th>Remarks</th>
							      	<th>Date</th>
							      </tr>
							    </thead>

							    <tbody>";

								$overAllTotal = 0;

								$sess_name900 = "data900_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
					    
								$row900 = MYSQL_SELECT("select taxi_maintenance_jobs.tmp_text,taxi_maintenance.remarks,taxi_maintenance.tm_date, taxi_maintenance.others, taxi_maintenance.job_order_number, taxi_maintenance.amount
								from taxi_maintenance,taxi_maintenance_jobs 
								where taxi_maintenance_jobs.tmp_id=taxi_maintenance.tmp_id and taxi_maintenance.t_id=".$_SESSION[$sess_name.'_0_0'] . " order by taxi_maintenance.tm_id desc",$sess_name900,5);

					    		for($x=0;$x<$row900;$x++)
					    		{
					    			echo "<tr>
										<td>".$_SESSION[$sess_name900.'_'.$x.'_0']."</td>
										<td>".$_SESSION[$sess_name900.'_'.$x.'_3']."</td>
										<td>".$_SESSION[$sess_name900.'_'.$x.'_4']."</td>
										<td>".$_SESSION[$sess_name900.'_'.$x.'_5']."</td>
					    				<td>".$_SESSION[$sess_name900.'_'.$x.'_1']."</td>
					    				<td>".DateNumToTextAndTime($_SESSION[$sess_name900.'_'.$x.'_2'])."</td>
					    				</tr>";

						    		$overAllTotal += $_SESSION[$sess_name900.'_'.$x.'_5'];
						    		
					    		}






						echo "	
							    	
							    </tbody>

						</table>

							<script>
								document.querySelector('.maintenance-cost').innerHTML = '".number_format($overAllTotal,2)."';
							</script>

						";



		?>
		
		




		
	</div>


	




</body>


</html>