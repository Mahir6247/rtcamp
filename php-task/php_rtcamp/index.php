
<?php

$showError=false;

require __DIR__. '/test_function.php';
$value = isset($_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include __DIR__. '/_dbconnect.php';
    
    if (isset($_POST['email'])) {
        $email = Test_input($_POST['email']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $useremail = $email;
            
        }
    }

    $token=bin2hex(random_bytes(15));


    if (empty($_POST['email'])) {
        $showError='Please enter email';
    } else {
        $sqlexist="SELECT * FROM `user_info` WHERE `email`='$useremail'";
        $result2 = mysqli_query($conn, $sqlexist);
        $numRows=mysqli_num_rows($result2);
        if ($numRows>0) {
            $showError='User already exists!';
        } else {
            $zero=0;
                $stmt = $conn->prepare("INSERT INTO user_info (email,vstatus,code,Sstatus) VALUES (?, $zero, ?,$zero)");
                $stmt->bind_param('ss', $useremail,$token);
                $_SESSION['mail']=$useremail;
                $stmt->execute();

                if ($stmt) {                  
                    $to_email=$useremail;        
                    $subject = 'Account Verification!';
                    
                    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)) {
                    $protocol = 'https://';
                    }
                    else {
                    $protocol = 'http://';
                    }
                    if (isset($_SERVER['HTTP_HOST'])){
                        $server = $_SERVER['HTTP_HOST'];
                    }
                    $protocol .= $server;
                    $protocol .= '/aaaa/php-task/php_rtcamp/activate.php';
                        
                    $body="Hello dear \r\n";
                    $body .= "Click here to activate your account 
                    $protocol?token=$token";
                    $headers = 'From:krishnanvijay2233@gmail.com' . "\r\n";
                    $headers .= 'MIME-Version: 1.0 \r\n';
                    $headers .= 'Content-type:text/html;charset=UTF-8 ';
                    
                    if (mail($to_email, $subject, $body, $headers)) {
                      
                         header('location: thanks.php');
                        exit();                   
                    }
                    else{
                        echo "Sorry, Failed while sending mail!";
                    }
                }
           
        }
    }
}


?>
<html lang="en">
   <head>
      
      <title>User Registration with Email Verification in PHP</title>
       
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
   <div id="header">

<hr>
<div id="msg">
    <?php 
    if ($showError) {
        echo '<strong>Error! '.$showError.'</strong><br>';
    }
    ?>
</div>
<hr>
</div>
      <div class="container mt-5">
          <div class="card" style="background-color: #e6e6e6;">
            <div class="card-header text-center">
               Registration Form
            </div>
            <div class="card-body">
            <form action="index.php" method="POST">
         
         <div>
             <label for="email">Email</label><br>
             <input type="email" name="email" id="email" style="width: 25vw;"><br>
             <small>We'll never share your email.</small>
         </div><br>
      
         <input type="submit" name="submit" value="Submit">
     </form>
            </div>
          </div>
      </div>

   </body>
</html>


