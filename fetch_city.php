<?php
    $connect = mysqli_connect('localhost','root','','bookcity');
    
    $output='<option disabled selected value>Select City/Municipality</option>';
    
        $province_id=$_POST['user_id'];
        $sql="SELECT * FROM city where province_id=$province_id ORDER BY city";
        $result = mysqli_query($connect,$sql);
//        $r= mysqli_fetch_all($result,MYSQLI_ASSOC);
        while ($row= mysqli_fetch_array($result)){
            $city_id=$row['city_id'];
            $city=$row['city'];
            $output .= "<option value='$city_id'>$city</option> ";
        }
    echo $output;
    
?>