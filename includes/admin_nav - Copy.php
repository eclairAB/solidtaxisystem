<?php


function PRINT_NAV()
{
	echo "
		<div id='nav'>
			
			<button style='color:black!important' onclick='window.location.href=\"index.php\"'>Home</button>
			<button style='color:black!important' onclick='window.location.href=\"accounts.php\"'>Accounts</button>
			<button style='color:black!important' onclick='window.location.href=\"driverclassification.php\"'>Driver Classification</button>
			<button style='color:black!important' onclick='window.location.href=\"driver.php\"'>Driver</button>
			<button style='color:black!important' onclick='window.location.href=\"taxiclassification.php\"'>Taxi Classification</button>
			<button style='color:black!important' onclick='window.location.href=\"taxi.php\"'>Taxi</button>
			<button style='color:black!important' onclick='window.location.href=\"products.php\"'>Products</button>
			<button style='color:black!important' onclick='window.location.href=\"gasprice.php\"'>Gas Price</button>		
			<button style='color:black!important' onclick='window.location.href=\"maintenance.php\"'>Maintenance</button>

			<br>
			<button style='color:black!important' onclick='window.location.href=\"gas_inventory.php\"'>Gas Inventory</button>
			<button style='color:black!important' onclick='window.location.href=\"gasmonreport.php\"'>Gas Daily</button>
			<button style='color:black!important border-radius:30px!important' onclick='window.location.href=\"driver_stats.php\"'>Driver Weekly Statistics</button>
			<button style='color:blue!important' onclick='window.location.href=\"report.php\"'>Reports</button>
			<button style='color:black!important border-radius:30px!important' onclick='window.location.href=\"logs.php\"'>Logs</button>
				
		</div>
		<hr>

		<br>
		<br>
		<br>";
}


?>