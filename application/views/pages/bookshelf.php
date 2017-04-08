<div style="margin-top:75px" class="container top-buffer">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-2  ">
                    <div style="position: fixed">
                    <h4>My Bookshelf</h4>
                    <ul class="nav">
                        <li><a href="<?php echo site_url('/bookshelf/my_books') ?>">My Books</a></li>
                        <li><a href="<?php echo site_url('/bookshelf/add_book') ?>">Add Book</a></li>
                        <li><a href="<?php echo site_url('/bookshelf/notifications') ?>">Notifications <span style="background: #db2525" class="badge"><?php if($notif!=0){  echo $notif; }?></span></a></li>
                        <li><a href="<?php echo site_url('/bookshelf/messages') ?>">Messages <span style="background: #db2525" class="badge"><?php if($mes_notif!=0){  echo $mes_notif; }?></span></a></li>
                    </ul>
                    </div>
                </div>
