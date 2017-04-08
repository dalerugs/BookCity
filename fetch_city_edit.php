<?php
    $connect = mysqli_connect('localhost','root','','bookcity');
    
    $output='<option disabled value>Select City/Municipality</option>';
    
        $province_id=$_POST['user_id'];
        $old_city=$_POST['city'];
        $sql="SELECT * FROM city where province_id=$province_id ORDER BY city";
        $result = mysqli_query($connect,$sql);
//        $r= mysqli_fetch_all($result,MYSQLI_ASSOC);
        while ($row= mysqli_fetch_array($result)){
            $city_id=$row['city_id'];
            $city=$row['city'];
            if($city==$old_city){
                $output .= "<option selected value='$city_id'>$city</option> ";
            }
            else
            {
                $output .= "<option value='$city_id'>$city</option> ";
            }
            
            
            
        }
    echo $output;
    
?>