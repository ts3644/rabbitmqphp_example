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
$request = createNewUser($username, $password, $type); #$_POST; 

$response = "unsupported request type, politely FUCK OFF ";
switch ($request)
{
        case "1":
                $response = "Na";
        break;
        case "0":
		$response = "Yea";
	/*	$logindb = mysqli_connect("192.168.1.45","admin","admin","login");
		while ($row = $response->fetch_assoc())
        {

		$s = "insert into users (username, password) values ('$username', '$password')";
		}*/


        break;
}
echo json_encode($response);
exit(0);

?>
