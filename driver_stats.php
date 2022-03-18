<?php


		session_start();

		include("includes/isloggedin.php");

		if(ISLOGGEDIN()==true)
		{
			if(ISADMIN()==true || ISENCODER())
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

<title>Driver Statistics - Taxi System</title>
	
<?php include("includes/head.php"); PRINT_HEAD(); ?>

<link rel='stylesheet' href='css_/admin.css'>

<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: solid;
    border-width: 2px;

} 
</style>


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/searchBuilder.dataTables.min.css">

			<style>
				body{
					background-color: #bac6d1;
					overflow-x:hidden;
				}
			</style>




</head>


<body>
	


	
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

		?>
		


		

		<h2><center><b>Drivers Current Week Statistics</b></center></h2>
		<hr>

		<p id="date" align="center"><i>Note: From Sunday to Monday</i></p>


		<table class='table table-striped'>

			<thead style="background-color: #19194f; color: cyan;">
		      <tr>

		        <th>Last Name</th>
		        <th>First Name</th>
		        
		        
		        <th>Driver Classification</th>
		        <th>Week Ride</th>
		        <th>Status</th>
		        
		      </tr>
		    </thead>

		    <tbody>


		    	


		    	<?php 

		    	include("functions/db.php");
		    	include("includes/utils.php");


				// Singular and Plural

				function singleOrPlural($amount, $singular, $plural) {
  					return (abs($amount)>=2
    					? $amount.' '.$plural 
    					: $amount.' '.$singular
  					);
				}   			








		    	$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		    	if(isset($_GET['search']))
		    	{
		    		$search_this = str_replace("'", "''", $_GET['search']); 

		    		$row = MYSQL_SELECT("select * from driver where CONCAT(f_name,' ',m_name,' ',l_name) like '%".$_GET['search']."%'",$sess_name,9);
		    	}
		    	else
		    	{
		    		$row = MYSQL_SELECT("select * from driver",$sess_name,9);
		    	}


		    	

		    	for($x=0;$x<$row;$x++)
		    	{

					

		    		$sess_name2 = "data1_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');

		    		MYSQL_SELECT("select dc_text from driver_class where dc_id=".$_SESSION[$sess_name.'_'.$x.'_9'],$sess_name2,0);

		    		


		    		


		    		$sess_name3 = "data3_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') . $x;

		    		MYSQL_SELECT("select out_time from in_out where d_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " order by io_id desc limit 1",$sess_name3,0);


		    		// Start Experiment
								
					$week_ride = 0;	

					/*$query119 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " and in_time between date_sub(now(),INTERVAL 1 WEEK) and now() and in_out.t_id=taxi.t_id order by in_out.io_id desc";*/

					$query119 = "select taxi.body_no,taxi.plate_no,in_out.in_time,in_out.out_time  from taxi,in_out where in_out.d_id=".$_SESSION[$sess_name.'_'.$x.'_0'] . " and YEARWEEK(in_time)=YEARWEEK(NOW()) and in_out.t_id=taxi.t_id order by in_out.io_id desc";

			
					$row911 = MYSQL_SELECT($query119,$sess_name3,3);

					$week_ride = $row911;

					// End Experiment

					if($week_ride > 0) {


					echo "<tr>";

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


									$sess_name333 = "data333_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s') .$x;
									$row3 = 0;
									$row3 = MYSQL_SELECT("select out_time from in_out where d_id=".$_SESSION[$sess_name.'_'.$x.'_0'],$sess_name333,0);

									if($row3 != 0)
									{
										$ok2 = false;
									}

									
								}

		    		
		    		
		    		echo "
		    		<td>".$_SESSION[$sess_name.'_'.$x.'_3']."</td>

		    		<td>".$_SESSION[$sess_name.'_'.$x.'_1']."</td>
		    		

		    		
		    		
		    		<td>".$_SESSION[$sess_name2.'_0_0']."</td>";


					

		    		echo "
		    		<td>".singleOrPlural($week_ride,"day","days")."</td>
		    		";



		    		if($ok2==true)
		    		{
		    			echo "<td style='color:green'>Available</td>";
		    		}
		    		else
		    		{
		    			echo "<td style='color:red'>Not Available</td>";
		    		}

		    		echo "
		    		
					</tr>";

				}
					
		    	}

		    	?>

		    	
		    </tbody>

		</table>

		<hr>



		
	</div>
	<br>
	<br>


    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="js/dataTables.searchBuilder.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({




            	"searching": false,
            	"order": [[0, "asc"]],
            	"paging": false,
           	

            });

        });

    </script>
	

</body>

</html>