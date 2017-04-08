<?php $i=0; ?>
<?php $label='Seller'; if($method=='Auction'){$label='Auctioneer'; }  ?>
<div class="col-md-10 color-white panel panel-default">
     
    <div class="row top-buffer">
        <div class="col-md-8">
            
            <div class="col-md-4"><a href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo1  ?>"></a></div>
            
            <?php if(!empty($photo2)){ ?>
            <div class="col-md-4"><a  href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo2  ?>"></a></div>         
            <?php } ?>
            
            <?php if(!empty($photo3)){ ?>
            <div class="col-md-4"><a  href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo3  ?>"></a></div>
            <?php } ?>
        </div>
        <div class="col-md-4">
            <br><br><p class="label label-default" style="font-size:18">Method: <?php echo $method; ?></p><br><br>
            <?php if($method=="Sell"){ ?>
                <p class="label label-default" style="font-size:18">Price: Php <?php echo $price; ?></p><br><br>
                <p class="label label-default" style="font-size:18">Discount: <?php echo $discount; ?>%</p><br><br>
            <?php }else if($method=="Auction"){ ?>
                <p class="label label-default" style="font-size:18">Starting Price: Php <?php echo $start_price; ?></p><br><br>
                <p class="label label-default" style="font-size:18">Fixed Increment: Php <?php echo $fixed_increment; ?></p><br><br>
                <p class="label label-default" style="font-size:18">Highest Bidder: Php <?php echo $bid_price; ?></p><br><br>
            <?php } ?>
            
             
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <form action='<?php echo base_url(); ?>bookshelf/book/<?php echo $book_id; ?>' method='POST'>
                <a data-toggle="tooltip" title="Edit" class="btn btn-info" href='<?php echo base_url().'bookshelf/edit_book/'.$book_id; ?>'><span class='glyphicon glyphicon-edit'></a> 
                <button type="submit" name="change_photos" data-toggle="tooltip" title="Change Book Photos" class="btn btn-warning"><span class='glyphicon glyphicon-picture'></button>
                <?php if($method=='Sell'){ ?>
                <button type="submit" name="remove" data-toggle="tooltip" title="Remove" class="btn btn-danger"><span class='glyphicon glyphicon-remove'></button>
                <?php } else if($method=='Auction'){ ?>
                <a data-toggle='tooltip' title='Auction Control' class='btn btn-success' href='<?php echo site_url('/bookshelf/auction_control/'.$book_id);?>'><span class='glyphicon glyphicon-cog'></a>
                <?php if($auction_status==1 || $auction_status==2){ ?>
                <button name='remove' type=submit data-toggle='tooltip' title='Remove' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button>
                <?php }} ?>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 ">
            <p><font size="6"><?php echo $title; ?>
                <?php if($method=='Auction') { ?>
                <span class="label <?php if($auction_status==1){echo 'label-danger';}else if($auction_status==0){echo 'label-success';}else if($auction_status==2){echo 'label-warning';} ?>">
                <?php if($auction_status==1){echo 'Close';}else if($auction_status==0){echo 'Open';}else if($auction_status==2){echo 'Sold';} ?>
                        </span> 
                
                 <?php } ?>
                </font></p>
            <table class="table">
                <tr>
                    <td>Author:</td>
                    <td><?php echo $author; ?></td>
                </tr>
                <tr>
                    <td>Genre:</td>
                    <td><?php echo $genre; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-8  ">
            <label class="label label-default">Description</label><br><br>
            <p><?php echo $description; ?></p>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-8 ">
            <label class="label label-default">Details</label><br><br>
            <table class="table">
                <tr>
                    <td>Condition:</td>
                    <td><?php echo $b_condition; ?></td>
                </tr>
                <tr>
                    <td>Date Posted:</td>
                    <td><?php echo date('d M Y', strtotime($date_posted)); ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    
    <div class="row top-buffer">
        <div class="col-md-12">
            <h4>Comments & Reviews</h4>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" id="comment_form" method="post" action="<?php echo base_url().'bookshelf/post_review'; ?>">
                    <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
                    
                    <div class="form-group">
                        <label class="col-md-1 control-label" for="name"></label>
                        <div class="col-md-8">
                            <h5>Post a Comment/Review</h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label" for="name"></label>
                        <div class="col-md-8">
                            <?php if(empty($_SESSION['name'])){ ?>
                                <input placeholder="Name" class="form-control" type="text" name="name">
                            <?php } else{  ?>
                                <h5 class="text text-info"><?php  echo $_SESSION['name'];  ?></h5>
                                <input name="name" type="hidden" value="<?php echo $_SESSION['name'].' ('.$label; ?>)" >
                            <?php } ?>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-1 control-label" for="comment"></label>
                        <div class="col-md-8">
                            <textarea  placeholder="Enter your Comments/Review here..." class="form-control" rows="5" name="review"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-1">
                            <input class="btn btn-block btn-default" type="submit" value="Post" name="publish">             
                        </div>
                    </div>
                </form>
            </div>  
        </div>
        
        
        
        <div id="comments"></div><br><br>
    </div>
    <?php if (!empty($reviews)){  
        foreach($reviews as $review) {
            $created_date=date('d M Y h:i A',strtotime($review->created_date)); ?>
            <div class="row top-buffer">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text text-info"><?php echo $review->Name; ?></h4>
                            <span class="label label-default"><?php echo $created_date; ?></span><br><br>
                            <div class="row">
                                <div class="col-md-10">
                                    <span><?php echo $review->review; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($review->reply)){  
                        foreach($review->reply as $reply) {
                            $created_date=date('d M Y h:i A',strtotime($reply->created_date)); ?>
                    
                    <div class="row top-buffer">
                        <div class="col-md-1"><h5>Re:</h5></div>
                        <div class="col-md-7">
                            <h4 class="text text-info"><?php echo $reply->Name; ?></h4>
                            <span class="label label-default"><?php echo $created_date; ?></span><br><br>
                            <div class="row">
                                <div class="col-md-10">
                                    <span><?php echo $reply->reply; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php } } ?>
                    <?php $i +=1; ?>
                    <div class="row top-buffer">
                        <div class="col-md-3">
                            <a onclick="document.getElementById('reply_div<?php echo $i; ?>').style.display='';return false;" href="">Reply</a>
                        </div>
                        <div style="display:none" id="reply_div<?php echo $i; ?>"  class="col-md-4">
                            
                            <form  class="form-horizontal" id="reply_form<?php echo $i; ?>" method="post" action="<?php echo base_url().'bookshelf/post_reply'; ?>">
                                <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
                                <input name="review_id" type="hidden" value="<?php echo $review->review_id; ?>" >
                                <?php if(empty($_SESSION['name'])){ ?>
                                <div class="form-group">    
                                <input placeholder="Name" class="form-control" type="name" name="name">
                                </div>
                                <?php } else{ ?>
                                    <h5 class="text text-info"><?php  echo $_SESSION['name'];  ?></h5>
                                    <input name="name" type="hidden" value="<?php echo $_SESSION['name'].' ('.$label; ?>)" >
                                <?php } ?>
                                <div class="form-group">
                                <textarea  placeholder="Reply..." class="form-control" rows="3" name="reply"></textarea>
                                </div>
                                <div class="col-md-3 col-md-offset-9">
                                    <input class="btn btn-primary" type="submit" value="Reply" name="submit">
                                </div>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
    <?php } } ?>
    


