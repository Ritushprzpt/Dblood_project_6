<?php
    $conn = mysqli_connect('localhost','root','root','dblood');
    if($conn->connect_error){
        die("cant connect to database". $conn->connect_error);
    }
    else{
        // echo "success";
    }
?>