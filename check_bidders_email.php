<?php

$con = mysqli_connect('localhost','root','','bookcity');
$email=$_POST['b_email'];
$book_id=$_POST['book_id'];

$result=mysqli_query($con,"select * from bidders where email = '$email' AND book_id = $book_id");
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