<div class="col-md-10 color-white panel panel-default">
    <h4>Edit Book</h4><br>
    
        <?php echo form_open('bookshelf/edit_book/'.$book_id, array('class' => 'form-horizontal', 'id'=>'add_form','method'=>'post')); ?>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="title" >Book Title</label>
                <div class="col-md-4">
                    <input value='<?php echo $title; ?>' class="form-control" type="text" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="author">Author</label>
                <div class="col-md-4">
                    <input value='<?php echo $author; ?>' class="form-control" type="text" name="author">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="genre">Genre</label>
                <div class="col-md-4">
                    <select class="form-control" name="genre">
                        <?php 
                            foreach($genres as $row)
                            { 
                                if($genre==$row->genre){
                                    echo '<option selected value="'.$row->genre.'">'.$row->genre.'</option>';
                                }
                                else{
                                    echo '<option value="'.$row->genre.'">'.$row->genre.'</option>';
                                }
                                
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="description">Description</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="10" name="description"><?php echo $description; ?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="b_condition">Condition</label>
                <div class="col-md-4">
                    <select class="form-control" name="b_condition">
                        <option <?php if($b_condition=='2nd Hand (Used)'){ echo "selected"; } ?> value="2nd Hand (Used)">2nd Hand (Used)</option>
                        <option <?php if($b_condition=='Brand New'){ echo "selected"; } ?> value="Brand New">Brand new</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="method">Method</label>
                <div class="col-md-4">
                    <div class="btn-group" >
                        <?php 
                            if($method=='Sell'){
                                echo "<script>"
                                . "$(document).ready(function (){ "
                                . "$('#show_sell:hidden').show('slow');"
                                        . "});"
                                        . "</script>"; 
                                
                            }
                            elseif ($method=='Auction') {
                                echo "<script>"
                                . "$(document).ready(function (){ "
                                . "$('#show_auction:hidden').show('slow');"
                                        . "});"
                                        . "</script>";
                            
                        }
                        ?>
                        <label class="btn btn-default " >
                            <input <?php if($method=='Sell'){ echo 'checked'; } ?> id="op_sell" type="radio" name="method" value="Sell"  >
                            Sell
                        </label>
                        <label class="btn btn-default ">
                            <input <?php if($method=='Auction'){ echo 'checked'; } ?> id="op_auction" type="radio" name="method" value="Auction">
                            Auction
                        </label>
                    </div>
                </div>
            </div>
            
            <div id="show_sell" style='display:none' >
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <h4>Selling Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <?php if($method=='Auction'){ ?>
                    <div class="col-md-6">
                        <p class="alert alert-danger">If you change the book method to sell, all bidding transactions will be invalid</p>
                    </div>
                    <?php } ?>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="price">Price</label>
                    <div class="col-md-4">
                        <input step="0.1" value="<?php if($method=='Sell'){ echo $price; } ?>" class="form-control" type="number" placeholder="Php" name="price">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="discount">Discount</label>
                    <div class="col-md-4">
                        <input value="<?php if($method=='Sell'){if($discount>0){ echo $discount; }} ?>" class="form-control" type="text" placeholder="%" name="discount">
                    </div>
                </div>
            </div>
            
            
            <div id="show_auction" style='display:none' >
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <h4>Auctioning Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <?php if($method=='Sell'){ ?>
                    <div class="col-md-6">
                        <p class="alert alert-info">Once you post this book, bidding will be officially open.</p>
                    </div>
                    <?php } ?>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="start_price">Starting Price</label>
                    <div class="col-md-4">
                        <input step="0.1" value="<?php if($method=='Auction'){ echo $start_price; } ?>" class="form-control" type="number" placeholder="Php" name="start_price" <?php if($method=='Auction'){ echo 'disabled'; } ?>>
                        <?php if($method=='Auction'){ ?> 
                        <input step="0.1" value="<?php if($method=='Auction'){ echo $start_price; } ?>" class="form-control" type="hidden" placeholder="Php" name="start_price">
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="fixed_increment">Fixed Increment</label>
                    <div class="col-md-4">
                        
                        <input step="0.1" value="<?php if($method=='Auction'){ echo $fixed_increment; } ?>" class="form-control" type="number" placeholder="Php" name="fixed_increment">
                    </div>
                </div>
                
            </div>
            
            <div class="form-group">
                <div class="col-md-4 col-md-offset-2">
                    <input class="btn btn-default btn-block" type="submit" value="Save Changes" name="save_changes">             
                </div>
            </div>
            
        </div>
    </form>
</div>


 </div>
</div>


 
 
 <script>
 $(document).ready(function () 
 { 
  $("#op_sell").click(function()
  {
    $("#show_sell:hidden").show('slow');
   $("#show_auction").hide();
   });
   $("#op_sell").click(function()
  {
    if($('op_sell').prop('checked')===false)
   {
    $('#show_sell').hide();
   }
  });
  
  $("#op_auction").click(function()
  {
    $("#show_auction:hidden").show('slow');
   $("#show_sell").hide();
   });
   $("#op_auction").click(function()
  {
    if($('op_auction').prop('checked')===false)
   {
    $('#show_auction').hide();
   }
  });

  
 });

 </script>
 
 
  <script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#add_form").bootstrapValidator({
                fields :{
                    title :{
                        validators :{
                             notEmpty :{
                                 message :"Enter title"
                             }
                        }
                    },
                    author :{
                        validators :{
                             notEmpty :{
                                 message :"Enter author"
                             }
                        }
                    },
                    genre :{
                        validators :{
                            notEmpty :{
                                 message :"Select Genre"
                             }
                        }
                    },
                    description :{
                        validators :{
                            notEmpty: {
                                message: "Enter Description"
                            },
                             stringLength: {
                                min: 50,
                                max: 2000,
                                message: 'Must be more than 50 and less than 2000 characters'
                            }
                        }
                    },
                    photo1 :{
                        validators :{
                            notEmpty: {
                                message: "Upload main photo"
                            }
                        }
                    },
                    b_condition :{
                        validators :{
                            notEmpty :{
                                 message :"Select condition"
                             }
                        }
                    },
                    method :{
                        validators :{
                            notEmpty :{
                                 message :"Select method"
                             }
                        }
                    },
                    price :{
                        validators:{
                            notEmpty:{
                                message:"Enter Price"
                            },
                            
                            greaterThan: {
                            value: 1,
                            message: 'Price must be greater than 0'
                            }
                        }
                    },
                    discount :{
                        validators:{
                            integer: {
                            message: 'Please enter a valid percentage'
                            },
                            between: {
                            min: 1,
                            max: 100,
                            message: 'Discount must be between 1% to 100%'
                            }
                        }
                    },
                    start_price :{
                        validators:{
                            notEmpty:{
                                message:"Enter Price"
                            },
                            
                            greaterThan: {
                            value: 1,
                            message: 'Price must be greater than 0'
                            }
                        }
                    },
                    fixed_increment :{
                        validators:{
                            notEmpty:{
                                message:"Enter Fixed Increment"
                            },
                            
                            greaterThan: {
                            value: 1,
                            message: 'Price must be greater than 0'
                            }
                        }
                    }
                    
                }
                
                
            });
            
    
    
    
    
    } );  
    </script>
 