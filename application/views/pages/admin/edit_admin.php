<div style="margin-left: 10px;" id="page-content-wrapper">
    <br>
    <div class="row">
        <div style="position: fixed;margin-left: 1100px">
            <a  class="label label-default" href="<?php echo base_url(); ?>admin/admins"><span class="glyphicon glyphicon-chevron-left"></span>Back</a><br><br>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h3 class="text text-info">Edit Admin Details</h3><br>
            <form id="edit_form" class="form-horizontal" method="POST">
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="Name">Admin Name:</label>
                    </div>
                    <div class="col-md-4">
                        <input value="<?php echo html_entity_decode($Name); ?>" name="Name" class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="username">Username:</label>
                    </div>
                    <div class="col-md-4">
                        <input value="<?php echo html_entity_decode($username); ?>" name="username" class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="password">Password:</label>
                    </div>
                    <div class="col-md-4">
                        <input name="password" class="form-control" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="con_password">Confirm Password:</label>
                    </div>
                    <div class="col-md-4">
                        <input name="con_password" class="form-control" type="password">
                    </div>
                </div>
                <div class="form-group">
                <div class="col-md-3 col-md-offset-3">
                    <input value="<?php echo html_entity_decode($admin_id); ?>" name="admin_id" class="btn btn-primary btn-block" type="hidden">
                    <input name="save" class="btn btn-primary btn-block" type="submit" value="Save Changes">
                </div>
            </div>
            </form>

        </div>
    </div>


    
</div>
      
</div>


<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#edit_form").bootstrapValidator({
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
                                url: '<?php echo base_url(); ?>edit_check_admin_username.php',
                                data: { admin_id: '<?php echo $admin_id; ?>' },
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
                    Name :{
                        validators :{
                            notEmpty: {
                                message: "Name is required"
                            }
                        }
                    }
                    
                    
                }
            });
        } );
    
    </script>