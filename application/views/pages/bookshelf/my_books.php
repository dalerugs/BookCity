<div class="col-md-10 color-white panel panel-default">
    <div class="row top-buffer">
        <div class="col-md-2 "></div>
        <form action="<?php echo base_url()."bookshelf/my_books" ?>" method="POST">
       <div class="col-md-6 ">
           
            <div class="input-group stylish-input-group">
                <input value="<?php echo $keyword; ?>" type="text" class="form-control" name='keyword'  placeholder="Search book title..." >
                <span class="input-group-addon">
                    <button name='search' type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>  
                </span>
            </div>
               
        </div>
        <div class="col-md-4">
             <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default" data-toggle="dropdown">
                        <span>Filter by </span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a><button name='all' class="btn btn-link btn-block" type="submit">All</button></a></li>
                      <li><a><button name='auction' class="btn btn-link btn-block" type="submit">Auction</button></a></li>
                      <li><a><button name='sell' class="btn btn-link btn-block" type="submit">Sell</button></a></li>
                    </ul>
                </div>
        </div>
        </form>
    </div>
    
    <div class="row top-buffer">
        <div class="col-md-12">
            <?php
                        if(!empty($error)){
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                            
                        }
                        ?>
            <div class="table-responsive">
            <table class="table table-hover">
                <?php
                $url= base_url();
                if (!empty($results)){
                    foreach($results as $book) {
                        $date_posted=date('M d, Y',strtotime($book->date_posted)); ?>
                        <tr>
                        <td><form action=<?php echo $url."bookshelf/my_books" ?> method='POST'>
                                <p class='label label-default'><?php echo $book->method; ?></p><?php if($book->method=='Sell'){ ?></br></br><?php } ?>
                                <?php if($book->method=='Auction'){if($book->auction_status==1){ ?>
                                <p class='label label-danger'>Close</p></br></br>
                                <?php }else if($book->auction_status==0) { ?>
                                <p class='label label-success'>Open</p></br></br>
                                <?php }else if($book->auction_status==2) { ?>
                                <p class='label label-warning'>Sold</p></br></br>
                                <?php }} ?>
                                <p class='label label-default'>Date Posted: <?php echo $date_posted; ?></p></br> </br>
                                <a data-toggle='tooltip' title='View' class='btn btn-primary' href='<?php echo site_url('/bookshelf/book/'.$book->book_id);?>'><span class='glyphicon glyphicon-open-file'></a>
                                <a data-toggle='tooltip' title='Edit' class='btn btn-info' href='<?php echo site_url('/bookshelf/edit_book/'.$book->book_id); ?>'><span class='glyphicon glyphicon-edit'></a>
                                <input type="hidden" name="book_id" value="<?php echo $book->book_id;?>">
                                <?php if($book->method=='Sell'){ ?>
                                <button name='remove' type=submit data-toggle='tooltip' title='Remove' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button>
                                <?php } else if($book->method=='Auction'){ ?>
                                <a data-toggle='tooltip' title='Auction Control' class='btn btn-success' href='<?php echo site_url('/bookshelf/auction_control/'.$book->book_id);?>'><span class='glyphicon glyphicon-cog'></a>
                                <?php if($book->auction_status==1 || $book->auction_status==2 ){ ?>
                                <button name='remove' type=submit data-toggle='tooltip' title='Remove' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button>
                                
                                <?php }} ?>
                            </form>
                                </td>
                        <td><?php echo $book->title; ?></td>
                        <td><?php echo $book->author; ?></td>
                        <td><?php echo $book->genre; ?></td>
                        <td><img width='100px' src='<?php echo base_url().$book->image_url;?>'/></td>
                                </tr>
                 <?php       
                    }
                    }
                ?>
            </table>
                </div>
            <?php echo $links;  ?>
        </div>
    </div>
    
</div>

 </div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
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

<?php 
    if($remove){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#confirm_remove').modal('show');
        });
        </script>";
    }
?>