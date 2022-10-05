<?php
	$u_id  = $_POST["Input_id"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if(!$con)
		die( "Could not Connect" . mysqli_connect_error() ); 

	$check = mysqli_query($con, "SELECT * FROM (SELECT `User_ID`, rank() over(ORDER BY UserScore DESC) AS `Rank` FROM `pMaker_7Gi`) AS `Temp` WHERE `User_ID` = '".$u_id."'" );
	$numrows = mysqli_num_rows($check);
	if($numrows == 0)
		die("Does not exist. \n");

	$row = mysqli_fetch_assoc($check);
	if($row)
	{
		$output = $row["Rank"];
		echo "OK_";
		echo $output;
	}

	mysqli_close($con);
?>