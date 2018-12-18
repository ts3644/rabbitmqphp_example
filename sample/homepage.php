<?php 
session_start();
echo "Welcome to animal rescue information " . $_SESSION["user_id"];
if(isset($_SESSION["user_id"])){
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
<body>
<style>
#d{background-color: white;border: 5px solid black;}
#div1{background-color: white;border: 5px solid black;}
#div2{background-color: white;border: 5px solid black;}
#div3{background-color: white;border: 5px solid black;}
#status1{margin-top: 10px;}
body{
	background-color: teal;
}


</style>
</body>
<style>
table, tr, th, td{
border: 1px solid black;
}
</style> 

<script>
function showHint(){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("GET","api.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
			var arr = [];
			obj = obj.substring(1,obj.length-1);
			myObj = JSON.parse(obj);
			for(x in myObj.data){
				if(!arr.includes(myObj.data[x].animalSpecies)){
					arr.push(myObj.data[x].animalSpecies)
					txt += myObj.data[x].animalSpecies + "<br>";
			
				}
			}
			document.getElementById("demo").innerHTML = txt;
		}		
	}
	request.send();
}

function getInfo(breed){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("POST","animalDetails.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
			var arr = [];
			obj = obj.substring(1,obj.length-1);
			myObj = JSON.parse(obj);

			txt += "<table> <tr> <th> General Age </th> <th> Animal Color </th> <th> Primary Breed </th> <th> Animal Location </th> <br>";
			for(x in myObj.data){
				//if(!arr.includes(myObj.data[x].breedName)){
				//	arr.push(myObj.data[x].breedName)
					txt += "<tr> <td>" + myObj.data[x].animalGeneralAge + "</td>" +"<td>" + myObj.data[x].animalColor + "</td>" + "<td>" + myObj.data[x].animalPrimaryBreed + "</td>"+ "<td>" + myObj.data[x].animalLocation + "</td> </tr>";
			
				//}
			}
			txt += "</table>"
			document.getElementById("stats").innerHTML = txt;
		}		
	}
	request.send("breed="+breed);
}


function getLocation(breed, distance, zipCode){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("POST","location.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
			var arr = [];
			obj = obj.substring(1,obj.length-1);
			myObj = JSON.parse(obj);

			txt += "<table> <tr> <th> Location Name </th> <th> Location Postal Code </th> <th> Phone Number </th> <th> Email Address</th></tr>";
			for(x in myObj.data){
				//if(!arr.includes(myObj.data[x].breedName)){
				//	arr.push(myObj.data[x].breedName)
				if(myObj.data[x].locationName != "" && myObj.data[x].locationPhone != "" && myObj.data[x].locationPostalCode != "" && myObj.data[x].fosterEmail != ""){
				txt += "<tr> <td>" + myObj.data[x].locationName + "</td>" +"<td>" + myObj.data[x].locationPostalcode + "</td>" + "<td>" + myObj.data[x].locationPhone + "</td>" + "<td>" + myObj.data[x].fosterEmail + "</td> </tr>";
				}
				//}
			}
			txt += "</table>"
			document.getElementById("statss").innerHTML = txt;
		}		
	}
	request.send("breed="+breed+"&distance="+distance+"&zipCode="+zipCode);
}



/*function getColor(breed){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("POST","animalColors.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
*/

function getBreed(breed){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("POST","animalStats.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
			var arr = [];
			obj = obj.substring(1,obj.length-1);
			myObj = JSON.parse(obj);
			for(x in myObj.data){
				if(!arr.includes(myObj.data[x].breedName)){
					arr.push(myObj.data[x].breedName)
					txt += myObj.data[x].breedName + "<br>";
			
				}
			}
			document.getElementById("stats").innerHTML = txt;
		}		
	}
	request.send("breed="+breed);
}


function getColor(breed){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("POST","animalColors.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
			var arr = [];
			obj = obj.substring(1,obj.length-1);
			myObj = JSON.parse(obj);
			for(x in myObj.data){
				if(!arr.includes(myObj.data[x].colorName)){
					arr.push(myObj.data[x].colorName)
					txt += myObj.data[x].colorName + "<br>";
			
				}
			}
			document.getElementById("stats").innerHTML = txt;
		}		
	}
	request.send("breed="+breed);
}