</div>

 </div>
</div>




<div tabindex="-1" class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
    
	<div class="modal-body">
		
	</div>
	<div class="modal-footer">
		<button class="btn btn-block" data-dismiss="modal">Close</button>
	</div>
   </div>
  </div>
</div>


<script> 

$(document).ready(function() {
$('.thumbnail').click(function(){
      $('.modal-body').empty();
  	var title = $(this).parent('a').attr("title");
  	$('.modal-title').html(title);
  	$($(this).parents('div').html()).appendTo('.modal-body');
  	$('#myModal').modal({show:true});
});
});
</script>

<div id="confirm_remove" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h5 class="text text-danger center">Are you sure you want to remove <?php echo $title; ?>?</h5>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <form class="form-horizontal" action="<?php echo base_url();?>bookshelf/remove_book/<?php echo $book_id; ?>" method="POST">
                        <button class="btn btn-block" type="submit" name="yes">Yes</button><br>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-block" href="#" data-dismiss="modal">No</button><br>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                
                    
                </div>
                
        </div>
    </div>
</div>

<div id="remove_photo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h5 class="text text-danger center">Are you sure you want to remove this photo?</h5><br>
                    <center><img src="<?php echo base_url().$remove_photo; ?>" width="100px" /></center>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <form class="form-horizontal" action="<?php echo base_url();?>bookshelf/remove_photo/<?php echo $book_id; ?>" method="POST">
                            <input type="hidden" name="remove_photo" value="<?php echo $remove_photo; ?>">
                            <button class="btn btn-danger btn-block" type="submit" name="yes">Yes</button><br>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-default btn-block" href="#" data-dismiss="modal">No</button><br>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                
                    
                </div>
                
        </div>
    </div>
