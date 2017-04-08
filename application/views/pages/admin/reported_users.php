<br><br>

<div class="row">
    <div class="col-md-12">
        <h1>Reported Users</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table style="margin-top: 15px" class="table">
            <tr>
                <td class='col-md-2'><b>Name</b></td>
                <td class='col-md-2'><b>Username</b></td>
                <td class='col-md-2'><b>Email</b></td>
                <td class='col-md-2'><b>Contact No.</b></td>
                <td class='col-md-1'><b>Status</b></td>
                <td class='col-md-1'><b># of Reports</b></td>
                <td class='col-md-2'><b>Action</b></td>
            </tr>
        </table>
        <table id="users" class="table table-hover">
            <?php if(!empty($users)){ foreach ($users as $user){ 
            if($user->inactive){$status='Inactive'; 
            $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='".  "?ac=1&id=".$user->user_id."?users=1"."'><span class='glyphicon glyphicon-plus'></a>";
            }else{$status="Active";
                $link="<a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='". "?deac=1&id=".$user->user_id."?users=1"."'><span class='glyphicon glyphicon-minus'></a>";
            }                
                            ?>
            <tr>    
                <td class='col-md-2'><?php echo $user->last_name.', '.$user->first_name; ?></td>
                <td class='col-md-2'><?php echo $user->username; ?></td>
                <td class='col-md-2'><?php echo $user->email_address; ?></td>
                <td class='col-md-2'><?php echo $user->contact_number; ?></td>
                <td class='col-md-1'><?php echo $status; ?></td>
                <td class='col-md-1'><?php echo $user->reports; ?></td>
                <td class='col-md-2'>
                    <?php echo $link ?>
                    <a data-toggle='tooltip' title='View Reports' class='btn btn-info' href='<?php echo base_url().'admin/report/'.$user->user_id; ?>'><span class='glyphicon glyphicon-eye-open'></a>
                
                </td>
                
                <td>
                    
                </td>
            </tr>
            <?php }} ?>
        </table>
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
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/deac_user/".$_GET['id'].'?users=1'; ?>'>YES</a>
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
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/ac_user/".$_GET['id'].'?users=1'; ?>'>YES</a>
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
