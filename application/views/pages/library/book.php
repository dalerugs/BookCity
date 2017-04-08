<?php $label='Seller'; if($method=='Auction'){$label='Auctioneer'; }  ?>
<?php 

function load_reasons(){
    $connect = mysqli_connect('localhost','root','','bookcity');
    $output='';
    $sql="SELECT * FROM report_reasons ORDER BY reason";
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        $reason_id=$row['reason_id'];
        $reason=$row['reason'];
        $output .= "<option value='$reason'>$reason</option> ";
    }
    return $output;
}

?>

<?php $i=0;?>
<div class="row">
    <div class="col-md-8">
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
        <div class="col-md-10 ">
            <p><font size="6"><?php echo $title; ?> </font></p>
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
        <div class="col-md-10  ">
            <label class="label label-default">Description</label><br><br>
            <p><?php echo $description; ?></p>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-10 ">
            <label class="label label-default">Details</label><br><br>
            <table class="table">
                <tr>
                    <td>Condition:</td>
                    <td><?php echo $b_condition; ?></td>
                </tr>
                <tr>
                    <td>Location:</td>
                    <td><?php echo $city_area.', '.$city; ?></td>
                </tr>
                <tr>
                    <td>Date Posted:</td>
                    <td><?php echo date("d M Y", strtotime($date_posted));; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-10 ">
            <label class="label label-default"><?php echo $label; ?></label><br><br>
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




        <h4><?php echo $label; ?>'s Rating</h4>
<h2 style="padding-left:2.81em"><?php echo round($rating,1); ?></h2>

<form method="POST" action="<?php echo base_url(); ?>library/rate_seller">
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
    <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>" >
    <?php if(empty($_SESSION['user_id']) || $_SESSION['user_id']!=$user_id){ ?>
    &nbsp; <input type="submit" class="btn btn-warning" value="Rate <?php echo $label; ?>">
    <?php } ?>
</form>
    </div>
    
    
    <div class="col-md-4">
        <div class="row"> 
            <div class="col-md-12">
                <?php if(empty($_SESSION['user_id'])){ ?>
                <a href="#report" data-toggle="modal">Report <?php echo $label; ?></a>
                <?php }else{ if($_SESSION['user_id']!=$user_id){ ?>
                
                <a href="#report" data-toggle="modal">Report <?php echo $label; ?></a>
                <?php }} ?>
                <br><br><p class="label label-default" style="font-size:18">Method: <?php echo $method; ?></p><br><br>
                <?php if($method=="Sell"){ ?>
                    <p class="label label-default" style="font-size:18">Price: Php <?php echo $price; ?></p><br><br>
                    <?php if($discount>0){ ?>
                    <p class="label label-default" style="font-size:18">Discount: <?php echo $discount; ?>%</p><br><br>
                    <?php  } ?>
                        <?php }else if($method=="Auction"){  ?>
                    <p class="label label-default" style="font-size:18">Starting Price: Php <?php echo $start_price; ?></p><br><br>
                    <p class="label label-default" style="font-size:18">Fixed Increment: Php <?php echo $fixed_increment; ?></p><br><br>
                    <p class="label label-default" style="font-size:18">Highest Bidder: Php <?php echo $bid_price; ?></p><br><br>
                <?php ?>
                <?php if ($auction_status==1) {?>
                    <p class="label label-danger" style="font-size:18">Status: Close</p><br><br>
                <?php  }else if($auction_status==0) { ?>
                    <p class="label label-success" style="font-size:18">Status: Open</p><br><br>
                <?php  }else if($auction_status==2) { ?>
                    <p class="label label-warning" style="font-size:18">Status: Sold</p><br><br>
                <?php  }} ?>
            </div>
        </div><br>
        <?php if(!empty($_SESSION['user_id'])){ if($method=="Auction" && !$auction_status && $_SESSION['user_id']!=$user_id){ ?>
        <form id="bid_form" class="form-horizontal" method="POST" action="<?php echo base_url().'library/book/'.$book_id; ?>">
        <div class="row top-buffer">
            <div class="col-md-12">
                <p style="font-size:18" class="label label-primary">Join Bidding</p><br><br>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name"></label>
                    <div class="col-md-8">
                        <input placeholder="Name" name="b_name" type="text" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name"></label>
                    <div class="col-md-8">
                        <input placeholder="Email" name="b_email" type="text" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name"></label>
                    <div class="col-md-8">
                        <input placeholder="Contact No" name="b_contact" type="text" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <input class="btn btn-block btn-primary" type="submit" value="Join" name="join">             
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php }}else{ if($method=="Auction" && !$auction_status){ ?>
        <form id="bid_form" class="form-horizontal" method="POST" action="<?php echo base_url().'library/book/'.$book_id; ?>">
        <div class="row top-buffer">
            <div class="col-md-12">
                <p style="font-size:18" class="label label-primary">Join Bidding</p><br><br>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name"></label>
                    <div class="col-md-8">
                        <input placeholder="Name" name="b_name" type="text" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name"></label>
                    <div class="col-md-8">
                        <input placeholder="Email" name="b_email" type="text" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="name"></label>
                    <div class="col-md-8">
                        <input placeholder="Contact No" name="b_contact" type="text" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <input class="btn btn-block btn-primary" type="submit" value="Join" name="join">             
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        <?php  }} ?>
        <?php if (!empty($_SESSION['user_id'])){ if($_SESSION['user_id']!=$user_id){ ?>
        <div style="margin-top:50px" class="row">
            <div  class="col-md-12">
                <a class="btn btn-lg btn-warning" href="?message=1">Message <?php echo $label; ?></a>
            </div>
        </div>
        <?php }}else{ ?>
        <div style="margin-top:50px" class="row">
            <div  class="col-md-12">
                <a class="btn btn-lg btn-warning" href="?message=1">Message <?php echo $label; ?></a>
            </div>
        </div>
        <?php } ?>
    
    
    
    </div>
