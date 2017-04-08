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
          
          <ul class="nav_aaa nav navbar-nav navbar-right">
                            <li><a href="<?php echo base_url().'library/home'; ?>">Home</a></li>
                            <li><a href="<?php echo base_url().'discover_us/dis'; ?>">Discover Us</a></li>
                            <li><a href="<?php echo base_url().'donate/be_a_donor'; ?>">Donate Book</a></li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">Book Shelf <span style="background: #db2525" class="badge"><?php if(($notif+$mes_notif)!=0){ echo $notif+$mes_notif; }?></span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>bookshelf/my_books">My Books</a></li>
                                    <li><a href="<?php echo base_url(); ?>bookshelf/add_book">Add Book</a></li>
                                    <li><a href="<?php echo base_url(); ?>bookshelf/notifications">Notifications <span style="background: #db2525" class="badge"><?php if($notif!=0){  echo $notif; }?></span> </a></li>
                                    <li><a href="<?php echo base_url(); ?>bookshelf/messages">Messages <span style="background: #db2525" class="badge"><?php if($mes_notif!=0){  echo $mes_notif; }?></span> </a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <label class="dropdown-header"><?php echo $_SESSION['name']; ?></label> 
                                    <li><a href="<?php echo base_url(); ?>my_account/index/profile">My Account</a></li>
                                    <li><a href="<?php echo base_url(); ?>my_account/index/account_settings">Settings</a></li>
                                    <li><a href="<?php echo base_url(); ?>library/logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
        </div>
      </div>
         <?php if($is_change_password){ ?>
        <div class="row">
            <div class="col-md-12">
                <h5 style="margin: 0px" class="alert alert-warning center">Reset your password here: <a href="<?php echo base_url(); ?>my_account/index/account_settings"><?php echo base_url(); ?>my_account/index/account_settings</a></h5>
            </div>
        </div>
        <?php } ?>
         <?php if(!$is_confirmed){ ?>
        <div class="row">
            <div class="col-md-12">
                <h5 style="margin: 0px" class="alert alert-warning center">Confirm your email: A Confirmation link was sent to your email, Click <a href="<?php echo base_url(); ?>my_account/resend_confirmation">here</a> to resend confirmation link.</h5>
            </div>
        </div>
        <?php } ?>
    </nav>
 
