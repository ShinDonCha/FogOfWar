<?php
	$u_id  = $_POST["Input_id"];
	$u_mas = $_POST["Input_myattset"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if( !$con )
		die("Could not Connect" . mysqli_connect_error() );

	$check = mysqli_query($con, "SELECT `User_ID`  FROM `pMaker_7Gi` WHERE `User_ID` = '".$u_id."'");
	$numrows = mysqli_num_rows($check);
	if($numrows == 0) 
		die("Not exist id");

	$Result = mysqli_query($con, "UPDATE `pMaker_7Gi` SET `MyAttSet` = '".$u_mas."' WHERE `User_ID` = '".$u_id."' ");

	if($Result)
		echo "OK_";
	else
		echo "Error";

	mysqli_close($con);	
?>