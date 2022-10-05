<?php
	$u_id  = $_POST["Input_user"];
	$u_pw =	$_POST["Input_pass"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if(!$con)
		die( "Could not Connect" . mysqli_connect_error() ); 
	//연결 실패했을 경우 이 스크립트를 닫아주겠다는 뜻

	$check = mysqli_query($con, "SELECT * FROM pMaker_7Gi WHERE User_ID = '".$u_id."'" );
	$numrows = mysqli_num_rows($check);
	if($numrows == 0)
	{  //mysqli_num_rows() 함수는 데이터베이스에서 쿼리를 보내서 나온 레코드의 개수를 알아낼 때 쓰임
	   //즉 0이라는 뜻은 해당 조건을 못 찾았다는 뜻

		die("ID does not exist. \n");
	}

	$row = mysqli_fetch_assoc($check); //user_id 이름에 해당하는 행의 내용을 가져온다.
	if($row)
	{	
		$hash_pw = $row["PW_HASH"];
		if($match = password_verify($u_pw,$hash_pw))
		{
			// echo $row["Input_user"];
			// JSON 생성을 코드
			$RowDatas = array();
			$RowDatas["NickName"] = $row["NickName"];
			$RowDatas["Win"] = $row["Win"];
			$RowDatas["Lose"] = $row["Lose"];
			$RowDatas["UserGold"] = $row["UserGold"];
			$RowDatas["TowerLv"] = $row["TowerLv"];
			$RowDatas["TankLv"] = $row["TankLv"];
			$RowDatas["SkillLv"] = $row["SkillLv"];
			$RowDatas["UserScore"] = $row["UserScore"];
			$RowDatas["MyAttSet"] = $row["MyAttSet"];
			$RowDatas["MyDefSet"]   = $row["MyDefSet"];
			$RowDatas["ProfileImgIdx"] = $row["ProfileImgIdx"];
			$output = json_encode($RowDatas, JSON_UNESCAPED_UNICODE); 
			//PHP 5.4 이상 JSON 형식 생성

			echo $output;	//클라이언트로 전달
			echo "\n";
			echo "Login Success.";
		}
		else
		{
			die("Pass does not Match. \n");
		}
	}

	mysqli_close($con);
?>