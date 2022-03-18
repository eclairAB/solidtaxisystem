<?php



session_start();



if($_POST)
{


	include("functions/logs.php"); // newly added dec 11 2020

	if(isset($_SESSION['cashier_driver_id']) && isset($_POST['enter_amount_tb']))
	{

		include("functions/db.php");
		include("includes/utils.php");



//get driver name

														$sess_name1101010 = "data10101_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
														MYSQL_SELECT("select f_name,m_name,l_name from driver where d_id=". $_SESSION['cashier_driver_id'],$sess_name1101010,2);

														$fullname = $_SESSION[$sess_name1101010.'_0_0'] . " " . $_SESSION[$sess_name1101010.'_0_1'] . " " . $_SESSION[$sess_name1101010.'_0_2'];



		include("plugins/FPDF/fpdf.php");

		$fpdf = new FPDF('P','mm', array(76,297));

		$fpdf->SetFont("Arial","",9);

		$fpdf->SetTitle("Payment Receipt");

		$fpdf->SetMargins(6, 0, 5);


		$fpdf->AddPage("P");

		$fpdf->Cell(0,13,"TRANSYLVANIA TRANZPORT, INC.",0,1,"C");
		$fpdf->Cell(0,-5,"Matina Aplaya, Davao City",0,1,"C");
		$fpdf->Cell(0,14,"Tel.No. (082)224-9544",0,1,"C");
		//$fpdf->Cell(30,3,"",0,1);

		$fpdf->Cell(0,2,"Receipt for",0,1,"C");	
		$fpdf->Cell(0,5,"".$fullname,0,1,"C");
		$fpdf->SetFont("Arial","",9);


								    	$fpdf->Cell(0,5,"","T",1,"C"); // line break

		


										$overall_total = 0;

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

											    		$fpdf->Cell(48,3,"Taxi Body No - " . $_SESSION[$sess_name100.'_'.$xx.'_0'],0,0);
											    		$fpdf->Cell(15,3,number_format($_SESSION[$sess_name100.'_'.$xx.'_1'],2),0,1,"R");
											    		//$fpdf->Cell(30,3,"Date: " . DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$xx.'_2']),0,1);
											    		//$fpdf->Cell(30,3,"to ".DateNumToTextAndTime($_SESSION[$sess_name100.'_'.$xx.'_3']),0,1);

											    		$fpdf->Cell(30,3,"",0,1);
											    		
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


											    		$fpdf->Cell(48,3,"Gas - " . $_SESSION[$sess_name101.'_'.$xxx.'_0'] . " Liters",0,0);
											    		$fpdf->Cell(15,3,number_format(($_SESSION[$sess_name101.'_'.$xxx.'_0'] * $_SESSION[$sess_name101.'_'.$xxx.'_1']),2),0,1,"R");
											    		//$fpdf->Cell(30,3,"Date: " . DateNumToTextAndTime($_SESSION[$sess_name101.'_'.$xxx.'_2']),0,1);

											    		$fpdf->Cell(30,3,"",0,1);
											    		
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
											    		

											    		$fpdf->Cell(48,3,$_SESSION[$sess_name107.'_'.$xxxx.'_0'],0,0);
											    		$fpdf->Cell(15,3,number_format(($_SESSION[$sess_name107.'_'.$xxxx.'_1']),2),0,1,"R");
											    		//$fpdf->Cell(30,3,"Date: " . DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7']),0,1);

											    		$fpdf->Cell(30,3,"",0,1);
											    		
											    	}
											    }


											    if($_SESSION[$sess_name105.'_'.$x.'_3'] != 0)
											    {
											    	$overall_total += $_SESSION[$sess_name105.'_'.$x.'_3'];


											    		$fpdf->Cell(48,3,"(Others)",0,0);
											    		//
											    		$fpdf->Cell(15,3,number_format(($_SESSION[$sess_name105.'_'.$x.'_3']),2),0,1,"R");
											    		//$fpdf->Cell(30,3,"Date: " . DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7']),0,1);
											    		$fpdf->MultiCell(0,3,"(Reason) ".$_SESSION[$sess_name105.'_'.$x.'_2'],0,1);//reason

											    		$fpdf->Cell(30,3,"",0,1);

											    	
											    }

											    		$fpdf->Cell(0,8,"Total: ".number_format($overall_total,2),0,1);
											    		$fpdf->Cell(30,3,"",0,1);
											    		
											   


											    if($_SESSION[$sess_name105.'_'.$x.'_5'] != 0)
											    {

											    	$overall_total -= $_SESSION[$sess_name105.'_'.$x.'_5'];

											    		$fpdf->Cell(48,3,"(Discount)",0,0);
											    		//$fpdf->MultiCell(30,3,"(Discount) ".$_SESSION[$sess_name105.'_'.$x.'_4'],0,1);
											    		$fpdf->Cell(15,3,number_format(($_SESSION[$sess_name105.'_'.$x.'_5']),2),0,1,"R");
											    		//$fpdf->Cell(30,3,"Date: " . DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7']),0,1);

											    		$fpdf->MultiCell(0,3,"(Reason) ".$_SESSION[$sess_name105.'_'.$x.'_4'],0,1);

											    		$fpdf->Cell(30,3,"",0,1);
											    	
											    }




								    		}
								    		else
								    		{
								    			if($billing_overall_total != $billing_payments_total)
								    			{

								    				$overall_total += $billing_overall_total-$billing_payments_total;

								    				$fpdf->Cell(0,3,"Balance: " . number_format($billing_overall_total-$billing_payments_total,2),0,1);
											    		$fpdf->Cell(0,3,"Date: " . DateNumToTextAndTime($_SESSION[$sess_name105.'_'.$x.'_7']),0,1);

											    		$fpdf->Cell(30,3,"",0,1);
								    				
								    			}
								    		}



								    	}



		
								    	$fpdf->Cell(0,8,"Overall Total: ".number_format($overall_total,2),0,1);

								    	$fpdf->Cell(30,1,"",0,1);

								    	$fpdf->Cell(0,8,"Cash: ".number_format($_POST['enter_amount_tb'],2),0,1);

								    	$fpdf->Cell(30,1,"",0,1);


								    	$change_now = $_POST['enter_amount_tb'] - $overall_total;

								    	if($change_now < 1)
								    	{
								    		$change_now = 0;
								    	}

								    	$fpdf->Cell(0,8,"Change: ".number_format($change_now,2),0,1);


								    	

								    	$balance = 0;

								    	if($_POST['enter_amount_tb'] - $overall_total < 0 )
								    	{
								    		$fpdf->Cell(30,1,"",0,1);
								    		$fpdf->Cell(0,8,"Balance: ".number_format($overall_total - $_POST['enter_amount_tb'],2),0,1);
								    	}

								    	$fpdf->Cell(0,5,"","T",1); // line break

								    	$fpdf->Cell(0,3,"Prepared by",0,1);
								    	$fpdf->Cell(0,3,$_SESSION['login_details_0_1'] . " " .  $_SESSION['login_details_0_2'] . " " . $_SESSION['login_details_0_3'],0,1);

								    	date_default_timezone_set('Asia/Manila');
								    	

								    	$fpdf->Cell(0,3,"Date: ". DateNumToTextAndTime(Date("Y-m-d H:i:s")),0,1);






								    	//ADD PAYMENT

								    	$sess_name1055 = "data1055_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    	$row555 = MYSQL_SELECT("select * from billing where d_id = ". $_SESSION['cashier_driver_id'] . " order by b_id asc",$sess_name1055,7);
								    	$money = $_POST['enter_amount_tb'];

								    	for($x=0;$x<$row555;$x++)
								    	{


								    		//check if paid
								    		$sess_name1066 = "data1066_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');
								    		$row56 = MYSQL_SELECT("select amount_payed from billing_payments where b_id=".$_SESSION[$sess_name1055.'_'.$x.'_0'],$sess_name1066,0);


								    		$billing_overall_total = $_SESSION[$sess_name1055.'_'.$x.'_6'] + $_SESSION[$sess_name1055.'_'.$x.'_3'] - $_SESSION[$sess_name1055.'_'.$x.'_5'];

								    		$billing_payments_total = 0;

								    		for($y=0;$y<$row56;$y++)
								    		{


								    			$billing_payments_total += $_SESSION[$sess_name1066.'_'.$y.'_0'];


								    		}



								    		if($billing_payments_total==0 && $x == 0)
								    		{

								    			if($money > 0)
								    			{

								    				$can_pay = 0;

								    				if($money - $billing_overall_total >= 0)
								    				{
								    					$can_pay = $billing_overall_total;
								    					$money -= $billing_overall_total;
								    				}
								    				else
								    				{
								    					$can_pay = $money;
								    					$money = -1; 
								    				}
								    				

								    				MYSQL_INSERT("billing_payments","b_id,amount_payed,pay_time",$_SESSION[$sess_name1055.'_'.$x.'_0'].",".$can_pay.",'".Date("Y-m-d H:i:s")."'");



								    				

													// removed dec 11 2020 - include("functions/logs.php");
													log_add("Payment. Amount: ".number_format($can_pay,2)." / Driver Name: ".str_replace("'", "''", $fullname)." / Driver ID: ".$_SESSION['cashier_driver_id']);



								    			}

								    			 




								    		}
								    		else
								    		{
								    			if($billing_overall_total != $billing_payments_total)
								    			{



								    				
									    			if($money > 0)
									    			{

									    				$balance_total = $billing_overall_total - $billing_payments_total;

									    				$can_pay = 0;

									    				if($money - $balance_total >= 0)
									    				{
									    					$can_pay = $balance_total;
									    					$money -= $balance_total;
									    				}
									    				else
									    				{
									    					$can_pay = $money;
									    					$money = -1; 
									    				}
									    				

									    				MYSQL_INSERT("billing_payments","b_id,amount_payed,pay_time",$_SESSION[$sess_name1055.'_'.$x.'_0'].",".$can_pay.",'".Date("Y-m-d H:i:s")."'");

									    				

														// removed dec 11 2020 - include("functions/logs.php");
														log_add("Payment. Amount: ".number_format($can_pay,2)." / Driver Name: ".str_replace("'", "''", $fullname)." / Driver ID: ".$_SESSION['cashier_driver_id']);
									    			}


								    				
								    			}
								    		}



								    	}



								    	$_SESSION['success'] = "Payment successful!";
								    	unset($_SESSION['cashier_enter_amount']);





		//$fpdf->output();


		date_default_timezone_set('Asia/Manila');

		$pdfname = "receipt_pdf/".$_SESSION['cashier_driver_id']."_".Date("Y m d H i s").".pdf";


		MYSQL_INSERT("billing_receipt","d_id,receipt_name,receipt_date",$_SESSION['cashier_driver_id'].",'".$pdfname."','".Date("Y-m-d H:i:s")."'");




		






		$fpdf->output($pdfname,'F');

		$_SESSION['pdf_name'] = $pdfname;

		header("location:cashier.php");

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