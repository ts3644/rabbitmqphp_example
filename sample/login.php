<?php

//session_start();
//$sidvalue = session_id();
//echo "sess id: $sidvalue";

#require('/home/talha/IT490/rabbitmqphp_example/testRabbitMQClient.php');
require('/home/talha/git/rabbitmqphp_example/testRabbitMQClient.php');

$username = $_POST['username'];
$password = $_POST['password'];
#$type = $_POST['type'];
//$_Session["username"]=$username;
//echo $_Session["username"]

#include('/home/talha/git/rabbitmqphp_example/testRabbitMQClient.php');

/*function redirect($message, $url, $delay){
        echo($message);
        header("refresh:$delay; url=$url");
        exit();
}*/

if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
	echo json_encode($msg);
	exit(0);
}
$request = getData($username, $password); #$_POST; 

//$_SESSION["username"]=$username;
//$_SESSION["password"]=$password;


$response = "unsupported request type, politely FUCK OFF ";
switch ($request)
{
	case "1":
		$response = "login, yeah we can do that";
		//redirect("You will be redirected", "homepage.html", "3");
	break;
	case "0":	
		$response = "Wrong Username or Password, Try Again";
		//redirect("You will be redirected", "index.html", "3");

	break;
}
echo json_encode($response);
exit(0);

?>
