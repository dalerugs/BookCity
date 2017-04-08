<div style="margin-left: 10px;" id="page-content-wrapper">
    <br>
    <div class="row">
        <div style="position: fixed;margin-left: 1100px">
            <a  class="label label-default" href="<?php echo base_url(); ?>admin/donors"><span class="glyphicon glyphicon-chevron-left"></span>Back</a><br><br>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h3 class="">Donor</h3><br>
            
            <table class="table">
                <tr>
                    <td>Name:</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Contact No:</td>
                    <td><?php echo $contact; ?></td>
                </tr>
                <tr>
                    <td>Date Sent:</td>
                    <td><?php echo date('d M Y h:i A', strtotime($date_sent)); ?></td>
                </tr>
                <tr>
                    <td>Message:</td>
                    <td><?php echo $message; ?></td>
                </tr>
                
            </table>
            

        </div>
    </div>
</div>
</div>