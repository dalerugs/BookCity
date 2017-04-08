<div class="row">
    <div class="col-md-12">
        <h3><?php echo $genre; ?></h3>
    </div>
</div>

<?php
                        if(!empty($error)){
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                            
                        }
                        ?>


<div class="row">
            
                    <?php $counter=0; $close=0; if (!empty($results)){
                        
                            foreach($results as $book) {
                               
                                ?>
       <?php if($counter%4==0){ $close=0; ?>   
    <div class="row">
        <div class="col-md-12">
            
       <?php } ?>
            
            <div onclick="location.href='<?php echo base_url().'library/book/'.$book->book_id; ?>';" style="cursor:pointer" class="col-md-3 center top-buffer div-hover">
                <div class="row"><img width='150px' height="200px" src="<?php echo base_url().$book->image_url; ?>"/></div>
                <div class="row title"><h4><?php echo $book->title; ?></h4></div>
                
                <?php if($book->method=="Sell"){ ?>
                <div class="row row-top-buffer "><label class='label label-default'><?php echo $book->method; ?> &nbsp; | &nbsp; Price: Php <?php echo $book->price; ?></label></div>
                <?php } ?>
                <?php if($book->method=="Auction"){ ?>
                <div class="row row-top-buffer "><label class='label label-default'><?php echo $book->method; ?> &nbsp; | &nbsp; Highest Bidder: Php <?php echo $book->bid_price; ?></label></div>
                <?php } ?>
                
                <div class="row row-top-buffer"><label class='label label-default'><?php echo $book->city_area.', '.$book->city; ?></label></div>
                <div class="row row-top-buffer"><label class='label label-default'>Date Posted: <?php echo date("d M Y", strtotime($book->date_posted));; ?></label></div>
            
            </div> 
            <?php $close+=1; if($close==4){ ?>         
          </div>
    </div>           
                <?php } ?>              
                    <?php $counter+=1;  } } ?>
                
        </div>

<?php if($counter%4!=0) {?>
    </div>
</div>
<?php } ?>

<?php echo $links;  ?>






</div>

 </div>
</div>


