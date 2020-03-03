<?php

//connect to database
$conn= mysqli_connect('localhost','tutorial', '1234', 'sihina');

//check the connetion
if(!$conn){
    echo ('Connection Error ').mysqli_connect_error();
}
?>