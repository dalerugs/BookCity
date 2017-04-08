<?php 

function load_city($city){
    $connect = mysqli_connect('localhost','root','','bookcity');
    $output='';
    $sql="SELECT * FROM province ORDER BY province";
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        $province_id=$row['province_id'];
        $province=$row['province'];
        if($city==$province){
            $output .= "<option value='$province_id' selected >$province</option> ";
        }
        else
        {
            $output .= "<option value='$province_id'>$province</option> ";
        }
        
    }
    return $output;
}

function load_city1($city){
    $connect = mysqli_connect('localhost','root','','bookcity');
    $output='';
    $sql="SELECT * FROM city ORDER BY city";
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        $province_id=$row['city_id'];
        $province=$row['city'];
        if($city==$province){
            $output .= "<option value='$province_id' selected >$province</option> ";
        }
        else
        {
            $output .= "<option value='$province_id'>$province</option> ";
        }
        
    }
    return $output;
}

?>

<div class="col-md-10 panel panel-default">
                    <div class="row">
                        <div class="col-md-12 color-white">
                            <form id="edit_form" method="POST" action="<?php echo base_url();?>my_account/edit_profile">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="center">Basic Information</h4>
                                        <div class="form-group">
                                            <label for="fname">First Name:</label>
                                            <input type="text" class="form-control" name="fname" value="<?php echo htmlentities($first_name); ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="lname">Last Name:</label>
                                            <input type="text" class="form-control" name="lname" value="<?php echo htmlentities($last_name); ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="sex">Sex</label><br>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default  <?php if ($sex == 'Male'){ echo "active";} ?>">
                                                <input type="radio" name="sex" value="Male" <?php if ($sex == 'Male'){ echo 'checked=checked';} ?> >Male
                                            </label>
                                            <label class="btn btn-default <?php if ($sex == 'Female'){ echo "active";} ?> ">
                                                <input type="radio" name="sex" value="Female"  <?php if ($sex == 'Female'){ echo 'checked=checked';} ?>>Female
                                            </label>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bdate">Birth Date:</label>
                                            <input type="date" class="form-control" name="bdate" value="<?php echo htmlentities($birth_date); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact Number:</label>
                                            <input type="text" class="form-control" name="contact" value="<?php echo htmlentities($contact_number); ?>"/>
                                        </div>
                                        
                                        <br>
                                        
                                        <h4 class="center">Location</h4>
                                        <div class="form-group">
                                            <label for="city">Province</label>
                                            
                                                <select onchange="getId(this.value)" class="form-control" name="city" id="province">
                                                    <option disabled >Select Province</option>
                                                    <?php echo load_city($city); ?>
                                                </select>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="city_area" >City/Municipality</label>
                                            
                                                <select class="form-control" name="city_area" id="city">
                                                    <option disabled selected value>Select City/Municipality</option>
                                                    <?php echo load_city1($city_area); ?>
                                                </select>
                                            
                                        </div>
                                        
                                        
                                       
                                        <br>
                                        <input type="submit" class="btn btn-default btn-block" name="Save" value="Save Changes"/><br>
                                    </div>
                                     <div class="col-md-6"></div>
                                 
                                </div>
                                
                            </form>
                            
                        </div>
                </div>
                </div>
                
                
                    
            </div>
        </div>

        
<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#edit_form").bootstrapValidator({
                fields :{
                    fname :{
                        validators :{
                             notEmpty :{
                                 message :"First name is required"
                             }
                        }
                    },
                    lname :{
                        validators :{
                             notEmpty :{
                                 message :"Last name is required"
                             }
                        }
                    },
                    
                    bdate :{
                        validators :{
                            notEmpty: {
                                message: "Birth date is required"
                            }
                        }
                    },
                    contact :{
                        validators :{
                            notEmpty: {
                                message: "Contact number is required"
                            }
                        }
                    },
                    
                    city_area :{
                        validators :{
                            notEmpty: {
                                message: "City/Municipality is required"
                            }
                        }
                    },
                    city :{
                        validators :{
                            notEmpty: {
                                message: "Province is required"
                            }
                        }
                    }
                    
                }
            });
        } );
    
    </script>
    
    <script>
//$(document).ready(function(){
//   $('#country').change(function(){
//       var province_id=$(this).val();
//       $.ajax({
//           url:'fetch_city.php',
//           method: "POST",
//           data: {province_id:province_id},
//           dataType:"text",
//           success:function(data)
//           {
//               $('#city').html(data);
//           }
//       });
//   }) ;
//});

function getId(val){
   
        var cit='<?php $city_area ?>';
    $.ajax({
        type:"POST",
        url:'<?php echo base_url(); ?>fetch_city_edit.php',
        data: {
            user_id: val,
            city: cit
        },
        success: function(response){
           $("#city").html(response);
    }
    });
}

</script>