<?php


		session_start();

		include("includes/isloggedin.php");
		include("includes/utils.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true  || ISMAINTENANCE()==true)
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

<title>Taxi System - Admin - Taxi - Change Oil</title>
	
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


			echo "<center><h1>Change Oil</h1></center>";



					//taxi details


					$sess_name9 = "data9_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			    	$row3 = 0;

		    
		    		$row3 = MYSQL_SELECT("select * from taxi where t_id=".$_SESSION[$sess_name.'_0_0'],$sess_name9,4);

					
					 	echo "
						 	<h4><b>Body No: ".$_SESSION[$sess_name.'_0_1']."</b></h4>

							<table class='table table-striped' id='selected_table' style='background-color: green;border:2px solid green;'>

								<thead style='color:white;'>
							      <tr>
							        <th>Plate no</th>
							        <th>Acquired Date</th>
							        <th>Taxi Classification</th>
							        <th>Rental Price</th>
							        <th>Current ODO</th>
							        <th>Status</th>
							        <th>Maintenance</th>
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
				    		</tr>";
				    	}

				    	
					  
					   	echo "
					    	
					    </tbody>
					  
						</table>


						<br>

						<center>

						<h4>Please confirm.</h4>

						<form action='functions/taxi_change_oil_add.php' method='post'>

						<input type='hidden' name='id_tb' class='form-control' value='". $_GET['id'] . "' />


						<input type='submit' class='btn-success' style='padding:20px 40px 20px 40px' value='Confirm'/>

						</form>

						<br>

						<button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"taxi_change_oil.php?id=".$_GET['id']."\"'>Go Back</button>

						

						</center>

						<br>
						<hr>
						

						";




					 	



		?>
		
		




		
	</div>


	




</body>


</html>