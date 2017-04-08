<?php
    $connect = mysqli_connect('localhost','root','','bookcity');
    $id=$_POST['id'];
    $base_url=$_POST['base'];
    $output='';
    
    if($id==1){
        $sql="SELECT * FROM users ORDER BY last_name asc";
        $result=mysqli_query($connect,$sql);
        while ($row= mysqli_fetch_array($result)){
            if($row['inactive']){$status='Inactive'; 
                $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='"."?ac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-plus'></a>";
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
    }else if($id==2){
        $sql="SELECT * FROM users WHERE !inactive ORDER BY last_name asc";
        $result=mysqli_query($connect,$sql);
        while ($row= mysqli_fetch_array($result)){
            if($row['inactive']){$status='Inactive'; 
                $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='". "?ac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-plus'></a>";
            }else{$status="Active";
                $link="<a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='". "?deac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-minus'></a>";
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
    }else if($id==3){
        $sql="SELECT * FROM users WHERE inactive ORDER BY last_name asc";
        $result=mysqli_query($connect,$sql);
        while ($row= mysqli_fetch_array($result)){
            if($row['inactive']){$status='Inactive'; 
                $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='". "?ac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-plus'></a>";
            }else{$status="Active";
                $link="<a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='". "?deac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-minus'></a>";
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
    }
    
    
        
        
    
?>