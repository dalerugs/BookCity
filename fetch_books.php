<?php
    $connect = mysqli_connect('localhost','root','','bookcity');
    $id=$_POST['id'];
    $base_url=$_POST['base'];
    $output='';
    
    if($id==1){
        $sql="SELECT * FROM books ORDER BY date_posted DESC";
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
    }else if($id==2){
        $sql="SELECT * FROM books where method='Sell' AND !inactive ORDER BY date_posted DESC";
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
    }else if($id==3){
        $sql="SELECT * FROM books where method='Auction' AND !inactive ORDER BY date_posted DESC";
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
    }else if($id==4){
        $sql="SELECT * FROM books where inactive ORDER BY date_posted DESC";
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
    }
    
    
        
        
    
?>