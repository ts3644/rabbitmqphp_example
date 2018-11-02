<?php

#require('/home/talha/IT490/rabbitmqphp_example/testRabbitMQClient.php');
//session_start();
//$sidvalue = session_id();
//echo "sess id: $sidvalue";


$username = $_POST['username'];
$password = $_POST['password'];
//$email = $_POST['email'];
$type = $_POST['type'];

include('/home/talha/git/rabbitmqphp_example/testRabbitMQClient.php');

function redirect($message, $url, $delay){
	echo($message);
	header("refresh:$delay; url=$url");
	exit();
}

if (!isset($_POST))
{
        $msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
        echo json_encode($msg);
        exit(0);
}
$request = createNewUser($username, $password,$type); #$_POST; 

//$_SESSION["username"] = $username
//$_SESSION["password"] = $password
//$_SESSION["type"] = $type


$response = "unsupported request type, politely FUCK OFF ";
switch ($request)
{
        case "1":
		$response = "Username Exists, Try Again";
		redirect("You will be redirected", "index.html", "5");

        break;
        case "0":
		$response = "You Have Been Registered";
		redirect("You Have Been Registered, You will be redirected", "index.html","3");
        break;
}
echo json_encode($response);
exit(0);
 
?>
