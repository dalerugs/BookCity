<?php

$con = mysqli_connect('localhost','root','','bookcity');
$email=$_POST['m_email'];
$user_id=$_POST['user_id'];

$result=mysqli_query($con,"select * from messengers where email = '$email' AND user_id = $user_id");
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