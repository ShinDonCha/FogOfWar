<?php
	$u_id = $_POST["Input_user"];
	$u_pw = $_POST["Input_pass"];
	$nick = $_POST["Input_nick"];

	$con = mysqli_connect("localhost", "pmaker", "unity11!", "pmaker");

	if(!$con)
		die("Could not Connect".mysqli_connect_error());

	$check = mysqli_query($con,"SELECT * FROM pMaker_7Gi WHERE User_ID = '". $u_id ."'");
	$numrows = mysqli_num_rows($check);
	if($numrows != 0)
	{
		die("ID exists. \n");
	}

    $check = mysqli_query($con,"SELECT * FROM pMaker_7Gi WHERE NickName = '". $nick ."'");
	$numrows = mysqli_num_rows($check);
	if($numrows != 0)
	{
		die("Nickname exists. \n");
	}

	$hash_pw = password_hash($u_pw, PASSWORD_BCRYPT);

    $Result = mysqli_query($con,
    "INSERT INTO pMaker_7Gi (User_ID, PW_HASH, NickName) 
    VALUES ( '".$u_id."', '".$hash_pw."', '".$nick."' );" );
    
    if($Result)
        echo "Create Success.\n";
    else
        echo "Create Error. \n";

	mysqli_close($con);
?>