<?php

$con = mysqli_connect('localhost','root','','bookcity');
$username=$_POST['username'];
$admin_id=$_POST['admin_id'];
$result=mysqli_query($con,"select * from admins where username = '$username' AND admin_id != '$admin_id'");
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
