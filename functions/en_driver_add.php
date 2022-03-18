
<?php

session_start();
include("db.php");

if($_POST)
{


	if(isset($_POST['address_tb']) && isset($_POST['contact_no_tb']) && isset($_POST['first_name_tb'])&& isset($_POST['middle_name_tb'])&& isset($_POST['last_name_tb']) && isset($_POST['gender_cb']) && isset($_POST['birthdate_tb']))
	{

			if(empty($_POST['address_tb']) ||
			empty($_POST['contact_no_tb']) ||
			empty($_POST['first_name_tb']) ||
			//empty($_POST['middle_name_tb']) ||
			empty($_POST['last_name_tb']) ||
			empty($_POST['gender_cb']) ||
			empty($_POST['birthdate_tb']))
					{
						$_SESSION['error'] = "Please fill up all fields.";
						header("location:../en-driver_add.php");
						exit();
					}



		$ok = true;





		$_POST['first_name_tb'] = str_replace("'", "''", $_POST['first_name_tb']);
		$_POST['middle_name_tb'] = str_replace("'", "''", $_POST['middle_name_tb']);
		$_POST['last_name_tb'] = str_replace("'", "''", $_POST['last_name_tb']);

		$_POST['address_tb'] = str_replace("'", "''", $_POST['address_tb']);
		$_POST['contact_no_tb'] = str_replace("'", "''", $_POST['contact_no_tb']);

		$_POST['driver_classification_cb'] = str_replace("'", "''", $_POST['driver_classification_cb']);

		$_POST['gender_cb'] = str_replace("'", "''", $_POST['gender_cb']);
		$_POST['birthdate_tb'] = str_replace("'", "''", $_POST['birthdate_tb']);


		$sess_name = "data_" . Date('Y') . Date('m') . Date('d') . Date('H') . Date('i') . Date('s');


		MYSQL_SELECT("select dc_id from driver_class where dc_text = '".$_POST['driver_classification_cb']."'",$sess_name,0);


		$ok_photo = false;
		$new_file_name = "";

		$photo_name = "";

		
		//photo


			$target_dir = "../img/profile_pic/";

			$target_file = $target_dir . basename($_FILES["profilepic"]["name"]);

			

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


			$check = getimagesize($_FILES["profilepic"]["tmp_name"]);
			    

			if($check !== false) {
			        $ok_photo = true;
			} else {
			     echo "1";
				$ok_photo=false;
			        
			}



			if($ok_photo==true)
			{
			     if ($_FILES["profilepic"]["size"] > 5000000) {
				    
				    echo "2";
				    $ok_photo = false;
				}
				else
				{

					$ok_photo = true;
				}
			}
				

			if($ok_photo==true)
			{
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				    
				    echo "3";
				    $ok_photo = false;
				}
				else
				{
					$ok_photo = true;
				}
			}


			
			


			if($ok_photo==true)
			{

		        $new_file_name=$target_dir.$_POST['last_name_tb'].Date("Y m d H i s").".".$imageFileType;
		        $photo_name = $_POST['last_name_tb'].Date("Y m d H i s").".".$imageFileType;

				 if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $new_file_name)) 
				 {

				 	$ok_photo = true;

				 }
				 else
				 {
				 	echo "4";
				 	$ok_photo = false;
				 }

			}






		if($ok == true)
		{



			if($ok_photo==true)
			{
				MYSQL_INSERT("driver","f_name,m_name,l_name,gender,birthdate,address,contact_no,profile_pic,dc_id","'".$_POST['first_name_tb']."','".$_POST['middle_name_tb']."','".$_POST['last_name_tb']."','".$_POST['gender_cb']."','".$_POST['birthdate_tb']."','".$_POST['address_tb']."','".$_POST['contact_no_tb']."','".$photo_name."',".$_SESSION[$sess_name.'_0_0']);
			}
			else
			{
				MYSQL_INSERT("driver","f_name,m_name,l_name,gender,birthdate,address,contact_no,profile_pic,dc_id","'".$_POST['first_name_tb']."','".$_POST['middle_name_tb']."','".$_POST['last_name_tb']."','".$_POST['gender_cb']."','".$_POST['birthdate_tb']."','".$_POST['address_tb']."','".$_POST['contact_no_tb']."','',".$_SESSION[$sess_name.'_0_0']);
			}
			

			include("logs.php");
			log_add("Added a new driver. Driver Name: ".$_POST['first_name_tb']." ".$_POST['middle_name_tb']." ".$_POST['last_name_tb']);
			

			$_SESSION['success'] = "Driver added.";
			header("location:../en-driver.php");

		}

	}
	else
	{
		$_SESSION['error'] = "Please fill up all fields.";
		header("location:../en-driver_add.php");
	}
}
else
{
	header("location:../index.php");
}



?>