<div class="col-md-10 color-white panel panel-default">
    
    <div class="row">
        <div class="col-md-12">
            <h1 class="center">My Profile</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 center">
                    <h2><?php echo $first_name." ".$last_name; ?></h2>
                    <h4><?php echo $username; ?></h4>
                </div>
            </div>
            <div class="row top-buffer">
                <div class="col-md-12 center">
                    <table class="table table-condensed">
                        <tr>
                            <td class="center"><?php echo $sex; ?></td>
                        </tr>
                        <tr>
                            <td class="center"><?php echo date('M d, Y', strtotime($birth_date)); ?></td>
                        </tr>
                    </table>
                    <h4>Contact</h4>
                    <table class="table table-condensed">
                        <tr>
                            <td class="center"><?php echo $email_address; ?></td>
                        </tr>
                        <tr>
                            <td class="center"><?php echo $contact_number; ?></td>
                        </tr>
                    </table>
                    
                    <h4>Location</h4>
                    <table class="table table-condensed">
                        <tr>
                            <td class="center"><?php echo $city_area.', '.$city; ?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div style="margin-top: 70px" class="row">
                <div class="col-md-12 center">
                    <h4>My Stats</h4>
                    <table>
                    <table class="table table-bordered">
                        <tr>
                            <td class="col-md-10 text text-info">Total number of books uploaded:</td>
                            <td class="col-md-2"><?php echo $total_books; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-10 text text-info">Active Books on Sale:</td>
                            <td class="col-md-2"><?php echo $on_sale; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-10 text text-info">Active Books on Auction:</td>
                            <td class="col-md-2"><?php echo $on_auction; ?></td>
                        </tr>
                        
                    </table>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 center">
                    <h4>My Rating</h4>
                    <h2><?php echo round($rating,1); ?></h2>
                    <span class="starRating">
                        <input disabled="disabled" id="rating5" type="radio" name="rating" value="5" <?php if(round($rating)==5){ echo 'checked'; } ?>>
                        <label  for="rating5">5</label>
                        <input disabled="disabled" id="rating4" type="radio" name="rating" value="4" <?php if(round($rating)==4){ echo 'checked'; } ?>>
                        <label for="rating4">4</label>
                        <input disabled="disabled" id="rating3" type="radio" name="rating" value="3" <?php if(round($rating)==3){ echo 'checked'; } ?>>
                        <label for="rating3">3</label>
                        <input disabled="disabled" id="rating2" type="radio" name="rating" value="2" <?php if(round($rating)==2){ echo 'checked'; } ?>>
                        <label for="rating2">2</label>
                        <input disabled="disabled" id="rating1" type="radio" name="rating" value="1" <?php if(round($rating)==1){ echo 'checked'; } ?>>
                        <label for="rating1">1</label>
                    </span>
                </div>
            </div>
        </div>
        
    </div>
                    
                    
                    </div>
                    
                </div>
            </div>