</div>


<div id="change_photos" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h4>Change Book Photos</h4>
                </div>
            
                <div class="modal-body">
                    <?php
                        if(!empty($err_message)){
                            echo '<div class="alert alert-danger">'.$err_message.'</div>';
                            
                        }
                        ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <center><img width="150px" src="<?php echo base_url().$photo1  ?>"></center>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <center><img width="150px" src="<?php if(!empty($photo2)){ echo base_url().$photo2; }else { echo base_url().'images/favicon.png'; }  ?>"></center>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <center><img width="150px" src="<?php if(!empty($photo3)){ echo base_url().$photo3; }else { echo base_url().'images/favicon.png'; }  ?>"></center>
                            </div>
                           
                        </div>
                    </div>
                    <?php echo form_open_multipart('bookshelf/book/'.$book_id, array('class' => 'form-horizontal', 'id'=>'change_photo_form','method'=>'post')); ?>
                    <div class="row top-buffer">
                        <div class="col-md-4">
                                <input class="form-control" accept="image/*" type="file" id="photo1" name="photo1">
                                <button type="submit" name="change_photo1" data-toggle="tooltip" title="Change Main Photo" class="btn btn-default btn-block"><span class='glyphicon glyphicon-edit'></button>
                                
                        </div>
                        <div class="col-md-4">
                                
                                <input class="form-control" accept="image/*" type="file" id="photo2" name="photo2">
                                <button type="submit" name="change_photo2" data-toggle="tooltip" title="Change Photo" class="btn btn-default btn-block"><span class='glyphicon glyphicon-edit'></button>
                                <?php if(!empty($photo2)){ ?>
                                <button type="submit" name="remove_photo2" data-toggle="tooltip" title="Remove Photo" class="btn btn-warning btn-block"><span class='glyphicon glyphicon-remove'></button>
                                <?php } ?>
                        </div>
                        <div class="col-md-4">
                                <input class="form-control" accept="image/*" type="file" id="photo3" name="photo3">
                                <button type="submit" name="change_photo3" data-toggle="tooltip" title="Change Photo" class="btn btn-default btn-block"><span class='glyphicon glyphicon-edit'></button>
                                <?php if(!empty($photo3)){ ?>
                                <button type="submit" name="remove_photo3" data-toggle="tooltip" title="Remove Photo" class="btn btn-warning btn-block"><span class='glyphicon glyphicon-remove'></button>
                                <?php } ?>
                        </div>
                    </div>
                 
                
                    
                </div>
            </form>
             <div class="modal-footer">
                    <center><a href="#" data-dismiss="modal">Close</a></center>
                </div>
                
        </div>
    </div>
</div>

<?php 
    if($remove){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#confirm_remove').modal('show');
        });
        </script>";
    }
?>

<?php 
    if($confirm_remove){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#remove_photo').modal('show');
        });
        </script>";
    }
?>

<?php 
    if($photos){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#change_photos').modal('show');
        });
        </script>";
    }
?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>


<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#comment_form").bootstrapValidator({
                fields :{
                    name :{
                        validators :{
                             notEmpty :{
                                 message :"Name is required"
                             },
                             stringLength: {
                                min: 6,
                                message: 'The password must be more than 6 characters'
                            }
                        }
                    },
                    review :{
                        validators :{
                            notEmpty :{
                                message :"Review is required"
                             }
                        }
                    }
                }
            });
        } );
</script>

<?php for($j=1;$j<=$i;$j++){ ?>
<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#reply_form<?php echo $j; ?>").bootstrapValidator({
                fields :{
                    name :{
                        validators :{
                             notEmpty :{
                                 message :"Name is required"
                             },
                             stringLength: {
                                min: 6,
                                message: 'The password must be more than 6 characters'
                            }
                        }
                    },
                    reply :{
                        validators :{
                            notEmpty :{
                                message :"Reply is required"
                             }
                        }
                    }
                }
            });
        } );
</script>
<?php } ?>
