<?php


function PRINT_NAV()
{
	echo "
		<div id='nav'>
			
			<button style='color:black!important;padding:20px' onclick='window.location.href=\"cashier_reset.php\"' class='btn-default'>Reset</button>
			
			<form class='daily-report-form' action='functions/dailyreport.php' method='post'>
				<button type='submit' name='submit' style='color:black!important;padding:20px' class='btn-default'>Cash Summary</button>
			</form>

			<button style='color:black!important;padding:20px' onclick='window.location.href=\"cashier_daily_report_custom.php\"' class='btn-default'>Custom Report</button>
			
		</div>
";
}


?>