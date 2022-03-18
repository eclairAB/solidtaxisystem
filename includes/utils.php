<?php



function DateNumToText($val)
{


	$vals = explode("-", $val);

	return NumToMonth($vals[1]) . " " . $vals[2] . ", " . $vals[0];


}

function BirthdayToAge($val)
{
	$vals = explode("-", $val);

	$y = Date('Y') - $vals[0];


	if(Date('m') < $vals[1])
	{
		$y -= 1;
	}
	else
	{
		if($vals[1]==Date('m'))
		{
			if(Date('d') < $vals[2])
			{
				$y-=1;
			}
		}


	}


	return $y;
}





function NumToMonth($val)
{


	switch ($val) {
		case 1:
			return "Jan";
			break;
		case 2:
			return "Feb";
			break;
		case 3:
			return "Mar";
			break;
		case 4:
			return "Apr";
			break;
		case 5:
			return "May";
			break;
		case 6:
			return "Jun";
			break;
		case 7:
			return "Jul";
			break;
		case 8:
			return "Aug";
			break;
		case 9:
			return "Sept";
			break;
		case 10:
			return "Oct";
			break;
		case 11:
			return "Nov";
			break;
		case 12:
			return "Dec";
			break;
		
		default:
			
			break;
	}

}


function DateNumToTextAndTime($val)
{
	$vals = explode(" ", $val);

	$date = DateNumToText($vals[0]);

	$time = Date("h:i a",strtotime($vals[1]));

	return $date . " " . $time;
}


?>