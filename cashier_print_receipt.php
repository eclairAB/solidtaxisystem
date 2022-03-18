<?php


		session_start();


		include("functions/db.php");
		 include("includes/utils.php");

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISCASHIER()==true)
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

<title>Taxi System - Cashier</title>
	
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

		

		
		if(isset($_SESSION['cashier_driver_id']))
		{
			echo "

				<hr>
				<br>

			";
		}


		?>

		
		





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


						<br>

							<center><button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"cashier.php\"'>Go Back</button></center>

						";


					 	}









			}





			
			

			if(isset($_SESSION['cashier_driver_id']))
			{
				echo "
					<br>
					<br>
					<hr>
					<br>";



					echo "

					<table class='table table-striped' style='border:2px solid #c65825'>
					<thead style='color:white;background-color:#c65825'>
							      <tr>
							      	<th>Date</th>
							        <th>Receipt</th>
							      </tr>
							    </thead>

					<tbody>";


					$sess_name78 = "data78_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
					$row78 = MYSQL_SELECT("select * from billing_receipt where d_id=".$_SESSION['cashier_driver_id'] . " order by br_id desc",$sess_name78,3);

					for($x=0;$x<$row78;$x++)
					{
						echo "<tr>
								<td>".DateNumToTextAndTime($_SESSION[$sess_name78.'_'.$x.'_3'])."</td>
								<td><a href=\"".$_SESSION[$sess_name78.'_'.$x.'_2']."\" target='_blank'>View or Print</a></td>
								</tr>";
					}



					echo "</tbody>
						</table>";

			}


		?>



		








		
	</div>


	




</body>


</html>