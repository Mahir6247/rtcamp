<?php
$servername="localhost";
$username="root";
$password="";
$database="krishnan";


$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("ok bye go away".mysqli_connect_error());

}
else{
    echo "sabas ok";
}

$sql="INSERT INTO `krish` ( `name`, `age`, `role`) VALUES ('arna', '20', 'manage')";
$result=mysqli_query($conn,$sql);

if($result){
    echo "successful table";
}
else{
    echo "not any result".mysqli_error($conn);
}



?>