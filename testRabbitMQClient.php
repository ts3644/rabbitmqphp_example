#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function getData($username, $password){
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");


$request = array();
$request['type'] = "login";
$request['username'] = $username; #$_POST["$username"]; #$username; $_POST["username"];
$request['password'] = $password; #$_POST["$password"]#$password; $_POST["password"];
$request['message'] = "HI";
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

return $response;
}

