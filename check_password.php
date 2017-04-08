<?php

$con = mysqli_connect('localhost','root','','bookcity');
$old_pass=$_POST['old_pass'];
$user_id=$_POST['user_id'];
$result=mysqli_query($con,"select * from users where user_id = '$user_id'");
$row= mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)){
    $password=$row['password'];
}
        if ($password!=md5($old_pass)){
            mysqli_close($con);
            $valid = false;
        }else if ( $password==md5($old_pass)){
            mysqli_close($con);
            $valid = true;
         }
         
echo json_encode(array(
    'valid' => $valid,
));

?>
