<?php
	$u_id  = $_POST["Input_id"];
	$u_win = $_POST["Input_win"];
	$u_lose = $_POST["Input_lose"];
	$u_score = $_POST["Input_score"];
	$u_gold = $_POST["Input_gold"];

	$e_id = $_POST["Enemy_id"];
	$e_win = $_POST["Enemy_win"];
	$e_lose = $_POST["Enemy_lose"];
	$e_score = $_POST["Enemy_score"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if( !$con )
		die("Could not Connect" . mysqli_connect_error() );

	$check = mysqli_query($con, "SELECT `User_ID` FROM `pMaker_7Gi` WHERE `User_ID` = '".$u_id."'");
	$numrows = mysqli_num_rows($check);
	if($numrows == 0) 
		die("Not exist id");

	$Result = mysqli_query($con, "UPDATE `pMaker_7Gi` SET `Win` = `Win`+'".$u_win."', `Lose` = `Lose`+'".$u_lose."', `UserScore` = `UserScore`+'".$u_score."', `UserGold` = `UserGold`+'".$u_gold."' WHERE `User_ID` = '".$u_id."' ");

	if(!$Result)
		die("Error");

	$check = mysqli_query($con, "SELECT `User_ID`  FROM `pMaker_7Gi` WHERE `User_ID` = '".$e_id."'");
	$numrows = mysqli_num_rows($check);
	if($numrows == 0) 
		die("Not exist id");
	
	$Result = mysqli_query($con, "UPDATE `pMaker_7Gi` SET `Win` = `Win`+'".$e_win."', `Lose` = `Lose`+'".$e_lose."', `UserScore` = `UserScore`+'".$e_score."' WHERE `User_ID` = '".$e_id."' ");
	if(!$Result)
		die("Error");
	
	$check = mysqli_query($con, "SELECT `UserScore` FROM `pMaker_7Gi` WHERE `User_ID` = '".$u_id."'");
	$row = mysqli_fetch_assoc($check);
	if($row)
	{
		$score = $row["UserScore"];
		echo "OK_".$score;
	}
	else
		echo "Error";

	mysqli_close($con);	
?>