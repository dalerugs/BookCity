<div class="col-md-10 color-white panel panel-default">
    <div class="row top-buffer">
        <div class="col-md-6">
            <p>
                <font size="6">
                    <?php echo $book['title']; ?> 
                <span class="label <?php if($book['auction_status']==1){echo 'label-danger';}else if($book['auction_status']==0){echo 'label-success';}else if($book['auction_status']==2){echo 'label-warning';} ?>">
                    <?php if($book['auction_status']==1){echo 'Close';}else if($book['auction_status']==0){echo 'Open';}else if($book['auction_status']==2){echo 'Sold';} ?>
                </span> 
                </font>
            </p>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
        <form method="GET">
            <input <?php if($book['auction_status']==0){echo 'disabled';} ?> name="action" type="submit" value="OPEN" class="btn btn-success btn-lg">
            <input <?php if($book['auction_status']==1){echo 'disabled';} ?> name="action" type="submit" value="CLOSE" class="btn btn-danger btn-lg">
            <input <?php if($book['auction_status']==1){echo 'disabled';} ?> name="action" type="submit" value="SOLD" class="btn btn-warning btn-lg">
        </form>
        </div>
    </div>
    <div class="row top-buffer">
        <div class="col-md-12">
            <div class="col-md-4"><a href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$book['photo1']  ?>"></a></div>
            <?php if(!empty($book['photo2'])){ ?>
            <div class="col-md-4"><a  href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$book['photo2']  ?>"></a></div>         
            <?php } ?>

            <?php if(!empty($book['photo3'])){ ?>
            <div class="col-md-4"><a  href="#"><img class="thumbnail img-responsive" src="<?php echo base_url().$book['photo3']  ?>"></a></div>
            <?php } ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <p style="font-size:18" class="label label-default">Auction Details</p><br><br>
            <form id="change_fix" method="GET">
            <table class="table">
                <tr>
                    <td>Starting Price:</td>
                    <td>Php <?php echo $book['start_price']; ?></td>
                    <td></td>
                </tr>
                
                <tr>
                    
                    <td>Fixed Increment:</td>
                    <td>
                        <div class="form-group">
                        <input name="fixed_increment" placeholder="Php" class="form-control" type="number" step="0.1" value="<?php echo $book['fixed_increment']; ?>">
                        </div>
                        <input name="auction_id" placeholder="Php" class="form-control" type="hidden" value="<?php echo $book['auction_id']; ?>">
                    </td>
                    <td>
                        <input name="change" class="btn btn-primary btn-block" type="submit" value="Change">
                    </td>
                </tr>
                
                <tr>
                    <td>Next Bid</td>
                    <td>Php <?php echo $book['fixed_increment']+$book['bid_price']; ?></td>
                    <td></td>
                </tr>
            </table>
                </form>
        </div>
        <div class="col-md-6">
            <p style="font-size:18" class="label label-default">Highest Bidder</p><br><br>
             <table class="table">
                <tr>
                    <td>Highest Bidder:</td>
                    <td>
                        <?php echo $book['highest_bidder']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Bid Price:</td>
                    <td>Php <?php echo $book['bid_price']; ?></td>
                </tr>
            </table>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <p style="font-size:18" class="label label-default">Bidders</p><br><br>
            <div class="table-responsive">
            <table class="table table-hover table-fixed">
                <thead>
                    <tr>
                        <th class="col-md-1 center">Name</th>
                        <th class="col-md-5 center">Contact No</th>
                        <th class="col-md-4 center">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bidders as $bidder){ ?>
                    <tr>
                        <td class="col-md-5"><?php echo $bidder->name; ?></td>
                        <td class="col-md-5"><?php echo $bidder->contact_no; ?></td>
                        <td class="col-md-5"><?php echo $bidder->email; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
                 
            </div>
        </div>
        <div class="col-md-6">
            <p style="font-size:18" class="label label-default">Bidding Log</p><br><br>
            <table class="table table-hover table-fixed">
                <thead>
                    <tr>
                        <th class="col-md-5">Name</th>
                        <th class="col-md-3">Bid Price</th>
                        <th class="col-md-2">Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($bidding_log as $bid){ ?>
                    <tr class="<?php if($i==1){ echo 'info'; }?>">
                            <td class="col-md-5"><?php echo $bid->name; ?></td>
                            <td class="col-md-3">Php <?php echo $bid->bid_price; ?></td>
                            <td class="col-md-2"><?php echo $date_posted=date('m/d/y h:i A ',strtotime($bid->bid_date)); ?></td>
                        </tr>
                    <?php $i+=1; } ?>
                </tbody>
            </table>
        </div>
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

<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#change_fix").bootstrapValidator({
                fields :{
                    fixed_increment :{
                        validators:{
                            notEmpty:{
                                message:"Please enter fixed increment"
                            },
                            greaterThan: {
                            value: 1,
                            message: 'Fixed Increment must be greater than 0'
                            }
                        }
                    },
                    auction_id :{
                        notEmpty :{
                                 message :""
                             }
                    }
                    
                }
            });
        } );
    
 </script>
 
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