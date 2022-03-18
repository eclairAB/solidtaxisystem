
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['remitance_amount']))
	{

		$ok = true;

		if(!is_numeric($_POST['remitance_amount']))
		{
			$_SESSION['error'] = "Not a number.";
			header("location:../remit_sss.php");
			$ok = false;
		}
		else
		{
			if($_POST['remitance_amount'] < 1)
			{
				$_SESSION['error'] = "Amount should be greater than 1.";
				header("location:../remit_sss.php");
				$ok = false;
			}



										//remitance history
								    	$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') ."d1d1d1";
								    	$row100 = MYSQL_SELECT("select remit,d_rem_date from driver_remitance where d_id = ". $_SESSION['cashier_driver_id'] . " and remitance_type='sss' order by d_rem_id desc",$sess_name100,3);

								    	$total_remitance = 0;

								    	for($x=0;$x<$row100;$x++)
								    	{

								    			$total_remitance += $_SESSION[$sess_name100.'_'.$x.'_0'];
									    	
									    		
									    	
								    	}



								    	

								    	//total contribution
								    	$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') ."d1d1d1";
								    	MYSQL_SELECT("select sum(billing_products.p_current_price) from billing_products,billing where billing.d_id = ". $_SESSION['cashier_driver_id'] . " and billing_products.b_id=billing.b_id and billing_products.p_current_name like 'sss%'",$sess_name101,0);

								    	
								    	$total_contribution = 0;

								    	if(isset($_SESSION[$sess_name101.'_0_0']))
								    	{
								    		$total_contribution = $_SESSION[$sess_name101.'_0_0'];
								    	}


			if($_POST['remitance_amount'] > ($total_contribution-$total_remitance))
			{
				$_SESSION['error'] = "Amount is greater than available amount.";
				header("location:../remit_sss.php");
				$ok = false;
			}

		}



		









		if($ok == true)
		{


										




			

			date_default_timezone_set('Asia/Manila');


			MYSQL_INSERT("driver_remitance","d_id,remit,d_rem_date,remitance_type",$_SESSION['cashier_driver_id'].",".$_POST['remitance_amount'].",'".Date("Y-m-d H:i:s")."','sss'");



			
														$sess_name1101010 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
														MYSQL_SELECT("select f_name,m_name,l_name from driver where d_id=". $_SESSION['cashier_driver_id'],$sess_name1101010,2);

														$fullname = $_SESSION[$sess_name1101010.'_0_0'] . " " . $_SESSION[$sess_name1101010.'_0_1'] . " " . $_SESSION[$sess_name1101010.'_0_2'];

														include("logs.php");
														log_add("SSS Remitance. Amount: ".number_format($_POST['remitance_amount'],2)." / Driver Name: ".str_replace("'", "''", $fullname)." / Driver ID: ".$_SESSION['cashier_driver_id']);



			$_SESSION['success'] = "Successful!";
			header("location:../remit_sss.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../remit_sss.php");
	}
}
else
{
	header("location:../index.php");
}



?>