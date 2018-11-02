<?php
session_start();
//$httpApiUrl = "https://api.rescuegroups.org/http/v2.json";
//function ListDeezNuts(){

$breed = $_POST['breed'];
#echo "Hello";
#`echo $_POST['breed'];
#$breed = "Dog";
$data = array(
	"apikey" => "txjamlL8",
	"objectType" => "animalPatterns",
	"objectAction" => "publicSearch",
	"search" => array(
		//"calcFoundRows" => "Yes",
		"resultStart" => "0",
		"resultLimit" => "500",
		//"resultSort" => "breedName",
		"resultSort" => "patternName",
		"resultOrder" => "asc",
	//	"fields" => array("animalID","animalOrgID","animalName","animalSpecies","color"/*,"animalTumbnailUrl"*/),
		"filters" => array(
			array(
				"fieldName" => "patternSpecies",
				"operation" => "equals",
				"criteria" => $breed,
			),
			/*array(
				"fieldName" => "species",
				"operation" => "equal",
				"criteria" => "Dog"

			),*/
		),
		"filterProcessing"=> "1",
		"fields"=> array("patternID","patternName","patternSpecies","patternSpeciesID"),
		//"fields"=>array("breedID", "breedName", "breedSpecies", "breedSpeciesID"),
	),
);
/*"filters" => array(
       	array(
	"fieldName" => "animalStatus",
	"operation" => "equal",
	"criteria" => "Available"
	),
	array(
		"fieldName" => "animalGeneralSizePotential",
		"operation" => "equal",
		"criteria" => "Small",
	),
),
	"fields" => array("animalSpecies"),
),
);*/
	

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
