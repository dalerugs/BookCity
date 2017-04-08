<?php $next_bid=$bid_price+$fixed_increment; if($bid_price==0){   $next_bid=$start_price; } ?>
<div style="margin-top:75px" class="container top-buffer color-white panel panel-default">
    <div class="row">
        <div class="col-md-12">
            <?php if($auction_status==1){ ?>
            <h5 class="alert alert-danger center">
               The bidding was closed for some reasons, contact the auctioneer for more information.
            </h5>
            <?php } ?>
            <?php if($auction_status==2){ ?>
            <?php if($is_winner){ ?>
            <h5 class="alert alert-success center">
               Congratulations you have won the bidding. The auctioneer will contact you how to get your book, if not you can report this auctioneer.
            </h5>
            <?php }else {?>
            <h5 class="alert alert-warning center">
               The book was already sold, thank you for joining.
            </h5>
            <?php }} ?>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-7">
             <a href="<?php echo base_url().'library/book/'.$book_id.'?report=1'; ?>" data-toggle="modal">Report Auctioneer</a>
            <div class="row top-buffer">
                <div class="col-md-12">
                    <div class="col-md-4"><a href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo1  ?>"></a></div>
                    <?php if(!empty($photo2)){ ?>
                    <div class="col-md-4"><a  href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo2  ?>"></a></div>         
                    <?php } ?>

                    <?php if(!empty($photo3)){ ?>
                    <div class="col-md-4"><a  href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo3  ?>"></a></div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 ">
                    <p>
                        <font size="6">
                            <?php echo $title; ?> 
                        <span class="label <?php if($auction_status==1){echo 'label-danger';}else if($auction_status==0){echo 'label-success';}else if($auction_status==2){echo 'label-warning';} ?>">
                            <?php if($auction_status==1){echo 'Close';}else if($auction_status==0){echo 'Open';}else if($auction_status==2){echo 'Sold';} ?>
                        </span> 
                        </font>
                    </p>
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
                <div class="col-md-11 ">
                    <label class="label label-default">Details</label><br><br>
                    <table class="table">
                        <tr>
                            <td>Condition:</td>
                            <td><?php echo $b_condition; ?></td>
                        </tr>
                        <tr>
                            <td>Starting Price:</td>
                            <td>Php <?php echo $start_price; ?></td>
                        </tr>
                        <tr>
                            <td>Fixed Increment:</td>
                            <td>Php <?php echo $fixed_increment; ?></td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td><?php echo $city_area.', '.$city; ?></td>
                        </tr>
                        <tr>
                            <td>Date Posted:</td>
                            <td><?php echo $date_posted; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row top-buffer">
                <div class="col-md-11 ">
                    <label class="label label-default">Auctioneer</label><br><br>
                    <table class="table">
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $first_name.' '.$last_name; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email_address; ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number:</td>
                            <td><?php echo $contact_number; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row top-buffer">
                <div class="col-md-12">
                    <h4>Auctioneer's Rating</h4>
                    <h2 style="padding-left:2.81em"><?php echo round($rating,1); ?></h2>
                    <form method="POST" action="<?php echo base_url(); ?>auction/rate_seller">
                        <span class="starRating">
                            <input id="rating5" type="radio" name="rating" value="5" <?php if(round($rating)==5){ echo 'checked'; } ?>>
                            <label for="rating5">5</label>
                            <input id="rating4" type="radio" name="rating" value="4" <?php if(round($rating)==4){ echo 'checked'; } ?>>
                            <label for="rating4">4</label>
                            <input id="rating3" type="radio" name="rating" value="3" <?php if(round($rating)==3){ echo 'checked'; } ?>>
                            <label for="rating3">3</label>
                            <input id="rating2" type="radio" name="rating" value="2" <?php if(round($rating)==2){ echo 'checked'; } ?>>
                            <label for="rating2">2</label>
                            <input id="rating1" type="radio" name="rating" value="1" <?php if(round($rating)==1){ echo 'checked'; } ?>>
                            <label for="rating1">1</label>
                        </span>
                        <input name="link" type="hidden" value="<?php echo $link; ?>" >
                        <input name="user_id" type="hidden" value="<?php echo $user_id; ?>" >
                        <?php if(empty($_SESSION['user_id']) || $_SESSION['user_id']!=$user_id){ ?>
                        &nbsp; <input type="submit" class="btn btn-warning" value="Rate Auctioneer">
                        <?php } ?>
                    </form>
                    
                </div>
            </div>
            
        </div>
        
        <div class="col-md-5">
            <div class="row top-buffer">
                <div class="col-md-11 ">
                     <p style="font-size:18" class="label label-default">My Profile</p><br><br>
                    <table class="table">
                        <tr>
                            <td>Bidder's Name:</td>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <td>Bidder ID:</td>
                            <td><?php echo $bidders_id; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td>Contact No:</td>
                            <td><?php echo $contact_no; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row top-buffer">
                <div class="col-md-11 ">
                     <p style="font-size:18" class="label label-default">Highest Bidder</p><br><br>
                    <table class="table">
                        <tr>
                            <td>Bid Price:</td>
                            <td>Php <?php echo $bid_price; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php if(!$auction_status){?>
            <div class="row top-buffer">
                <div class="col-md-11 ">
                     <p style="font-size:18" class="label label-default">Next Bid</p><br><br>
                    <table class="table">
                        <tr>
                            <td>Bid Price:</td>
                            <td>Php <?php echo $next_bid; ?></td>
                           
                            <td>
                                <form method="POST" action="<?php echo base_url().'auction/place_bid'; ?>">
                                    <input type="hidden" name="bid_price" value="<?php echo $next_bid; ?>">
                                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                                    <input type="hidden" name="bid_counter" value="<?php echo $bid_counter; ?>">
                                    <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                    <input type="hidden" name="bidders_id" value="<?php echo $bidders_id; ?>">
                                    <input type="hidden" name="link" value="<?php echo $link; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                     <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                     <input type="hidden" name="photo" value="<?php echo base_url().$photo1; ?>">
                                     <input type="hidden" name="title" value="<?php echo $title; ?>">
                                     
                                    <input class="btn btn-block btn-primary" type="submit" href="<?php echo base_url(); ?>" name="bid" value="Bid">
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php } ?>
            <div id="bidding_log" class="row top-buffer">
                <div class="col-md-11 ">
                    <p style="font-size:18" class="label label-default">Bidding Log</p><br><br>
                    <div class="table-responsive">     
                        <table class="table table-hover table-fixed">
                            <thead>
                                <tr>
                                    
                                    <th class="col-md-3 center">Bid Price</th>
                                    <th class="col-md-2 center">Date/Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($bids as $bid){ ?>
                                <tr class="<?php if($bid->bidder_id==$bidders_id){ echo 'info'; }?>">
                                        
                                        <td class="col-md-3 center">Php <?php echo $bid->bid_price; ?></td>
                                        <td class="col-md-2 center"><?php echo $date_posted=date('m/d/y h:i A ',strtotime($bid->bid_date));; ?></td>
                                    </tr>
                                <?php $i+=1; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    
    
    <div class="row top-buffer">
        <div class="col-md-12">
            <h4>Comments & Reviews</h4>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" id="comment_form" method="post" action="<?php echo base_url().'auction/post_review'; ?>">
                    <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
                    <input name="link" type="hidden" value="<?php echo $link; ?>" >
                    
                    <div class="form-group">
                        <label class="col-md-1 control-label" for="name"></label>
                        <div class="col-md-8">
                            <h5>Post a Comment/Review</h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label" for="name"></label>
                        <div class="col-md-8">
                            <h5 class="text text-info"><?php  echo $name;  ?></h5>
                            <input name="name" type="hidden" value="<?php echo $name; ?>" >
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
    </div>
    
    <?php if (!empty($reviews)){  
        foreach($reviews as $review) {
            $created_date=date('m/d/Y h:i A',strtotime($review->created_date)); ?>
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
                            $created_date=date('M d, Y',strtotime($reply->created_date)); ?>
                    
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
                            <form  class="form-horizontal" id="reply_form<?php $i +=1;  echo $i; ?>" method="post" action="<?php echo base_url().'auction/post_reply'; ?>">
                                <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
                                <input name="review_id" type="hidden" value="<?php echo $review->review_id; ?>" >
                                <input name="link" type="hidden" value="<?php echo $link; ?>" >
                                <h5 class="text text-info"><?php  echo $name;  ?></h5>
                                <input name="name" type="hidden" value="<?php echo $name; ?>" >
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



<div id="welcome" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text text-danger center">Welcome</h3><br>
                </div>
                <div class="modal-body">
                    <p class="">
                        You can always go to the link below to bid and see the auction status:<br><br>
                        <a href="<?php echo $link; ?>"><?php echo $link; ?></a><br><br>
                        This link was already sent to your email.
                    </p><br>
                       
                    
                </div>
                <div class="modal-footer center">
                    <button class="btn btn-link" data-dismiss="modal">Close</button>
                </div>    
        </div>
    </div>
</div>

<div tabindex="-1" class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
    
	<div class="modal-body">
		
	</div>
	<div class="modal-footer center">
		<button class="btn btn-link" data-dismiss="modal">Close</button>
	</div>
   </div>
  </div>
</div>

<?php 
    if($is_welcome){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#welcome').modal('show');
        });
        </script>";
    }
?>

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


