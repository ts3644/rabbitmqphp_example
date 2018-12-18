<?php
//$httpApiUrl = "https://api.rescuegroups.org/http/v2.json";
//function ListDeezNuts(){

$breed = "Dog";//$_POST['breed'];
$zipCode = "07013";//$_POST['zipCode'];
$distance = "15";//$_POST['distance'];

#echo $breed;
#echo $zipCode;
#echo $distance;

$data = array(
	"apikey" => "txjamlL8",
	"objectType" => "animals",
	"objectAction" => "publicSearch",
	"search" => array(
		//"calcFoundRows" => "Yes",
		"resultStart" => "0",
		"resultLimit" => "500",
		"resultSort" => "animalID",
		//		"resultSort" => "colorName",
		"resultOrder" => "asc",
/*		//"fields" => array("animalID","animalOrgID","animalName","animalSpecies","animalTumbnailUrl"),
		"filters" => array(
			array(
				"fieldName" => "colorSpecies",
				"operation" => "equals",
				"criteria" => "Dog",
			),
		),
		"filterProcessing"=> "1",
		"fields"=> array("colorID","colorName","colorSpecies","colorSpeciesID"),
	),
);*/
"filters" => array(
       	array(
	"fieldName" => "animalStatus",
	"operation" => "equal",
	"criteria" => "Available"
	),
	array(
		"fieldName" => "animalLocationDistance",
		"operation" => "radius",
		"criteria" => $distance,
	),
	array(
		"fieldName" => "animalLocation",
		"operation" => "equals",
		"criteria" => $zipCode,
	),
	array(
		"fieldName" => "animalSpecies",
		"operation" => "equal",
		"criteria" => $breed,
	),
),
	"fields" => array( "locationAddress", "locationCity","locationName","locationPhone", "locationPostalcode", "fosterEmail"),
),
);
	

$jsonData = json_encode($data);
$ch = curl_init('https://api.rescuegroups.org/http/v2.json');

curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
curl_setopt($ch, CURLOPT_URL, "https://api.rescuegroups.org/http/v2.json");

curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if(curl_errno($ch)) {
	$results = curl_error($ch);
}else{ 
	curl_close($ch);
	$results = $result;
}

//$stack = array();
//if($results["animalSpecies"] == "Dog"){
// array_push($stack, $results["animalSpecies"]);	
//}


echo json_encode($results);

/*$myObj =
    array(
	"name" => "John",
    "age" => 30,
    "cars" => array( 
        array("name"=>"Ford", "models"=> array("Fiesta", "Focus", "Mustang"),),
        array("name"=>"BMW", "models"=> array("320", "X3", "X5"),),
        array("name"=>"Fiat", "models"=> array("500", "Panda"),),
		array("name"=>"Ford", "models"=> array("Fusion"),),

    ),
);

echo json_encode($myObj);
 */

//print_r("THESE VALS  $json_encode($results)");
///$myObj = $json_encode($results);
//return $json_decode($results);
//echo $myObj.status;
//$resultsArray = json_decode($results);
//print_r($resultsArray);

$result = postToApi($data);
if (!$result){
	//echo "login issue wih the API.";
	exit;
}
print_r($result);
exit;

function postJson($url, $json){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		return array(
			"result" => "",
			"status" => "error",
			"error" => curl_error($ch)
		);
	}else{
		curl_close($ch);
	}
	return array(
		"status" => "ok",
		"error" => "",
		"result" => $result,
	);
}

function postToApi($data){
	$resultJson = postJson($GLOBALS["httpApiUrl"], $data);
	if ($resultJson["status"] == "ok"){
		$result = json_decode($resultJson["result"], true);
		$jsonError = getJsonError();
		if (!$jsonError && $resultJson["status"] == "ok") {
			return $result;
		}else{
			return array(
				"status" => "error",
				"text" => $result["error"] . $jsonError,
				"errors" => array()
			);
		}
	}else return false;
}

function getJsonError() {
	switch (json_last_error()){
	case JSON_ERROR_NONE:
		return false;
		break;
	case JSON_ERROR_DEPTH:
		return "Maximum stack depth exceeded";
		break;
	case JSON_ERROR_STATE_MISMATCH:
		return "Underflow or the modes mismatch";
		break;
	case JSON_ERROR_CTRL_CHAR:
		return "unexpected control character found";
		break;
	case JSON_ERROR_SYNTAX:
		return "Syntax error, malformed JSON";
		break;
	default:
		return "Unknown error";
		break;
	}
//}
}
?>
