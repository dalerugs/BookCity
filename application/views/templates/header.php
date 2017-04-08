<html>
    <head>
        <?php include 'include/head.php'; ?>
        <link href="<?php echo base_url(); ?>css/main_style.css" rel="stylesheet" />
    </head>
    <body>
        
         <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a  href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>images/BookCity_Logo.png" width="200px" alt="BOOKCITY">
                        </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav navbar-collapse navbar-right">
              <li class=""><a href="<?php echo base_url().'library/home'; ?>">Home</a></li>
              <li class=""><a href="<?php echo base_url().'discover_us/dis'; ?>">Discover Us</a></li>
              <li class=""><a href="<?php echo base_url().'donate/be_a_donor'; ?>">Donate Book</a></li>
              <li class=""><a href="<?php echo base_url().'?login=1'; ?>" data-toggle="modal">Login</a></li>
              <li class=""><a href="<?php echo base_url(); ?>sign_up/index">Sign Up</a></li>
                        </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
        
        
<!--        <div class="navbar color-orange navbar-fixed-top">
            <div class="container fluid">
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>images/BookCity_Logo.png" width="200px" alt="BOOKCITY">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav navbar-nav navbar-collapse navbar-right">
                            <li><a href="<?php echo base_url().'library/home'; ?>">Home</a></li>
                            <li><a href="<?php echo base_url().'discover_us/dis'; ?>">Discover Us</a></li>
                            <li><a href="<?php echo base_url().'discover_us/dis'; ?>">Donate Book</a></li>
                            <li><a href="<?php echo base_url().'?login=1'; ?>" data-toggle="modal">Login</a></li>
                            <li><a href="<?php echo base_url(); ?>sign_up/index">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>-->



                                <?php 
                                    if($error!=""){
                                        echo '<script type="text/javascript">'
                                              . " $(window).load(function(){
                                                $('#login').modal('show');
                                                });
                                                </script>";
                                    }
                                ?>
                                
                                <div id="login" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" action="<?php echo base_url();?>landing/login" method="POST">
                                                <div class="modal-header">
                                                    <h4>Login</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label><?php echo $error;?></label><br/>
                                                    <input type="text" class="form-control" name="username" placeholder="Username"/>
                                                    <input type="password" class="form-control" name="password" placeholder="Password"/>
                                                    <br><center><a href="#forgot" data-toggle="modal" data-dismiss="modal">Forgot password?</a></center>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-block" type="submit" name="login_button">Login</button><br>
                                                    <center><a href="#" data-dismiss="modal">Close</a></center>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

<div id="forgot" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" action="<?php echo base_url();?>landing/forgot" method="POST">
                <div class="modal-header">
                    <h4>Forgot Password</h4>
                </div>
                <div class="modal-body">
                    <label><?php echo $erMessage;?></label>
                    <label><?php echo $success_message;?></label>
                    <br><label for="input">Find your account</label><br/><br/>
                    <input type="text" class="form-control" name="forgotten" placeholder="Username or Email Address"/>
                    <center><label><?php echo $message;?></label></center>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block" type="submit" name="forgot_bt">OK</button>
                    <br>
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
