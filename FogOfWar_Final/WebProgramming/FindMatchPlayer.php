<?php
	$u_id = $_POST["Input_id"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if(!$con)
		die( "Could not Connect" . mysqli_connect_error() ); 

	$check = mysqli_query($con, "SELECT User_ID FROM pMaker_7Gi WHERE User_ID = '".$u_id."'" );

	$numrows = mysqli_num_rows($check);
	if ( !$check || $numrows == 0)
 		die("ID does not exist. \n");

	$u_win = $numrows[0]["Win"];

	$JSONBUFF = array(); 

 	$sqlList = mysqli_query($con, 
			"
			(SELECT * FROM (SELECT `User_ID`, `NickName`, `Win`, `Lose`, `ProfileImgIdx`, `UserScore`, `MyDefSet`, `TowerLv`, rank() over(ORDER BY UserScore DESC) AS `Rank` FROM `pMaker_7Gi`) AS `Temp` WHERE User_ID != '".$u_id."' AND Win >= 7 LIMIT 10) 
			UNION 
			(SELECT * FROM (SELECT `User_ID`, `NickName`, `Win`, `Lose`, `ProfileImgIdx`, `UserScore`, `MyDefSet`, `TowerLv`, rank() over(ORDER BY UserScore DESC) AS `Rank` FROM `pMaker_7Gi`) AS `Temp` WHERE User_ID != '".$u_id."' AND Win < 7 LIMIT 10)
			");

	$rowsCount = mysqli_num_rows($sqlList);
	if (!$sqlList || $rowsCount == 0)
		die("List does not exist. \n");

	$RowDatas = array();
	$Return   = array();

	for($aa = 0; $aa < $rowsCount; $aa++)
	{
		$a_row = mysqli_fetch_array($sqlList);
		if($a_row != false)
		{	
			$RowDatas["User_ID"]   = $a_row["User_ID"];
			$RowDatas["NickName"] = $a_row["NickName"];
			$RowDatas["Win"] = $a_row["Win"];
			$RowDatas["Lose"] = $a_row["Lose"];
			$RowDatas["UserScore"]   = $a_row["UserScore"];
			$RowDatas["Rank"]   = $a_row["Rank"];
			$RowDatas["ProfileImgIdx"]   = $a_row["ProfileImgIdx"];
			$RowDatas["MyDefSet"]   = $a_row["MyDefSet"];
			$RowDatas["TowerLv"] = $a_row["TowerLv"];
			array_push($Return, $RowDatas); 
		}
	}

	$JSONBUFF['RkList'] = $Return;
	$output = json_encode($JSONBUFF, JSON_UNESCAPED_UNICODE); //한글 포함된 경우
	echo $output;
	echo "OK_";
?>