function getPattern(breed){
	
	var request = new XMLHttpRequest();
	var txt = "";
	var arr = [];
	request.open("POST","animalPattern.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
			console.log(this.responseText.replace(/\\/g,""));
			var obj = this.responseText.replace(/\\/g,"");
			var arr = [];
			obj = obj.substring(1,obj.length-1);
			myObj = JSON.parse(obj);
			for(x in myObj.data){
				if(!arr.includes(myObj.data[x].patternName)){
					arr.push(myObj.data[x].patternName)
					txt += myObj.data[x].patternName + "<br>";
			
				}
			}
			if(txt.length <1){
      			document.getElementById("stats").innerHTML = "No Patterns Available";
      			}
      			else{
			document.getElementById("stats").innerHTML = txt;
			}	
      		}		
	}
	request.send("breed="+breed);
}

function show() {
    var a = document.getElementById("loc");
    var b = document.getElementById("locz");
    var x = document.getElementById("loczz");
    var c = document.getElementById("status");
    var d = document.getElementById("status1");
    var e = document.getElementById("status2");
    var f = document.getElementById("status3");
	
	
    if (a.style.display === "none") {
        a.style.display = "block";
	b.style.display = "block";
	x.style.display = "block";
        c.style.display = "none";
	d.style.display = "none";
        e.style.display = "none";
	f.style.display = "none";
    } else {
        //x.style.display = "none";
	//y.style.display = "block";

        a.style.display = "none";
	b.style.display = "none";
	x.style.display = "none";
        c.style.display = "block";
	d.style.display = "block";
        e.style.display = "block";
	f.style.display = "block";
    }
}
</script>

</body>
<div id="d">
<h1><center> Animal Adoption HomePage</center> </h1>
<p> <a href = "logout.php" >Logout</a> </p>
</div>
<body>
	<center>
	<div id="div1">
	<p>Click below to see what type of animals are available!</p>
	<!--	<p id="demo"></p>-->
	<button onclick="showHint()">Click Me</button>
	<p id="demo"></p>
	<p></p>
	</div>
	<div id="div2">
	<p>Enter the name of an animal from above to see detailed information</p>

<!--	<button onClick="show()">Switch Search Types</button> -->
	<!--<input id="breed" type = text name = "api" >-->
	<br><center>

	<input type= text name="breed" id="breed" placeholder="Enter breed">
	<br></center>
<!--	<input id="loc" type=text name="location", id="location", placeholder="Enter location">
	<input id="locz" type=text name="zipCode", id="zipCode", placeholder="Enter Zip Code"> -->

<!--	<button onClick="show()">Switch Search Types</button> -->
	
<!--	<button id="loczz" onclick="getLocation(document.getElementById('breed').value, document.getElementById('loc').value, document.getElementById('locz').value)">Location Info</button> --> 
	<button id="status" onclick="getBreed(document.getElementById('breed').value)">Breed Info</button>
	<button id="status1" onclick="getColor(document.getElementById('breed').value)">Animal Colors</button>
	<button id="status2" onclick="getPattern(document.getElementById('breed').value)">Animal Patterns</button>
	<button id="status3" onclick="getInfo(document.getElementById('breed').value)">Animal Info</button>
	
	<p id="stats">
	</div>
	<div id="div3">
		<p> Enter the Radius and Zipcode to Find Animal Locations </p><br>
	<input id="loc" type=text name="location", id="location", placeholder="Enter Radius">
        <input id="locz" type=text name="zipCode", id="zipCode", placeholder="Enter Zip Code">
<button id="loczz" onclick="getLocation(document.getElementById('breed').value, document.getElementById('loc').value, document.getElementById('locz').value)">Location Info</button> 
	<p id = statss>
	</div>
	
	<!--<script>
	getBreed(document.getElementById("breed").value);
	</script>-->

</body>
<?php 
}
if(!isset($_SESSION["user_id"])){
?>
	<p> You need to login to use this page </p>
	<?php header("Refresh:3; url=index.html");
}
?>
</html>
