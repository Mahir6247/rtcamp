<?php
include __DIR__. '/_dbconnect.php';

  
  $sqlexist="SELECT *from `user_info` WHERE  `email`='$_SESSION[mail]' AND `vstatus`=1 AND `Sstatus`=1";
  $result2 = mysqli_query($conn, $sqlexist);
  $numRows=mysqli_num_rows($result2);
  if ($numRows>0) {
      
    echo '<script>alert ("you are varify you account successfully");</script>';
    ?>
    <div>
    
  </div>
  <i><br><center><big><b>Laughter is the best medicine. </b></big></center></i>
  <br>

        <b><br>sooooo... we will send you some comics to make you laugh and stay
            healthy.</b><br><br>


    <a href='index.php'>Go Back To Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='subscribe.php?token=<?php echo $_SESSION['mail']; ?>'>Subscribe</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href='unsubscribe.php?token=<?php echo  $_SESSION['mail']; ?>'>Unsubscribe</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php
$sql = "SELECT * FROM `user_info` WHERE `Sstatus` = 1 AND `vstatus` = 1";
$result = mysqli_query($conn, $sql);
$numUsers = mysqli_num_rows($result);

$url = "https://c.xkcd.com/random/comic/";
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$a = curl_exec($ch);
$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$str  = file_get_contents($url.'info.0.json');
$json = json_decode($str, true);
$imageTitle = $json['title'];
$imageUrl = $json['img'];
$imageAlt = $json['alt'];
$imageFile = file_get_contents($imageUrl);
$tokens = explode('/', $imageUrl);
$fileName = $tokens[(count($tokens) - 1)];
$ext = explode(".", $fileName);
$fileType = $ext[1];
$header = get_headers($imageUrl, true);
$fileSize = $header['Content-Length'];


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
    $protocol .= '/aaaa/php-task/php_rtcamp/unsubscribe.php';
    $protocol .= '?key=';
    
    while ($row=mysqli_fetch_assoc($result)) {
        $protocol .= $row['code'];
$to      = $row['email'];
$subject = "Enjoy reading today's most interesting XKCD comics";
$message = '
<html>
<head>
<title>Your email '.$to.' is listed in our XKCD comics subscribers.</title>
</head>
<body> 
    <h1>'.$imageTitle.'</h1>
    <img src='.$imageUrl.' alt='.$imageAlt.'>
</body>
</html>';
$content = chunk_split(base64_encode($imageFile));
$semiRand     = md5(time());
$mimeBoundary = '==Multipart_Boundary_x{$semiRand}x';
$eol = "\r\n";
$headers  = 'Reply-To: Name <shrutigorasiya8@gmail.com>'.$eol;
$headers .= 'Return-Path: Name <shrutigorasiya8@gmail.com>'.$eol;
$headers .= 'From: Name <shrutigorasiya8@gmail.com>'.$eol;
$headers .= 'Organization: Hostinger'.$eol;
$headers  = 'MIME-Version: 1.0'.$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"{$mimeBoundary}\"".$eol;
$headers .= 'Content-Transfer-Encoding: 7bit'.$eol;
$headers .= 'X-Priority: 3'.$eol;
$headers .= 'X-Mailer: PHP'.phpversion().$eol;
$body  = '--'.$mimeBoundary.$eol;
$body .= "Content-Type: text/html; charset=\"UTF-8\"".$eol;
$body .= 'Content-Transfer-Encoding: 7bit'.$eol;
$body .= $message.$eol;
$body .= 
        '<html>
        
            <body>
            <div style="height:50px;background-color: #ebebe0 ;">
                        <center>
                <a style="background-color: yellow;color:black;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;" href='.$protocol.'>Unsubscribe</a>
                </center>
                        </div>
            </body>
            </html>'."\r\n";
$body .= '--'.$mimeBoundary.$eol;
$body .= "Content-Type:{$fileType}; name=\"{$fileName}\"".$eol;
$body .= 'Content-Transfer-Encoding: base64'.$eol;
$body .= "Content-disposition: attachment; filename=\"{$fileName}\"".$eol;
$body .= 'X-Attachment-Id: '.rand(1000, 99999).$eol;
$body .= $content.$eol;
$body .= '--'.$mimeBoundary.'--';
    $success = mail($to, $subject, $body, $headers);    
    }
if ($success === false) {
    echo '<h3>Failure</h3>';
    echo '<p>Failed to send email to '.$to.'</p>';
} else {
    
}
  }
  else
{
    echo '<script>alert ("Please check your gmail account to varify your email");</script>';
    ?>
    <center>
    <h1 class='title'>Please check your gmail account to verify your gmail</h1>
    </center>
    <a href='index.php'>Go Back To Home</a> 
    <link rel="stylesheet" href="css/style.css">
    <?php
}

?>
<body>
    <center>
<h1 class='box'>Thank You</h1>


</center>
</body>
