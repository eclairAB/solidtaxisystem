<?php


session_start();


include("functions/db.php");
include("includes/utils.php");

include("includes/isloggedin.php");

if (ISLOGGEDIN() == true) {
	if (ISCASHIER() == true) {
	} else {
		header("location:index.php");
	}
} else {
	header("location:index.php");
}

?>


<!DOCTYPE html>

<html>

<head>

	<title>Taxi System - Gas Boy/Girl</title>

	<?php include("includes/head.php");
	PRINT_HEAD(); ?>

	<link rel='stylesheet' href='css_/admin.css'>
	<link rel='stylesheet' href='css_/gas.css'>


	<!-- <link rel="stylesheet" href="plugins/jquery.numpad.css">
<script type="text/javascript" src="plugins/jquery.numpad.js"></script> -->

	<link rel="stylesheet" href="plugins/easy-numpad/easy-numpad.min.css">


</head>


<body>

	<link rel='stylesheet' href='css_/custom.css'>

	<div id='header'>
		<?php
		echo $_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'] . ", " . $_SESSION['login_position_0_0'] . "&nbsp";
		?>

		<button style='color:black!important' onclick='window.location.href="logout.php"'>Logout</button>

	</div>

	<?php include("includes/cashier_nav.php");
	PRINT_NAV(); ?>










	<div id='body_div'>




		<?php



		if (isset($_SESSION['error'])) {
			echo "<br><center><p style='color:red'>" . $_SESSION['error'] . "</p></center><br>";
			unset($_SESSION['error']);
		}

		if (isset($_SESSION['success'])) {
			echo "<br><center><p style='color:green'>" . $_SESSION['success'] . "</p></center><br>";
			unset($_SESSION['success']);
		}




		if (isset($_SESSION['gas_taxi_id']) && isset($_SESSION['gas_driver_id'])) {
		} else {
			echo "

			<form action='cashier_gas.php' method ='get'>

			</form>

			<form action='cashier_gas.php' method ='get'>

				<div class='form-group'>
							<label id='search_label'>Search Taxi</label>
							<div class='easy-get'>
								<input type='number' step='any' name='searchtaxi' id='search_box' class='form-control easy-put' readonly='true' placeholder='Taxi body no' requried>
							</div>
				</div>

				<center><input type='submit' value='Search' class='btn-success' style='padding:20px 40px 20px 40px' /> <br><br>

				<button type='button' class='btn-success' style='padding:20px 40px 20px 40px' onclick='window.location.href=\"cashier.php\"'>Go Back</button></center>

			</form>

			<br>
			<br>";
		}


		if (isset($_SESSION['gas_taxi_id'])) {
			echo "<hr>
				  <br>
				";
		}


		?>








		<?php


		if (isset($_GET['driverremove'])) {
			if (preg_match("/^[0-9]{1,}$/", $_GET['driverremove'])) {
				unset($_SESSION['gas_driver_id']);
				header("location:cashier_gas.php");
			} else {
				header("location:cashier_gas.php");
			}
		}


		if (isset($_GET['driverid'])) {
			if (preg_match("/^[0-9]{1,}$/", $_GET['driverid'])) {


				$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


				MYSQL_SELECT("select * from driver where d_id=" . $_GET['driverid'], $sess_name3, 9);



				if (isset($_SESSION[$sess_name3 . '_0_0'])) {
					if (empty($_SESSION[$sess_name3 . '_0_0'])) {
						header("location:index.php");
					} else {


						if (!isset($_SESSION['gas_driver_id'])) {
							$_SESSION['gas_driver_id'] = $_GET['driverid'];
							header("location:cashier_gas.php");
						} else {
							header("location:cashier_gas.php");
						}
					}
				} else {
					header("location:index.php");
				}
			} else {
				header("location:index.php");
			}
		}






		if (isset($_SESSION['gas_driver_id'])) {



			$sess_name4 = "data4_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			$row = 0;


			$row = MYSQL_SELECT("select * from driver where d_id=" . $_SESSION['gas_driver_id'], $sess_name4, 9);

			if ($row != 0) {
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



			for ($x = 0; $x < $row; $x++) {

				$sess_name5 = "data5_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				MYSQL_SELECT("select dc_text from driver_class where dc_id=" . $_SESSION[$sess_name4 . '_' . $x . '_9'], $sess_name5, 0);

				echo "<tr>";

				if ($_SESSION[$sess_name4 . '_' . $x . '_8'] != "") {
					echo "<td><img class='img-responsive' src='img/profile_pic/" . $_SESSION[$sess_name4 . '_' . $x . '_8'] . "' height=\"100px\" width=\"100px\"/></td>";
				} else {
					echo "<td>No Image</td>";
				}




				echo "
				    		<td>" . $_SESSION[$sess_name4 . '_' . $x . '_1'] . " " . $_SESSION[$sess_name4 . '_' . $x . '_2'] . " " . $_SESSION[$sess_name4 . '_' . $x . '_3'] . "</td>
				    		<td>" . $_SESSION[$sess_name4 . '_0_6'] . "</td>
				    		<td>" . $_SESSION[$sess_name5 . '_0_0'] . "</td>
				    		</tr>";
			}


			if ($row != 0) {

				echo "
					    	
					    </tbody>
					  
						</table>
						";
			}
		}











		if (isset($_GET['taxiremove'])) {
			if (preg_match("/^[0-9]{1,}$/", $_GET['taxiremove'])) {
				unset($_SESSION['gas_taxi_id']);
				unset($_SESSION['gas_driver_id']);
				header("location:cashier_gas.php");
			} else {
				header("location:cashier_gas.php");
			}
		}


		if (isset($_GET['taxiid'])) {
			if (preg_match("/^[0-9]{1,}$/", $_GET['taxiid'])) {


				$sess_name8 = "data8_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


				MYSQL_SELECT("select * from taxi where t_id=" . $_GET['taxiid'], $sess_name8, 4);



				if (isset($_SESSION[$sess_name8 . '_0_0'])) {
					if (empty($_SESSION[$sess_name8 . '_0_0'])) {
						header("location:index.php");
					} else {


						if (!isset($_SESSION['gas_taxi_id'])) {

							$_SESSION['gas_taxi_id'] = $_GET['taxiid'];


							$sess_name88 = "data88_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


							MYSQL_SELECT("select d_id,b_id from in_out where t_id=" . $_SESSION['gas_taxi_id'] . " order by io_id desc limit 1", $sess_name88, 1);


							if (isset($_SESSION[$sess_name88 . '_0_0'])) {
								if ($_SESSION[$sess_name88 . '_0_1'] != 0) {
									unset($_SESSION['gas_taxi_id']);
									unset($_SESSION['gas_driver_id']);
									$_SESSION['error'] = "Taxi is not yet rented.";
									header("location:cashier_gas.php");
								} else {
									$_SESSION['gas_driver_id'] = $_SESSION[$sess_name88 . '_0_0'];
									header("location:cashier_gas.php");
								}
							} else {
								unset($_SESSION['gas_taxi_id']);
								unset($_SESSION['gas_driver_id']);
								$_SESSION['error'] = "Taxi is not yet rented.";
								header("location:cashier_gas.php");
							}





							header("location:cashier_gas.php");
						} else {
							header("location:cashier_gas.php");
						}
					}
				} else {
					header("location:index.php");
				}
			} else {
				header("location:index.php");
			}
		}






		if (isset($_SESSION['gas_taxi_id'])) {



			$sess_name9 = "data9_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			$row3 = 0;


			$row3 = MYSQL_SELECT("select * from taxi where t_id=" . $_SESSION['gas_taxi_id'], $sess_name9, 4);

			if ($row3 != 0) {
				echo "
						 	<h4><b>Selected Taxi</b></h4>

							<table class='table table-striped' id='selected_table'>

								<thead style='color:white;'>
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



			for ($x = 0; $x < $row3; $x++) {

				$sess_name10 = "data10_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=" . $_SESSION[$sess_name9 . '_' . $x . '_4'], $sess_name10, 1);

				echo "<tr>
				    		<td>" . $_SESSION[$sess_name9 . '_' . $x . '_1'] . "</td>
				    		<td>" . $_SESSION[$sess_name9 . '_' . $x . '_2'] . "</td>
				    		<td>" . $_SESSION[$sess_name10 . '_0_0'] . "</td>
				    		<td>" . number_format($_SESSION[$sess_name10 . '_0_1'], 2) . "</td>
				    		<td><a href='cashier_gas.php?taxiremove=" . $_SESSION[$sess_name9 . '_' . $x . '_0'] . "'><button type='button' id='_buttons' class='btn-danger'>Remove</button></a></td>
				    		</tr>";
			}


			if ($row3 != 0) {

				echo "
					    	
					    </tbody>
					  
						</table>
						";
			}
		}




		if (isset($_SESSION['gas_taxi_id']) && isset($_SESSION['gas_driver_id'])) {

			echo "


				<form action='cashier_gas_add.php' method='post'>
					<div class='form-group'>

					<div class='form-group'>
						<label id='search_label'>Tank No</label> 

						<select name='tank_no' class='form-control'>
							<option>1</option>
							<option>2</option>
						</select>

					</div>
					
						<label id='search_label'>No. of liters</label>
						<input type='number' step='any' name='gas_amount_tb' id='search_box' class='form-control num_pad' value='";

			if (isset($_SESSION['gas_amount_tb'])) {
				echo $_SESSION['gas_amount_tb'];
				unset($_SESSION['gas_amount_tb']);
			}


			echo "' requried/>
					</div>

					<div class='form-group'>
						<label id='search_label'>ODO</label> 
						<input type='number' step='any' name='odo_tb' id='search_box' class='form-control num_pad' value='";

			if (isset($_SESSION['odo_tb'])) {
				echo $_SESSION['odo_tb'];
				unset($_SESSION['odo_tb']);
			}


			echo "' requried/>
					</div>




				
					<center><input type='submit' value='Proceed' class='btn-success' style='padding:20px 40px 20px 40px' /></center>


				</form>
				";
		}


		if (isset($_SESSION['gas_taxi_id'])) {
			echo "<br>
					<br>
					<hr>
					<br>
					";
		}


		?>








		<?php




		//search driver

		$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		$row = 0;

		if (isset($_GET['searchdriver'])) {
			if (!empty($_GET['searchdriver'])) {
				$search_this = str_replace("'", "''", $_GET['searchdriver']);

				$row = MYSQL_SELECT("select * from driver where CONCAT(f_name,' ',m_name,' ',l_name) like '%" . $_GET['searchdriver'] . "%'", $sess_name, 9);
			}
		}

		if ($row != 0) {
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











		for ($x = 0; $x < $row; $x++) {

			$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			MYSQL_SELECT("select dc_text from driver_class where dc_id=" . $_SESSION[$sess_name . '_' . $x . '_9'], $sess_name2, 0);

			echo "<tr>";

			if ($_SESSION[$sess_name . '_' . $x . '_8'] != "") {
				echo "<td><img class='img-responsive' src='img/profile_pic/" . $_SESSION[$sess_name . '_' . $x . '_8'] . "' height=\"100px\" width=\"100px\"/></td>";
			} else {
				echo "<td>No Image</td>";
			}




			echo "
		    		<td>" . $_SESSION[$sess_name . '_' . $x . '_1'] . " " . $_SESSION[$sess_name . '_' . $x . '_2'] . " " . $_SESSION[$sess_name . '_' . $x . '_3'] . "</td>
		    		<td>" . $_SESSION[$sess_name . '_' . $x . '_6'] . "</td>
		    		<td>" . $_SESSION[$sess_name2 . '_0_0'] . "</td>
		    		<td><a href='cashier_gas.php?driverid=" . $_SESSION[$sess_name . '_' . $x . '_0'] . "'><button type='button' id='_buttons' class='btn-success'>Select Driver</button></a></td>
		    		</tr>";
		}


		if ($row != 0) {

			echo "
		    	
		    </tbody>
		  
			</table>
			";
		}





		//search taxi

		$sess_name6 = "data6_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		$row2 = 0;

		if (isset($_GET['searchtaxi'])) {
			if (!empty($_GET['searchtaxi'])) {
				$search_this = str_replace("'", "''", $_GET['searchtaxi']);

				$row2 = MYSQL_SELECT("select * from taxi where body_no like '%" . $_GET['searchtaxi'] . "%'", $sess_name6, 4);
			}
		}

		if ($row2 != 0) {
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


		$ok_loop = false;


		for ($x = 0; $x < $row2; $x++) {






			$sess_name888 = "data888_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;


			MYSQL_SELECT("select d_id,b_id from in_out where t_id=" . $_SESSION[$sess_name6 . '_' . $x . '_0'] . " order by io_id desc limit 1", $sess_name888, 1);

			$ok = true;

			if (isset($_SESSION[$sess_name888 . '_0_0'])) {
				if ($_SESSION[$sess_name888 . '_0_1'] != 0) {
					$ok = false;
				}
			} else {
				$ok = false;
			}


			if ($ok == true) {

				$ok_loop = true;

				$sess_name7 = "data7_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

				MYSQL_SELECT("select tc_text,rental_price from taxi_class where tc_id=" . $_SESSION[$sess_name6 . '_' . $x . '_4'], $sess_name7, 1);

				echo "<tr>
						    		<td>" . $_SESSION[$sess_name6 . '_' . $x . '_1'] . "</td>
						    		<td>" . $_SESSION[$sess_name6 . '_' . $x . '_2'] . "</td>
						    		<td>" . $_SESSION[$sess_name7 . '_0_0'] . "</td>
						    		<td>" . number_format($_SESSION[$sess_name7 . '_0_1'], 2) . "</td>
						    		<td><a href='cashier_gas.php?taxiid=" . $_SESSION[$sess_name6 . '_' . $x . '_0'] . "'><button type='button' id='_buttons' class='btn-success'>Select Taxi</button></a></td>
						    		</tr>";
			}
		}


		if ($row2 != 0) {

			if ($ok_loop == false) {
				echo "<tr>
						    		<td>No available</td>
						    		<td></td>
						    		<td></td>
						    		<td></td>
						    		<td></td>
						    		</tr>";
			}

			echo "
			    	
			    </tbody>
			  
				</table>
				";
		}









		?>

		<script src="plugins/easy-numpad/easy-numpad.min.js"></script>

		<script>
			// $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
			// $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
			// $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control"/>';
			// $.fn.numpad.defaults.buttonNumberTpl = '<button type="button" class="btn btn-default"></button>';
			// $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
			// $.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};

			// $(document).ready(function(){

			// $('.num_pad').numpad();

			// });
		</script>





	</div>







</body>


</html>