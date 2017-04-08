<html>
    <head>
        <?php include 'include/head.php'; ?>
        <link href="<?php echo base_url(); ?>css/landing_page.css" rel="stylesheet" />
        
    </head>
    <body>
        

<div class="container-fluid">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="row top_buffer">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div>
                                Welcome, <a class="color" href="<?php echo base_url().'library/home'; ?>"><?php 
                                echo $_SESSION['name']; 
                                ?></a> <br>
                                <a class="color" href="<?php echo base_url(); ?>library/logout?login=1">Login with another account?</a>


<?php 
                                    if($error!=""){
                                        echo '<script type="text/javascript">'
                                              . " $(window).load(function(){
                                                $('#login').modal('show');
                                                });
                                                </script>";
                                    }
                                ?>
                                
                                <div id="login" class="modal modal-transparent fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" action="<?php echo base_url();?>landing/login" method="POST">
                                                <div class="modal-header">
                                                    <h4 class="white">Login</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    if(!empty($error)){
                                                        echo '<div class="alert alert-danger">'.$error.'</div><br/>';
                                                    }
                                                    
                                                    ?>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <input type="text" class="white form-control" name="username" placeholder="Username"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <input type="password" class="white form-control" name="password" placeholder="Password"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <button class=" btn btn-block btn-warning" type="submit" name="login_button">Login</button>
                                                        </div>
                                                    </div>
                                                    <center><a class="white" href="#forgot" data-toggle="modal" data-dismiss="modal">Forgot password?</a></center>
                                                </div>
                                                <div class="modal-footer">
                                                    <center><a href="#" data-dismiss="modal">Close</a></center>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
