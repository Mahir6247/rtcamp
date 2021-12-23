<?php
ob_start();
session_start();
$conn=new mysqli('localhost','root','','krishnan');
if(mysqli_connect_error())
{
    die ('connection not found'.mysqli_connect_error());

}
// else{
//     echo "sabas ok";
// }
error_reporting(0);



// $ServerName="localhost";
// $Username="root";
// $Password="";
// $DatabaseName="krishnan";


// $conn=mysqli_connect($ServerName,$Username,$Password,$DatabaseName);

// if(!$conn){
//     die("ok bye go away".mysqli_connect_error());

// }

 
?>
