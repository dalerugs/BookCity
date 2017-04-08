<div class="row logo_top_buffer">
    <div class="col-md-4"></div>
    <div class="col-md-4 center">
        <img class="img-responsive" width="500px" src="<?php echo base_url().'images/BookCity_Logo_landing.png';  ?>">
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 ">
        <div class="row">
            <div class="col-md-6 center">
                <a class="color"  href="<?php echo base_url().'library/home'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">GO TO LIBRARY</h3></a>
            </div>
            <div class="col-md-6 center">
                <a class="color"  href="<?php echo base_url().'discover_us/dis'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">DISCOVER US</h3></a>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>







<div id="forgot" class="modal fade modal-transparent" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>landing/forgot">
                <div class="modal-header">
                    <h4 class="white">Forgot Password</h4>
                </div>
                <div class="modal-body">
                    <?php
                        if(!empty($erMessage)){
                            echo '<div class="alert alert-danger">'.$erMessage.'</div>';
                            
                        }
                        ?>

                    <?php
                        if(!empty($success_message)){
                            echo '<div class="alert alert-success">'.$success_message.'</div>';
                            
                        }
                        ?>
                    <h5 class="white">Find your account</h5>
                    <div class="form-group ">
                        <div class="col-md-6 col-md-offset-3">
                            <input type="text" class="form-control" name="forgotten" placeholder="Username or Email Address"/>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-md-6 col-md-offset-3">
                            <button class="btn btn-block btn-warning" type="submit" name="forgot_bt">OK</button>
                        </div>
                    </div>
                    
                        
                        <?php
                        if(!empty($message)){
                            echo '<div class="alert alert-info">'.$message.'</div>';
                            
                        }
                        ?>
                </div>
                <div class="modal-footer">
                    <center><a href="#" data-dismiss="modal">Close</a></center>
                </div>
            </form>
         </div>
    </div>
</div> 


<?php 
    if($erMessage!="" || $success_message!="" || $message!="" ){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#forgot').modal('show');
        });
        </script>";
    }
?>

