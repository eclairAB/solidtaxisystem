<?php


function ISLOGGEDIN()
{
			if(isset($_SESSION['login_details_0_0']))
			{
				if($_SESSION['login_details_0_0'] != 0)
				{
					return true;
				}
				else
				{
					return false;
				}

			}
			else
			{
				return false;
			}
}




function ISADMIN()
{
			if($_SESSION['login_details_0_6']==1)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISCASHIER()
{
			if($_SESSION['login_details_0_6']==2)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISGASBOY()
{
			if($_SESSION['login_details_0_6']==3)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISGUARD()
{
			if($_SESSION['login_details_0_6']==4)
			{
				return true;
			}
			else
			{
				return false;
			}
}

function ISDISPATCHER()
{
			if($_SESSION['login_details_0_6']==5)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISMAINTENANCE()
{
			if($_SESSION['login_details_0_6']==6)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISBROADCASTER()
{
			if($_SESSION['login_details_0_6']==7)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISREPORTS()
{
			if($_SESSION['login_details_0_6']==8)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISENCODER()
{
			if($_SESSION['login_details_0_6']==14)
			{
				return true;
			}
			else
			{
				return false;
			}
}


function ISREMIT()
{
			if($_SESSION['login_details_0_6']==12)
			{
				return true;
			}
			else
			{
				return false;
			}
}

function ISGASMONITORING()
{
			if($_SESSION['login_details_0_6']==16)
			{
				return true;
			}
			else
			{
				return false;
			}
}

?>