<?php
    $connect = mysqli_connect('localhost','root','','bookcity');
    $base_url=$_POST['base'];
     $output='';
    if(isset($_POST['search'])){
    $search=$_POST['search'];
    $sql="SELECT * FROM books WHERE title like '%$search%' or author like '%$search%' or genre like '%$search%' ORDER BY date_posted DESC";
    }else{
    $sql="SELECT * FROM books ORDER BY date_posted DESC";
    }
    
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        if($row['inactive']){$status='Inactive';}else{$status="Active";}
        $output .= "<tr>"
                . "<td class='col-md-3'>".$row['title']."</td>"
                . "<td class='col-md-2'>".$row['author']."</td>"
                . "<td class='col-md-1'>".$row['b_condition']."</td>"
                . "<td class='col-md-1'>".$row['method']."</td>"
                . "<td class='col-md-1'>".$row['date_posted']."</td>"
                . "<td class='col-md-1'>".$status."</td>"
                . "<td class='col-md-1'>"
                . "<a data-toggle='tooltip' title='View' class='btn btn-primary' href='". $base_url.'admin/book/'.$row['book_id']."'><span class='glyphicon glyphicon-open-file'></a>"
                . "</td>"
                . "</tr>";
    }
    echo $output;


?>