</div>
    



<div id="comments" class="row top-buffer">
        <div class="col-md-12">
            <h4>Comments & Reviews</h4>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" id="comment_form" method="post" action="<?php echo base_url().'library/post_review'; ?>">
                    <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
                    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>" >
                    <input name="title" type="hidden" value="<?php echo $title; ?>" >
                                <input name="photo" type="hidden" value="<?php echo base_url().$photo1; ?>" >
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
        
        
        
        
    </div>


    <?php     if (!empty($reviews)){  
        foreach($reviews as $review) { $i +=1;
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
                    <?php $i +=1;   ?>
                    <div class="row top-buffer">
                        <div class="col-md-3">
                            <a onclick="document.getElementById('reply_div<?php echo $i; ?>').style.display='';return false;" href="">Reply</a>
                        </div>
                        <div style="display:none" id="reply_div<?php echo $i; ?>"  class="col-md-4">
                            
                            <form  class="form-horizontal" id="reply_form<?php echo $i; ?>" method="post" action="<?php echo base_url().'library/post_reply'; ?>">
                                <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" >
                                <input name="review_id" type="hidden" value="<?php echo $review->review_id; ?>" >
                                <input name="user_id" type="hidden" value="<?php echo $user_id; ?>" >
                                <input name="title" type="hidden" value="<?php echo $title; ?>" >
                                <input name="photo" type="hidden" value="<?php echo base_url().$photo1; ?>" >
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
	<div class="modal-footer center">
		<button class="btn btn-link" data-dismiss="modal">Close</button>
	</div>
   </div>
  </div>
</div>

</div>

<?php if($confirmation){ ?>
<div id="confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text text-danger center">Confirmation Code</h3><br>
            </div>
            <div class="modal-body">
                <p class="alert alert-info">Confirmation code was sent to your email<br> 
                    <span class="text text-info">Once you close this, confirmation code will expire.</span></p><br>
                <form method="POST" id="confirm_form" action="<?php echo base_url(); ?>auction/new_bidder">
                    <input name="gen_code" type="hidden" value="<?php echo $gen_code; ?>" >
                    <input name="b_name" type="hidden" value="<?php echo $b_name; ?>"  >
                    <input name="b_email" type="hidden" value="<?php echo $b_email; ?>"  >
                    <input name="b_contact" type="hidden" value="<?php echo $b_contact; ?>" >
                    <input name="book_id" type="hidden" value="<?php echo $book_id; ?>"  >
                    <input name="auction_id" type="hidden" value="<?php echo $auction_id; ?>"  >
                <div class="row">
                    <div class="form-group form-group-lg">
                        <div class="col-md-8 col-md-offset-2">
                            <input placeholder="Enter confirmation code to proceed..." name="code" type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 center">
                            <br>
                            <input class="btn btn-primary" type="submit" value="Confirm" name="confirm">             
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer center">
                <button class="btn btn-link" data-dismiss="modal">Close</button>
            </div>    
        </div>
    </div>
</div>
<?php }?>

<div id="report" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           <form id="report_form" class="form-horizontal" action="<?php echo base_url();?>library/report_seller" method="POST">
                <div class="modal-header">
                    <h4 class="white">Report <?php echo $label; ?></h4>
                </div>
                <div class="modal-body">
                     
                    <input name="user_id" type="hidden" value="<?php echo $user_id ?>">
                    <input name="book_id" type="hidden" value="<?php echo $book_id ?>">
                    <div class="form-group">
                        <label  class="col-md-2 control-label" for="reason">Reason:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="reason" id="reason">
                                <option disabled selected value>Select Reason</option>
                                <?php echo load_reasons(); ?>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label  class="col-md-4 control-label" for="other">If others please specify:</label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="other"></label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="10" name="other"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-6">
                            <input class="btn btn-block btn-danger" type="submit" value="Report" name="add_book">             
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <center><a href="#" data-dismiss="modal">Close</a></center>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="r_success" class="modal modal-transparent fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h4 class="text text-danger">Report <?php echo $label; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h4 class="text text-success center">
                                Your report was successfully sent.
                            </h4>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">

                    <center><a href="#" data-dismiss="modal">Close</a></center>
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

<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#bid_form").bootstrapValidator({
                fields :{
                    b_name :{
                        validators :{
                             notEmpty :{
                                 message :"Name is required"
                             },
                             stringLength: {
                                min: 6,
                                message: 'Name must be more than 6 characters'
                            }
                        }
                    },
                    b_email :{
                        validators :{
                            notEmpty :{
                                message :"Email is required"
                             },
                            remote: {
                                message: "Someone was already using this email",
                                url: '<?php echo base_url().'check_bidders_email.php'; ?>',
                                data: {
                                    book_id: '<?php echo $book_id ?>'
                                },
                                type: 'POST',
                                delay: 2000
                            },
                            emailAddress: {
                                message: 'Please enter a valid email address'
                            }   
                        }
                    },
                    b_contact :{
                        validators :{
                            notEmpty :{
                                message :"Contact No is required"
                             }
                        }
                    }
                }
            });
        } );
