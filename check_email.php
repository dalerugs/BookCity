<?php

$con = mysqli_connect('localhost','root','','bookcity');
$email=$_POST['email'];
$result=mysqli_query($con,"select * from users where email_address = '$email'");
        if ( mysqli_num_rows($result)==1){
            mysqli_close($con);
            $valid = false;
        }else if ( mysqli_num_rows($result)==0){
            mysqli_close($con);
            $valid = true;
         }
         
echo json_encode(array(
    'valid' => $valid,
));

?>
