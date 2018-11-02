<?php

echo "whats good";


?>

<html>

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
                                //      arr.push(myObj.data[x].breedName)

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
                        txt += "<table> <tr> <th> Location Name </th> <th> Location Postal Code </th> <th> Phone Number </th> </tr>";
                        for(x in myObj.data){
                                //if(!arr.includes(myObj.data[x].breedName)){
                                //      arr.push(myObj.data[x].breedName)
                                        txt += "<tr> <td>" + myObj.data[x].locationName + "</td>" +"<td>" + myObj.data[x].locationPostalcode + "</td>" + "<td>" + myObj.data[x].locationPhone + "</td> </tr>";

                                //}
                        }
                        txt += "</table>"
                        document.getElementById("stats").innerHTML = txt;
                }
        }
        request.send("breed="+breed+"&distance="+distance+"&zipCode="+zipCode);

}
</script>
<input type = text id = "username">
</html>
