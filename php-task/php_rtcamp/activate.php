<?php

require __DIR__. '/_dbconnect.php';
if (isset($_GET['token'])) {
    $token_val = $_GET['token'];
    $token = filter_var($token_val, FILTER_SANITIZE_STRING);
    
     $checkstatus="SELECT *from `user_info` WHERE  `user_info`.`code` = '$token' AND `vstatus`=1 AND `Sstatus`=1";
     $checkresult= mysqli_query($conn, $checkstatus);
     $numRows=mysqli_num_rows($checkresult);
        if ($numRows>0) {
            echo 'you already verify your account with us.... !';
           ?>
                 <a href='index.php'>Go Back To Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href='subscribe.php?key=<?php echo $token; ?>'>Subscribe</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <a href='unsubscribe.php?key=<?php echo $token; ?>'>Unsubscribe</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             <?php
        } 
        else
        {
        $sql_update = "UPDATE `user_info` SET `vstatus` = 1 , `Sstatus` = 1 
        WHERE `user_info`.`code` = '$token'";
        $result_update = mysqli_query($conn, $sql_update);
        header('location: thanks.php');                   
        exit();
      }

}

?>