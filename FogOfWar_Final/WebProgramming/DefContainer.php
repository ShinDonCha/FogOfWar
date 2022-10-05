<?php
	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if(!$con)
		die( "Could not Connect" . mysqli_connect_error() ); 
	//연결 실패했을 경우 이 스크립트를 닫아주겠다는 뜻

	$check = mysqli_query($con, "SELECT * FROM DefInfo_7Gi" );
	$numrows = mysqli_num_rows($check);
	if($numrows == 0)
	{  //mysqli_num_rows() 함수는 데이터베이스에서 쿼리를 보내서 나온 레코드의 개수를 알아낼 때 쓰임
	   //즉 0이라는 뜻은 해당 조건을 못 찾았다는 뜻

		die("DefInfo does not exist. \n");
	}

	echo "{";
	while($row = mysqli_fetch_assoc($check))
	{	
		$RowDatas = array();
		$RowDatas["TowerType"] = $row["TowerType"];
		$RowDatas["Level"] = $row["Level"];
		$RowDatas["Damage"] = $row["Damage"];
		$RowDatas["AttCycle"] = $row["AttCycle"];
		$RowDatas["MaxHP"] = $row["MaxHP"];
		$RowDatas["StoreGold"] = $row["StoreGold"];
		$RowDatas["DestroyGold"] = $row["DestroyGold"];
		$RowDatas["Cost"] = $row["Cost"];
		$output = json_encode($RowDatas, JSON_UNESCAPED_UNICODE); 
		//PHP 5.4 이상 JSON 형식 생성
		echo $output.",";	//클라이언트로 전달
	}
	echo "}";

	mysqli_close($con);
?>