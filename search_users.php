<?php
    $connect = mysqli_connect('localhost','root','','bookcity');
    $base_url=$_POST['base'];
     $output='';
    if(isset($_POST['search'])){
    $search=$_POST['search'];
    $sql="SELECT * FROM users WHERE last_name like '%$search%' or first_name like '%$search%' or username like '%$search%' or email_address like '%$search%' ORDER BY last_name ASC";
    }else{
    $sql="SELECT * FROM users ORDER BY last_name ASC";
    }
    
    $result=mysqli_query($connect,$sql);
        while ($row= mysqli_fetch_array($result)){
            if($row['inactive']){$status='Inactive'; 
                $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='". "?ac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-plus'></a>";
            }else{$status="Active";
                $link="<a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='"."?deac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-minus'></a>";
            }
            $output .= "<tr>"
                    . "<td class='col-md-3'>".$row['last_name'].', '.$row['first_name']."</td>"
                    . "<td class='col-md-2'>".$row['username']."</td>"
                    . "<td class='col-md-2'>".$row['email_address']."</td>"
                    . "<td class='col-md-2'>".$row['contact_number']."</td>"
                    . "<td class='col-md-2'>".$status."</td>"
                    . "<td class='col-md-1'>"
                    . $link
                    . "</td>"
                    . "</tr>";
        }
        echo $output;


?>
