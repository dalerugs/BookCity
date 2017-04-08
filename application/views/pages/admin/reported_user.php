<br><br>

<div class="row">
    <div class="col-md-12">
        <div style="position: fixed;margin-left: 1100px">
            <a  class="label label-default" href="<?php echo base_url(); ?>admin/reported"><span class="glyphicon glyphicon-chevron-left"></span>Back</a><br><br>
        </div>
        <h1>Reported User</h1>
    </div>
</div>

<?php 
    if($inactive){$status='Inactive'; 
    $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='". "?ac=1&id=".$user_id."&user=1"."'><span class='glyphicon glyphicon-plus'></a>";
    }else{$status="Active";
        $link="<a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='".  "?deac=1&id=".$user_id."&user=1"."?user=1"."'><span class='glyphicon glyphicon-minus'></a>";
    }                
?>



<div class="row">
    <div class="col-md-6">
        <table class="table table-condensed">
            <tr>
                <td class="col-md-6"><b>Name:</b></td>
                <td class="col-md-6"><?php echo $last_name.', '.$first_name; ?></td>
            </tr>
            <tr>
                <td class="col-md-6"><b>Username:</b></td>
                <td class="col-md-6"><?php echo $username; ?></td>
            </tr>
             <tr>
                <td class="col-md-6"><b>Email:</b></td>
                <td class="col-md-6"><?php echo $email_address; ?></td>
            </tr>
            <tr>
                <td class="col-md-6"><b>Contact No:</b></td>
                <td class="col-md-6"><?php echo $contact_number; ?></td>
            </tr>
            <tr>
                <td class="col-md-6"><b>Status:</b></td>
                <td class="col-md-6"><?php echo $status; ?>&nbsp;&nbsp;&nbsp;<?php echo $link; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <tr>
                <td class="col-md-4"><b>Reason</b></td>
                <td class="col-md-4"><b>Others</b></td>
                <td class="col-md-4"><b>Report Date</b></td>
            </tr>
            
            <?php if(!empty($reports)){ foreach($reports as $report){ ?>
            <tr>
                <td><?php echo $report->reason; ?></td>
                <td><?php echo $report->other; ?></td>
                <td><?php echo date('d M Y H:i A', strtotime($report->report_date)); ?></td>
                
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
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/deac_user/".$_GET['id'].'?user=1'; ?>'>YES</a>
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
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/ac_user/".$_GET['id'].'?user=1'; ?>'>YES</a>
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