<?php

if(isset($_GET['status']) && !empty($_GET['status']))
{
    $status = $_GET['status'];
    $book_id=$_GET['book_id'];
    $con = mysqli_connect('localhost','root','','bookcity');

    $update = "UPDATE auction_details SET auction_status ='". $status."'  WHERE book_id = '".$book_id."'";

    if (mysqli_query($connect, $update))
    {
        echo "Record updated successfully";
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($connect);
    }
    die;
}
?>

