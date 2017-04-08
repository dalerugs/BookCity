<?php

$con = mysqli_connect('localhost','root','','bookcity');
$username=$_POST['username'];
$result=mysqli_query($con,"select * from users where username = '$username'");
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
