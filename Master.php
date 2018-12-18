#!/usr/bin/php

<?php
//chnage to my directory
require_once('/home/talha/git/rabbitmqphp_example/path.inc');
require_once('/home/talha/git/rabbitmqphp_example/get_host_info.inc');
require_once('/home/talha/git/rabbitmqphp_example/rabbitMQLib.inc');


//$client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");

switch ($argv[1]){
        case "send":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                //first path where tar needs to be placed
                //second path what you want to tar(change to your directory)
                //second shell - sending to kevin copy of tar
                //first path should match second path in first shell
                //thrird shell - sending it to vms
                //paths should be same pointing to where you tared your file
                shell_exec("tar -czf /home/talha/send/$argv[2].tar.gz -C /home/talha/git/ .");
                shell_exec("scp /home/talha/send/$argv[2].tar.gz waduhek2@192.168.1.10:/home/waduhek2/readytogo");
                //shell_exec("scp /home/talha/send/$argv[2].tar.gz $argv[3]@$argv[4]:$argv[5]");
                $request = array();
                $request['type'] = "send";
                $request['name'] = $argv[2];
                $request['host'] = $argv[3];
                $request['ip'] = $argv[4];
                $request['path'] = $argv[5];
                $response = $client->send_request($request);
                //echo $msg  . PHP_EOL;
                echo $response . PHP_EOL;
                exit();


        case "rollback":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                $request = array();
                $request['type'] = "rollback";
                $request['name'] = $argv[2];
                $request['host'] = $argv[3];
                $request['ip'] = $argv[4];
                $response = $client->send_request($request);
                echo $response . PHP_EOL;
                exit();
        case "status":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                $request = array();
                $request['type'] = "status";
                $request['name'] = $argv[2];
                $request['status'] = $argv[3];
                $response = $client->send_request($request);
                echo $response . PHP_EOL;
                exit();
        case "versionchecker":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                $request = array();
                $request['type'] = "versionchecker";
                $request['name'] = $argv[2];
                $response = $client->send_request($request);
                echo $response . PHP_EOL;
                exit();
                //taring two things, first rabbit, second html
                //first scp to comp second to varhtml
       
case "FEsend":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                shell_exec("tar -czf /home/talha/FEsend/$argv[2].tar.gz -C /var/www/ .");
                shell_exec("scp /home/talha/FEsend/$argv[2].tar.gz waduhek2@192.168.1.10:/home/waduhek2/readytogo");
                $request = array();
                $request['type'] = "FEsend";
                $request['name'] = $argv[2];
                //$request['version'] = $argv[3];
                $request['host'] = $argv[3];
                $request['ip'] = $argv[4];
                $request['path'] = $argv[5];
                $response = $client->send_request($request);
                //echo $msg  . PHP_EOL;
                echo $response . PHP_EOL;
                exit();
        case "FErollback":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
		$request = array();
		$request['type'] = "FErollback";
		$request['name'] = $argv[2];
		$request['host'] = $argv[3];
		$request['ip'] = $argv[4];
                $response = $client->send_request($request);
                echo $response . PHP_EOL;
                exit();
        case "FEstatus":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                $request = array();
                $request['type'] = "FEstatus";
                $request['name'] = $argv[2];
                $request['status'] = $argv[3];
                $response = $client->send_request($request);
                echo $response . PHP_EOL;
                exit();
        case "FEversionchecker":
                $client = new rabbitMQClient("testRabbitMQ.ini","DeploymentHost");
                $request = array();
                $request['type'] = "FEversionchecker";
                $request['name'] = $argv[2];
                $response = $client->send_request($request);
                echo $response . PHP_EOL;
                exit();

}
?>
