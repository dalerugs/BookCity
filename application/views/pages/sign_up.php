<?php 

function load_city(){
    $connect = mysqli_connect('localhost','root','','bookcity');
    $output='';
    $sql="SELECT * FROM province ORDER BY province";
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        $province_id=$row['province_id'];
        $province=$row['province'];
        $output .= "<option value='$province_id'>$province</option> ";
    }
    return $output;
}

?>

<div style="margin-top:75px" class="container top-buffer">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 style="margin-left: 30px">Create an Account</h3>
                    <form id="registration_form" method="post" class="form-horizontal" action="<?php echo base_url();?>sign_up/register">
                        <div class="row"><div class="col-md-6"><h4 class="center">Account Information</h4></div></div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="username">Username</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="password">Password</label>
                            <div class="col-md-4">
                                <input class="form-control" type="password" name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="con_password">Confirm Password</label>
                            <div class="col-md-4">
                                <input class="form-control" type="password" name="con_password" >
                            </div>
                        </div>
                        
                        <br> <br>
                        <div class="row"><div class="col-md-6"><h4 class="center">Basic Information</h4></div></div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="fname">First Name</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="fname" >              
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="lname">Last Name</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="lname" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="bdate">Birth Date</label>
                            <div class="col-md-4">
                                <input class="form-control" type="date" name="bdate" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="sex">Sex</label>
                            <div class="col-md-4">
                                <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" >
                                                <input type="radio" name="sex" value="Male"  >Male
                                            </label>
                                            <label class="btn btn-default  ">
                                                <input type="radio" name="sex" value="Female">Female
                                            </label>
                                </div>
                            </div>
                        </div>
                        
                        <br> <br>
                        <div class="row"><div class="col-md-6"><h4 class="center">Contact Information</h4></div></div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="email">Email Address</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="contact_number">Contact Number</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="contact_number">
                            </div>
                        </div>
                        
                        
                        <br> <br>
                        <div class="row"><div class="col-md-6"><h4 class="center">Location</h4></div></div><br>
                        <div class="form-group">
                            <label  class="col-md-2 control-label" for="city">Province</label>
                            <div class="col-md-4">
                                <select onchange="getId(this.value)" class="form-control" name="city" id="province">
                                    <option disabled selected value>Select Province</option>
                                    <?php echo load_city(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="city_area" >City/Municipality</label>
                            <div class="col-md-4">
                                <select class="form-control" name="city_area" id="city">
                                    <option disabled selected value>Select City/Municipality</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <input class="btn btn-block btn-default" type="submit" value="Register" name="register">
                                
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
</div>
    
    <script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#registration_form").bootstrapValidator({
                fields :{
                    username :{
                        validators :{
                             notEmpty :{
                                 message :"Username is required"
                             },
                             stringLength: {
                                min: 6,
                                max: 20,
                                message: 'Username must be more than 6 and less than 20 characters'
                            },
                            remote: {
                                message: 'Username is not available',
                                url: '<?php echo base_url(); ?>check_username.php',
                                type: 'POST',
                                delay: 2000
                            }
                        }
                    },
                    password :{
                        validators :{
                             notEmpty :{
                                 message :"Password is required"
                             },
                             stringLength: {
                                min: 6,
                                message: 'The password must be more than 6 characters'
                            }
                        }
                    },
                    con_password :{
                        validators :{
                            identical: {
                                field: 'password',
                                message: "Password didn't match"
                            }
                        }
                    }
                    ,
                    fname :{
                        validators :{
                            notEmpty: {
                                message: "First name is required"
                            }
                        }
                    },
                    lname :{
                        validators :{
                            notEmpty: {
                                message: "Last name is required"
                            }
                        }
                    },
                    bdate :{
                        validators :{
                            notEmpty: {
                                message: "Birth date is required"
                            },
                            remote:{
                                message: 'Age must be 18 years old and above',
                                url: '<?php echo base_url(); ?>check_age.php',
                                type:'POST'
                            }
                        }
                    },
                    email :{
                        validators :{
                            notEmpty: {
                                message: "Email Address is required"
                            },
                            remote: {
                                message: 'Someone is already using this email',
                                url: '<?php echo base_url(); ?>check_email.php',
                                type: 'POST',
                                delay: 2000
                            },
                            emailAddress: {
                            message: 'Please enter a valid email address'
                        }
                        }
                    },
                    contact_number :{
                        validators :{
                            notEmpty: {
                                message: "Contact number is required"
                            }
                        }
                    },
                    house_number :{
                        validators :{
                            notEmpty: {
                                message: "House number is required"
                            }
                        }
                    },
                    street_name :{
                        validators :{
                            notEmpty: {
                                message: "Street name is required"
                            }
                        
                        }
                    },
                    city_area :{
                        validators :{
                            notEmpty: {
                                message: "City is required"
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


function getId(val){
   
    $.ajax({
        type:"POST",
        url:'<?php echo base_url(); ?>fetch_city.php',
        data: {
            user_id: val
        },
        success: function(response){
           $("#city").html(response);
    }
    });
}

</script>