<div class="col-md-10 color-white panel panel-default">
                    <h4>Account Information</h4>
                    <div class="row">
                        <div class="col-md-2">
                            <h5>Username:</h5>
                        </div>
                        <div class="col-md-4">
                            <h5><?php echo $username; ?></h5>
                        </div>
                        <div class="col-md-6">
                            <h5><a href="#change_username" data-toggle="modal">Change Username</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <h5>Email:</h5>
                        </div>
                        <div class="col-md-4">
                            <h5><?php echo $email_address; ?></h5>
                        </div>
                        <div class="col-md-6">
                            <h5><a href="#change_email" data-toggle="modal">Change Email</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <h5>Password:</h5>
                        </div>
                        <div class="col-md-4">
                            <h5>******</h5>
                        </div>
                        <div class="col-md-6">
                            <h5><a href="#change_password" data-toggle="modal">Change Password</a></h5>
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>
        
        
<?php 
    if($er_change_username!=""){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#change_username').modal('show');
        });
        </script>";
    }
?>

<?php 
    if($er_change_email!=""){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#change_email').modal('show');
        });
        </script>";
    }
?>

<?php 
    if($er_change_password!=""){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#change_password').modal('show');
        });
        </script>";
    }
?>


<div id="change_username" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="c_username" action="<?php echo base_url();?>my_account/change_username" class="form-horizontal"  method="POST">
                <div class="modal-header">
                    <h4>Change Username</h4>
                </div>
                <div class="modal-body">
                    
                    <?php
                        if(!empty($er_change_username)){
                            echo '<div class="alert alert-danger">'.$er_change_username.'</div>';
                            
                        }
                        ?>
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <div class="form-group">
                        <label for="username">New Username:</label>
                        <input type="text" class="form-control" name="username" placeholder="Username"/>
                    </div>   
                    </div>
                    <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <button class="btn btn-default" type="submit" name="change_Username">Change</button>
                </div>
            </form>
         </div>
    </div>
</div> 

<div id="change_email" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="c_email" action="<?php echo base_url();?>my_account/change_email" class="form-horizontal" method="POST">
                <div class="modal-header">
                    <h4>Change Email</h4>
                </div>
                <div class="modal-body">
                    <?php
                        if(!empty($er_change_email)){
                            echo '<div class="alert alert-danger">'.$er_change_email.'</div>';
                            
                        }
                        ?>
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <div class="form-group">
                        <label for="email">New Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="you.example.com"/>
                    </div>
                        </div>
                    <div class="col-md-2"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <button class="btn btn-default" type="submit" name="change_Email">Change</button>
                </div>
            </form>
         </div>
    </div>
</div>  

<div id="change_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="c_password" class="form-horizontal" action="<?php echo base_url();?>my_account/change_password" method="POST">
                <div class="modal-header">
                    <h4>Change Password</h4>
                </div>
                <div class="modal-body">
                    <?php
                        if(!empty($er_change_password)){
                            echo '<div class="alert alert-danger">'.$er_change_password.'</div>';
                            
                        }
                        ?>
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <div class="form-group">
                        <label for="old_pass">Old Password:</label>
                        <input type="password" class="form-control" name="old_pass" />
                    </div>
                    <div class="form-group">
                        <label for="new_pass">New Password:</label>
                        <input type="password" class="form-control" name="new_pass" />
                    </div>
                    <div class="form-group">
                        <label for="con_pass">Confirm Password:</label>
                        <input type="password" class="form-control" name="con_pass"/>
                    </div>
                    </div>
                    <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <button class="btn btn-default" type="submit" name="change_Password">Change</button>
                </div>
            </form>
         </div>
    </div>
</div>
        
        
<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#c_username").bootstrapValidator({
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
                                message: 'You or someone is already using this username',
                                url: '<?php echo base_url().'check_username.php'; ?>',
                                type: 'POST',
                                delay: 2000
                            }
                        }
                    } 
                }
            });
        } );
    
    </script>

    <script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#c_email").bootstrapValidator({
                fields :{
                    email :{
                        validators :{
                            notEmpty: {
                                message: "Email Address is required"
                            },
                            remote: {
                                message: 'You or someone is already using this email',
                                url: '<?php echo base_url().'check_email.php'; ?>',
                                type: 'POST',
                                delay: 2000
                            },
                            emailAddress: {
                            message: 'Please enter a valid email address'
                        }
                        }
                    }
                }
            });
        } );
    
    </script>
    
    <script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#c_password").bootstrapValidator({
                fields :{
                    new_pass :{
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
                    con_pass :{
                        validators :{
                            identical: {
                                field: 'new_pass',
                                message: "Password didn't match"
                            }
                        },
                        notEmpty :{
                                 message :"This is required"
                             }
                    },
                    old_pass :{
                        validators :{
                             notEmpty :{
                                 message :"Password is required"
                             },
                            remote: {
                                message: "Your input didn't match your password",
                                url: '<?php echo base_url().'check_password.php'; ?>',
                                data: {
                                    user_id: '<?php echo $_SESSION['user_id']; ?>'
                                },
                                type: 'POST',
                                delay: 2000
                            }
                        }
                    }
                    
                }
            });
        } );
    
    </script>
        
        
        
        