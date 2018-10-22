<?php

function checkUser($username, $password){
	$db = mysqli_connect ($hostname, $username, $password, $project);
	if(mysqli_connect_error()){
		echo "Falied to Connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	$s = "select * from users where username = '$username'" ;
	$t = mysqli_query($db, $s);
	$num = mysqli_num_rows($t);
	If ($num > 0){
		echo "Username exists" ;
		exit()
	;}
	else {
		$s = "update users set username = '$username' and password = '$password'";
	}
}
