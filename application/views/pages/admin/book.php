<?php $label='Seller'; if($method=='Auction'){$label='Auctioneer'; }  ?>
<div style="margin-left: 10px;" id="page-content-wrapper">
    <br>
    <div class="row">
        <div class="col-md-12">
            <div style="position: fixed;margin-left: 1100px">
            <a  class="label label-default" href="<?php echo base_url(); ?>admin/books"><span class="glyphicon glyphicon-chevron-left"></span>Back</a><br><br>
            </div>
            <div class="row">
            <div class="col-md-4"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo1  ?>"></div>
            <?php if(!empty($photo2)){ ?>
            <div class="col-md-4"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo2  ?>"></div>         
            <?php } ?>
            <?php if(!empty($photo3)){ ?>
            <div class="col-md-4"><img class="thumbnail img-responsive" src="<?php echo base_url().$photo3  ?>"></div>
            <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <table>
                        
                    </table>
                </div>
            </div>
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
            <label>Description</label><br><br>
            <p><?php echo $description; ?></p>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-10 ">
            <label>Details</label><br><br>
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
                    <td><?php echo date("d M Y", strtotime($date_posted)); ?></td>
                </tr>
                <tr>
                    <td>Method:</td>
                    <td><?php echo $method; ?></td>
                </tr>
                <?php if($method=='Sell'){ ?>
                <tr>
                    <td>Price:</td>
                    <td>Php <?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Discount:</td>
                    <td><?php echo $discount; ?> %</td>
                </tr>
                <?php }else if($method=="Auction"){ ?>
                <tr>
                    <td>Status:</td>
                    <td>
                        <?php if ($auction_status==1) {?>
                    <p class="label label-danger">Close</p><br><br>
                <?php  }else if($auction_status==0) { ?>
                    <p class="label label-success">Open</p><br><br>
                <?php  }else if($auction_status==2) { ?>
                    <p class="label label-warning" >Sold</p><br><br>
                <?php  } ?>
                    </td>
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
                    <td>Highest Bidder:</td>
                    <td><?php echo $highest_bidder; ?></td>
                </tr>
                <tr>
                    <td>Bid Price:</td>
                    <td>Php <?php echo $bid_price; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-10 ">
            <label ><?php echo $label; ?></label><br><br>
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
    
    <?php     if (!empty($reviews)){  ?>
        <h4>Comments & Reviews</h4>
        <?php foreach($reviews as $review) {
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
                    
                </div>
            </div>
    <?php } } ?>
    
    
</div>
</div>