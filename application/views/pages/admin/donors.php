<div style="margin-left: 10px;" id="page-content-wrapper">
    
    <br>
    <div class="row">
        <div class="col-md-12">
            <h1>Donors</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Email</b></td>
                    <td><b>Contact</b></td>
                    <td><b>Message</b></td>
                    <td><b>Date Sent</b></td>
                    <td><b>Action</b></td>
                </tr>
                <?php foreach ($donors as $donor){ ?>
                <tr>
                    <td class="col-md-2"><?php echo $donor->name; ?></td>
                    <td class="col-md-2"><?php echo $donor->email; ?></td>
                    <td class="col-md-2"><?php echo $donor->contact; ?></td>
                    <td class="col-md-2"><?php echo substr($donor->message, 0, 20).'...'; ?></td>
                    <td class="col-md-2"><?php echo date('d M Y h:i A', strtotime($donor->date_sent)); ?></td>
                    <td class="col-md-2">
                        <a data-toggle='tooltip' title='View Message' class='btn btn-primary' href='<?php echo base_url().'admin/donor/'.$donor->id; ?>'><span class='glyphicon glyphicon-eye-open'></a>
                        
                    </td>
                </tr>
                <?php }  ?>
            </table>
        </div>
    </div>
    
</div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>