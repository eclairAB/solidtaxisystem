<?php


		session_start();

		include("functions/db.php");
		include("includes/isloggedin.php");
		include("includes/utils.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true)
			{

				if($_POST)
				{
					if(isset($_POST['datefrom']) && isset($_POST['dateto']))
					{
						if(!empty($_POST['datefrom']) && !empty($_POST['dateto']))
						{

						}
						else
						{
							$_SESSION['error'] = "Please select a date.";
							header("location:logs.php");
						}
					}
					else
					{
						$_SESSION['error'] = "Please select a date.";
						header("location:logs.php");
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

<title>Taxi System - Admin - Logs</title>
	
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

	<?php if(ISADMIN()==true){include("includes/admin_nav.php"); PRINT_NAV();} ?>

	



	<br>
	<br>
	<br>


	<?php

	if(isset($_SESSION['error']))
	{
				echo "<br><center><p style='color:red'>".$_SESSION['error']."</p></center><br>";
				unset($_SESSION['error']);
	}

	?>

	
	<div class='container'>



		<center><h1>LOGS</h1></center>

		<br>
		<br>




		<table class='table table-striped table-bordered'>
			<thead>
				<th>Account Name</th>
				<th>Action</th>
				<th>Date</th>
			</thead>




			<tbody>

		<?php




			$sess_name11 = "data11_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

			$search_this = str_replace("'", "''", $_POST['datefrom']);

			$search_this2 = str_replace("'", "''", $_POST['dateto']);

			$row1 = MYSQL_SELECT("select l_id,action,a_id,l_time from logs where (l_time between '".$search_this." 00:00:00' and '".$search_this2." 23:59:59') order by l_id desc",$sess_name11,3);


			for($x=0;$x<$row1;$x++)
			{




				$sess_namefullname = "data11_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x . "fullname";
				MYSQL_SELECT("select f_name,m_name,l_name,ac_id from account where a_id=".$_SESSION[$sess_name11.'_'.$x.'_2'],$sess_namefullname,3);


				$fullname = $_SESSION[$sess_namefullname.'_0_0'] . " " . $_SESSION[$sess_namefullname.'_0_1'] . " " . $_SESSION[$sess_namefullname.'_0_2'];




				$sess_nameaccountclass = "data11_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s').$x . "accountclass";
				MYSQL_SELECT("select ac_text from account_class where  ac_id=".$_SESSION[$sess_namefullname.'_0_3'],$sess_nameaccountclass,0);


				$account_class = $_SESSION[$sess_nameaccountclass.'_0_0'];



				$out = true;


				


				if($_POST['account_class_cb']!= "All")
				{
					if($_POST['account_class_cb'] != $account_class)
					{
						$out = false;
					}
				}


				if($_POST['account_cb']!= "All")
				{
					if($_POST['account_cb'] != $fullname)
					{
						$out = false;
					}
				}

				


				if($out == true)
				{


					echo "<tr>
						<td>".$fullname."</td>
						<td>".$_SESSION[$sess_name11.'_'.$x.'_1']."</td>
						<td>".DateNumToTextAndTime($_SESSION[$sess_name11.'_'.$x.'_3'])."</td>
						</tr>
						";

				}




			}








		?>


		</tbody>

	</table>








	</div>


	




</body>


</html>