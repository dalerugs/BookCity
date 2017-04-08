<div class="col-md-10 color-white panel panel-default">
    
    <div class="row">
        <div class="col-md-12">
            <h3>Notifications</h3>
        </div>
    </div>
    
    <table class="table table-hover">
        <?php foreach ($notifs as $notif){
            $link=site_url('/bookshelf/book/'.$notif->book_id)."?from_notification=the05a899dxux5bca2n8&type=$notif->type#comments";
            if($notif->type=='bidding'){
                $link=site_url('/bookshelf/auction_control/'.$notif->book_id)."?from_notification=the05a899dxux5bca2n8&type=$notif->type";
            }
        ?>
        
        <tr class="<?php if(!$notif->is_seen){ echo 'warning'; } ?>" onclick="location.href='<?php echo $link?>';" style="cursor:pointer" >
            <td><img width="40px" src="<?php echo $notif->photo; ?>"></td>
            <td><p><?php echo "<b>$notif->name</b> $notif->description <b>$notif->title</b" ?></p></td>
            <td><p class="label label-default"><?php echo date('d M Y h:i A', strtotime($notif->notif_date)); ?></p></td>
	</tr>
        <?php } ?>
    </table>
    
    
    
</div>
</div>
</div>