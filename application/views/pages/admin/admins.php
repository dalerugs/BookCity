<div style="margin-left: 10px;" id="page-content-wrapper">

    <br>
    <div class="row">
        <div class="col-md-12">
            <h1>Admins</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Username</b></td>
                    <td><b>Password</b></td>
                    <td><b>Status</b></td>
                    <td><b>Action</b></td>
                </tr>
                <?php foreach ($admins as $admin){ ?>
                <tr>
                    <td class="col-md-3"><?php echo $admin->Name; ?></td>
                    <td class="col-md-3"><?php echo $admin->username; ?></td>
                    <td class="col-md-2">******</td>
                    <td class="col-md-2">
                        <?php if($admin->type=='SA'){echo '-';}
                        else{
                            if($admin->inactive){
                                echo 'Inactive';
                            } else {
                                echo 'Active';
                            }
                            
                            
                        }?>
                    </td>
                    <td class="col-md-2">
                        <a data-toggle='tooltip' title='Edit' class='btn btn-primary' href='<?php echo base_url().'admin/edit/'.$admin->admin_id; ?>'><span class='glyphicon glyphicon-edit'></a>
                        <?php if($admin->type=='A'){ if($admin->inactive){ ?>
                        <a data-toggle='tooltip' title='Activate' class='btn btn-success' href='<?php echo "?ac=1&id=".$admin->admin_id; ?>'><span class='glyphicon glyphicon-plus'></a>
                        <?php }else{ ?>
                        <a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='<?php echo "?deac=1&id=".$admin->admin_id; ?>'><span class='glyphicon glyphicon-minus'></a>
                        <?php }} ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <a onclick="document.getElementById('new_div').style.display='';return false;" href=""><span class="glyphicon glyphicon-plus"></span> Create new admin </a>
        </div>
    </div>
    <br>
    <div style="display:none" id="new_div" class="row">
        <div class="col-md-6">
            <form id="create_form" class="form-horizontal" method="POST">
            <div class="form-group">
                <div class="col-md-6">
                    <input name="Name" class="form-control" type="text" placeholder="Admin Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <input name="username" class="form-control" type="text" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <input name="password" class="form-control" type="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <input name="con_password" class="form-control" type="password" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-md-offset-4">
                    <input name="create" class="btn btn-primary" type="submit" value="Create">
                </div>
            </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <label>Admin Link: </label><p class="text text-info"><?php echo base_url().'admin/admin_login?token='.$token; ?></p>
            <a data-toggle='tooltip' title='Generate new link' class='btn btn-success' href='<?php echo base_url(); ?>admin/gen_link'>Generate</a>
        </div>
    </div>
    
    
    
    
    
</div>
      
</div>


<div id="deac_account" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="text text-danger">Are you sure you want to deactivate this account?</h5></center><br>
            </div>
            <div class="modal-body">
                <div class="col-md-2 col-md-offset-4">
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/deac_admin/".$_GET['id']; ?>'>YES</a>
                </div>
                <div class="col-md-2">
                    <button data-toggle='tooltip' title='NO' class='btn btn-danger btn-block' data-dismiss="modal">NO</button>
                </div>
                <br><br>
            </div>
            <div style="text-align: center" class="modal-footer">
            </div>    
        </div>
    </div>
</div>

<?php 
    if(isset($_GET['deac'])){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#deac_account').modal('show');
        });
        </script>";
    }
?>

<div id="ac_account" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="text text-danger">Are you sure you want to activate this account?</h5></center><br>
            </div>
            <div class="modal-body">
                <div class="col-md-2 col-md-offset-4">
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/ac_admin/".$_GET['id']; ?>'>YES</a>
                </div>
                <div class="col-md-2">
                    <button data-toggle='tooltip' title='NO' class='btn btn-danger btn-block' data-dismiss="modal">NO</button>
                </div>
                <br><br>
            </div>
            <div style="text-align: center" class="modal-footer">
            </div>    
        </div>
    </div>
</div>

<?php 
    if(isset($_GET['ac'])){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#ac_account').modal('show');
        });
        </script>";
    }
?>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#create_form").bootstrapValidator({
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
                                url: '<?php echo base_url(); ?>check_admin_username.php',
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