</script>

<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#message_form").bootstrapValidator({
                fields :{
                    m_name :{
                        validators :{
                             notEmpty :{
                                 message :"Name is required"
                             },
                             stringLength: {
                                min: 6,
                                message: 'Name must be more than 6 characters'
                            }
                        }
                    },
                    m_email :{
                        validators :{
                            notEmpty :{
                                message :"Email is required"
                             },
                            remote: {
                                message: "Someone was already using this email",
                                url: '<?php echo base_url().'check_messengers_email.php'; ?>',
                                data: {
                                    user_id: '<?php echo $user_id ?>'
                                },
                                type: 'POST',
                                delay: 2000
                            },
                            emailAddress: {
                                message: 'Please enter a valid email address'
                            }   
                        }
                    },
                    m_contact :{
                        validators :{
                            notEmpty :{
                                message :"Contact No is required"
                             }
                        }
                    }
                }
            });
        } );
</script>

 <script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#confirm_form").bootstrapValidator({
                fields :{
                    code :{
                        validators :{
                            identical: {
                                field: 'gen_code',
                                message: "Code didn't match"
                            },
                            notEmpty :{
                                 message :"Enter Code"
                            }
                        }
                    },
                    gen_code :{
                        validators :{
                            notEmpty :{
                                 message :"Enter Code"
                            }
                        }
                    }
                    
                }
            });
        } );
