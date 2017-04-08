<br><br>

<div class="row">
    <div class="col-md-12">
        <h1>Top Users</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table">
            <tr>
                <td class='col-md-2'><b>Name</b></td>
                <td class='col-md-2'><b>Username</b></td>
                <td class='col-md-2'><b>Email</b></td>
                <td class='col-md-2'><b>Contact No.</b></td>
                <td class='col-md-1'><b>Status</b></td>
                <td class='col-md-1'><b>Ratings</b></td>
            </tr>
        </table>
        <table class="table table-hover">
            <?php foreach ($users as $user){ 
                if($user->inactive){$status='Inactive'; 
            }else{$status="Active";
              }  
                ?>
            <tr>
                <td class='col-md-2'><?php echo $user->last_name.', '.$user->first_name; ?></td>
                <td class='col-md-2'><?php echo $user->username; ?></td>
                <td class='col-md-2'><?php echo $user->email_address; ?></td>
                <td class='col-md-2'><?php echo $user->contact_number; ?></td>
                <td class='col-md-1'><?php echo $status; ?></td>
                <td class='col-md-1'>
                    <div class="col-md-6"><?php echo round($user->rating,1); ?></div>
                    <img src="<?php echo base_url(); ?>images/star-on.svg">
                </td>
               
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
    
</div>
</div>
