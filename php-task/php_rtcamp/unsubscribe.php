
<?php
include __DIR__. '/_dbconnect.php';
if (isset($_GET['key'])) {
  
           $codeval = $_GET['key'];
          $code = filter_var($codeval, FILTER_SANITIZE_STRING);
          $sql_update = "UPDATE `user_info` SET  `Sstatus` = 0 
          WHERE `user_info`.`code` = '$code'";
          $result_update = mysqli_query($conn, $sql_update);
          header('location: afterUnsub.php');  
  exit();
}

if (isset($_GET['token'])) {
          
  $codeval = $_GET['token'];
 $code = filter_var($codeval, FILTER_SANITIZE_STRING);
 $sql_update = "UPDATE `user_info` SET  `Sstatus` = 0 
 WHERE `user_info`.`email` = '$code'";
 $result_update = mysqli_query($conn, $sql_update);
 header('location: afterUnsub.php'); 
  exit();
}

             
?>
