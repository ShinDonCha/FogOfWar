<?php
	$u_id  = $_POST["Input_user"];
	$gold = $_POST["myGold"];
	$skillLV = $_POST["SkillLv"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if(!$con)
		die( "Could not Connect" . mysqli_connect_error() ); 

	$check = mysqli_query($con,"SELECT * FROM pMaker_7Gi WHERE User_ID = '". $u_id ."'");

	$numrows = mysqli_num_rows($check);
	if($numrows == 0)
	{ 
		die("ID does not exist. \n");
	}
	$row = mysqli_fetch_assoc($check);
	if($row)
	{
		mysqli_query($con,
			"UPDATE pMaker_7Gi SET `UserGold` = '".$gold."', `SkillLv`= '".$skillLV."'
			WHERE `User_ID` = '".$u_id."' ");

		echo ("skillBuy Success");
	}

	mysqli_close($con);
?>