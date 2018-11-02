<?php
session_start();
echo "Goodbye: ". $_SESSION["user_id"];
session_unset();
session_destroy();

function redirect($message, $url, $delay){
        echo($message);
        header("refresh:$delay; url=$url");
        exit();
}

//redirect("You have been Logged Out", "index.html", "3");
//session_destroy();
header("Refresh:3; url=index.html");


?>
