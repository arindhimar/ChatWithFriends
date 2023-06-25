<?php

$con=new mysqli("localhost","root","","chatwithfriends");

if(!$con){
    echo "Connection Failed";
    exit(-1);
}

?>