
<?php

session_start();
include("db.php");

if($_POST)
{


		if(isset($_SESSION['cashier_driver_id']))
		{

		$ok = true;	

										$overall_total = 0;

										//for billing

										$others_amount = 0;
										$others_reason = "";
										$discount_amount = 0;
										$discount_reason = "";


										




								    	if(isset($_SESSION['cashier_others_amount']) && isset($_SESSION['cashier_others_reason']))
								    	{
								    		if(is_numeric($_SESSION['cashier_others_amount']) && $_SESSION['cashier_others_amount'] > 0)
								    		{
								    			$others_amount = $_SESSION['cashier_others_amount'];
												$others_reason = str_replace("'", "''", $_SESSION['cashier_others_reason']);
								    		}
								    	}


								    	if(isset($_SESSION['cashier_discount_amount']) && isset($_SESSION['cashier_discount_reason']))
								    	{
								    		if(is_numeric($_SESSION['cashier_discount_amount']) && $_SESSION['cashier_discount_amount'] > 0)
								    		{
								    			$discount_amount = $_SESSION['cashier_discount_amount'];
												$discount_reason = str_replace("'", "''", $_SESSION['cashier_discount_reason']);
								    		}
								    	}



										date_default_timezone_set('Asia/Manila');


										MYSQL_INSERT("billing","d_id,others_reason,others_amount,discount_reason,discount_amount,overall_total,b_time",
										$_SESSION['cashier_driver_id'].",'"
										.$others_reason."',"
										.$others_amount.",'"
										.$discount_reason."',"
										.$discount_amount.",0,'"
										.Date("Y-m-d H:i:s")."'");





										$b_id = 0;


										$sess_name102 = "data102_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	MYSQL_SELECT("select b_id from billing where d_id = ". $_SESSION['cashier_driver_id'] . " order by b_id desc limit 1",$sess_name102,0);


								    	$b_id = $_SESSION[$sess_name102.'_0_0'];



								    	$sess_name1101010 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


										MYSQL_SELECT("select f_name,m_name,l_name from driver where d_id=". $_SESSION['cashier_driver_id'],$sess_name1101010,2);

										$fullname = $_SESSION[$sess_name1101010.'_0_0'] . " " . $_SESSION[$sess_name1101010.'_0_1'] . " " . $_SESSION[$sess_name1101010.'_0_2'];

								    	include("logs.php");
										log_add("Billing. Billing ID: ".$b_id." / Driver Name: ".str_replace("'", "''", $fullname)." / Driver ID: ".$_SESSION['cashier_driver_id']);




								    	//get rental taxi
										$sess_name100 = "data100_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row100 = MYSQL_SELECT("select taxi.t_id,taxi_class.rental_price,in_out.io_id from taxi,taxi_class,in_out where taxi.tc_id=taxi_class.tc_id and taxi.t_id=in_out.t_id and in_out.d_id = ". $_SESSION['cashier_driver_id'] . " and in_out.b_id=0 order by in_out.io_id desc",$sess_name100,2);

								    	for($x=0;$x<$row100;$x++)
								    	{

									    	if(isset($_SESSION[$sess_name100.'_'.$x.'_0']))
									    	{
									    		$overall_total += $_SESSION[$sess_name100.'_'.$x.'_1'];

									    		MYSQL_INSERT("billing_taxi","b_id,t_id,t_current_rent_price",$b_id.",".$_SESSION[$sess_name100.'_'.$x.'_0'].",".$_SESSION[$sess_name100.'_'.$x.'_1']);

									    		MYSQL_UPDATE("update in_out set b_id=".$b_id." where io_id=".$_SESSION[$sess_name100.'_'.$x.'_2']);
									    	}
								    	}












								    	//get gas
								    	$sess_name101 = "data101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row101 = MYSQL_SELECT("select gas_amount,current_gas_price,g_id from gas where d_id = ". $_SESSION['cashier_driver_id'] . " and b_id=0 order by g_id desc",$sess_name101,2);

								    	for($x=0;$x<$row101;$x++)
								    	{

									    	if(isset($_SESSION[$sess_name101.'_'.$x.'_0']))
									    	{
									    		$overall_total += $_SESSION[$sess_name101.'_'.$x.'_0'] * $_SESSION[$sess_name101.'_'.$x.'_1'];

									    		MYSQL_UPDATE("update gas set b_id=".$b_id . " where g_id=".$_SESSION[$sess_name101.'_'.$x.'_2']);
									    		
									    	}
									    }



									    //purchased items


									    for($x = 0;$x < $_SESSION['purchased_index'];$x++)
								    	{


								    		if(isset($_SESSION['purchased_'.$x]))
								    		{
								    			if(is_numeric($_SESSION['purchased_'.$x]))
								    			{
								    				$sess_name21 = "data21_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    		 		MYSQL_SELECT("select * from products where p_id = ". $_SESSION['purchased_'.$x],$sess_name21,2);


								    		 		if(isset($_SESSION[$sess_name21.'_0_0']))
								    		 		{
								    		 			
								    		 			$overall_total += $_SESSION[$sess_name21.'_0_2'];
								    		 			
								    		 			$_SESSION[$sess_name21.'_0_1'] = str_replace("'", "''", $_SESSION[$sess_name21.'_0_1']);

								    		 			MYSQL_INSERT("billing_products","b_id,p_id,p_current_price,p_current_name",$b_id.",".$_SESSION[$sess_name21.'_0_0'].",".$_SESSION[$sess_name21.'_0_2'].",'".$_SESSION[$sess_name21.'_0_1']."'");
								    		 		}

								    			}
								    		}


								    	}





								    	MYSQL_UPDATE("update billing set overall_total=".$overall_total." where b_id=".$b_id);


								    	$_SESSION['purchased_index'] = 0;
										unset($_SESSION['purchased_index']);

										unset($_SESSION['cashier_others_amount']);
										unset($_SESSION['cashier_others_reason']);
										unset($_SESSION['cashier_discount_amount']);
										unset($_SESSION['cashier_discount_reason']);


										$_SESSION['success'] = "Billing successfully created. Please proceed to Payment.";

										header("location:../cashier_payment.php");


}
else
{
	header("location:../cashier.php");
}

		

	
}
else
{
	header("location:../index.php");
}



?>