</script>

 



<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#report_form").bootstrapValidator({
                fields :{
                    reason :{
                        validators :{
                             notEmpty :{
                                 message :"Please select reason"
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



<?php 
    if($confirmation){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#confirmation').modal('show');
        });
        </script>";
    }
?>

<?php 
    if($message){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#mes_confirmation').modal('show');
        });
        </script>";
    }
?>

<?php 
    if(isset($_GET['report'])){
        echo '<script type="text/javascript">'
              . " $(window).load(function(){
                $('#report').modal('show');
                });
                </script>";
    }
?>

<?php 
    if(isset($_GET['r_success'])){
        echo '<script type="text/javascript">'
              . " $(window).load(function(){
                $('#r_success').modal('show');
                });
                </script>";
    }
?>

<?php 
    if(isset($_GET['message'])){
        echo '<script type="text/javascript">'
              . " $(window).load(function(){
                $('#message_seller').modal('show');
                });
                </script>";
    }
?>

<div id="message_seller" class="modal modal-transparent fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <div class="modal-header">
                    <h4 class="text center">Message Seller</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form method="POST" class="form-horizontal" id="message_form">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name"></label>
                                <div class="col-md-8">
                                    <input placeholder="Name" name="m_name" type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name"></label>
                                <div class="col-md-8">
                                    <input placeholder="Email" name="m_email" type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name"></label>
                                <div class="col-md-8">
                                    <input placeholder="Contact No" name="m_contact" type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <input class="btn btn-warning btn-block" type="submit" value="Continue" name="continue">             
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">

                    <center><a href="#" data-dismiss="modal">Close</a></center>
                </div>
            
        </div>
    </div>
</div>

<?php if($message){ ?>
<div id="mes_confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text text-danger center">Confirmation Code</h3><br>
            </div>
            <div class="modal-body">
                <p class="alert alert-info">Confirmation code was sent to your email<br> 
                    <span class="text text-info">Once you close this, confirmation code will expire.</span></p><br>
                <form method="POST" id="messageForm" action="<?php echo base_url(); ?>library/new_messenger">
                    <input name="gen_code" type="hidden" value="<?php echo $m_gen_code; ?>" >
                    <input name="m_name" type="hidden" value="<?php echo $m_name; ?>"  >
                    <input name="email" type="hidden" value="<?php echo $m_email; ?>"  >
                    <input name="contact_number" type="hidden" value="<?php echo $m_contact; ?>" >
                    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>"  >
                    <input name="seller_name" type="hidden" value="<?php echo $first_name.' '.$last_name; ?>"  >
                    
                <div class="row">
                    <div class="form-group form-group-lg">
                        <div class="col-md-8 col-md-offset-2">
                            <input placeholder="Enter confirmation code to proceed..." name="code" type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 center">
                            <br>
                            <input class="btn btn-primary" type="submit" value="Confirm" name="confirm">             
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer center">
                <button class="btn btn-link" data-dismiss="modal">Close</button>
            </div>    
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#messageForm").bootstrapValidator({
                fields :{
                    code :{
                        validators :{
                            identical: {
                                field: 'gen_code',
                                message: "Code didn't match"
                            },
                            notEmpty :{
                                 message :"Enter Code"
                            }
                        }
                    },
                    gen_code :{
                        validators :{
                            notEmpty :{
                                 message :"Enter Code"
                            }
                        }
                    }
                    
                }
            });
        } );
</script>