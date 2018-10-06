<?php
#require('/home/talha/IT490/rabbitmqphp_example/testRabbitMQClient.php');

$username = $_POST['username'];
$password = $_POST['password'];
$type = $_POST['type'];

include('/home/talha/git/rabbitmqphp_example/testRabbitMQClient.php');

if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
	echo json_encode($msg);
	exit(0);
}
$request = getData($username, $password); #$_POST; 
	
$response = "unsupported request type, politely FUCK OFF ";
switch ($request)
{
	case "1":
		$response = "login, yeah we can do that";
	break;
	case "0":	
		$response = "wrong";
	break;
}
echo json_encode($response);
exit(0);

?>
