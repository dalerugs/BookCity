

<div class="col-md-10 color-white panel panel-default">
    <h4>Add Book</h4><br>
    <?php if($is_confirmed){ ?>
        <?php echo form_open_multipart('bookshelf/add_book_action', array('class' => 'form-horizontal', 'id'=>'add_form','method'=>'post')); ?>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2 control-label" for="title">Book Title</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="author">Author</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="author">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="genre">Genre</label>
                <div class="col-md-4">
                    <select class="form-control" name="genre">
                        <option disabled selected value>Select Genre</option>
                        <?php 

                            foreach($genres as $row)
                            { 
                                echo '<option value="'.$row->genre.'">'.$row->genre.'</option>';
                            }
                        ?>
                        <option value='Others'>Others</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="description">Description</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="10" name="description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="photo">Upload Photo</label>
                <div class="col-md-4">
                    
                    <input class="form-control" accept="image/*" type="file" id="photo1" name="photo1">
                    <p class="alert alert-info">This will be the main photo.</p>
                    <input class="form-control" accept="image/*" type="file" id="photo2" name="photo2">
                    <input class="form-control" accept="image/*" type="file" id="photo3" name="photo3">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="b_condition">Condition</label>
                <div class="col-md-4">
                    <select class="form-control" name="b_condition">
                        <option disabled selected value>Select Condition</option>
                        <option value="2nd Hand (Used)">2nd Hand (Used)</option>
                        <option value="Brand New">Brand new</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="method">Method</label>
                <div class="col-md-4">
                    <div class="btn-group" >
                        <label class="btn btn-default" >
                            <input id="op_sell" type="radio" name="method" value="Sell"  >
                            Sell
                        </label>
                        <label class="btn btn-default  ">
                            <input id="op_auction" type="radio" name="method" value="Auction">
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
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="price">Price</label>
                    <div class="col-md-4">
                        <input step="0.1"  class="form-control" type="number" placeholder="Php" name="price">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="discount">Discount</label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" placeholder="%" name="discount">
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
                    <div class="col-md-6">
                        <p class="alert alert-info">Once you post this book, bidding will be officially open.</p>
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="start_price">Starting Price</label>
                    <div class="col-md-4">
                        <input step="0.1" class="form-control" type="number" placeholder="Php" name="start_price">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-md-2 control-label" for="fixed_increment">Fixed Increment</label>
                    <div class="col-md-4">
                        <input step="0.1" class="form-control" type="number" placeholder="Php" name="fixed_increment">
                    </div>
                </div>
                
            </div>
            
            <div class="form-group">
                <div class="col-md-4 col-md-offset-2">
                    <input class="btn btn-block btn-default" type="submit" value="Add Book" name="add_book">             
                </div>
            </div>
            
        </div>
    
    </form>
    <?php }else{ ?>
    
    <div class="row">
        <div class="col-md-12">
            <h5 style="margin: 0px" class="alert alert-danger center">Confirm your email to add book</h5>
        </div>
    </div>
    <?php } ?>
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
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields :{
                    title :{
                        validators :{
                             notEmpty :{
                                 message :"Please Enter title"
                             }
                        }
                    },
                    author :{
                        validators :{
                             notEmpty :{
                                 message :"Please Enter author"
                             }
                        }
                    },
                    genre :{
                        validators :{
                            notEmpty :{
                                 message :"Please Select Genre"
                             }
                        }
                    },
                    description :{
                        validators :{
                            notEmpty: {
                                message: "Please Enter Description"
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
                                message: "Please Upload main photo"
                            }
                        }
                    },
                    b_condition :{
                        validators :{
                            notEmpty :{
                                 message :"Please Select condition"
                             }
                        }
                    },
                    method :{
                        validators :{
                            notEmpty :{
                                 message :"Please Select method"
                             }
                        }
                    },
                    price :{
                        validators:{
                            notEmpty:{
                                message:"Please Enter Price"
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
                                message:"Please Enter Price"
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
                                message:"Pleas enter fixed increment"
                            },
                            greaterThan: {
                            value: 1,
                            message: 'Fixed Increment must be greater than 0'
                            }
                        }
                    }
                    
                }
                
                
            });
            
    
    
    
    
    } );  
    </script>
 