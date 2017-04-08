
<?php if(current_url()== base_url().'library/home'){?>
<div style="margin-top:75px" class="container">
	<div class="row">
		<!-- Carousel -->
    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
			    <div class="item active">
			    	<img src="<?php echo base_url(); ?>images/slide1.jpg" alt="First slide">
                    <!-- Static Header -->
                                <div class="header-text hidden-xs">
                                    <div class="col-md-12 text-center">
                                        <h2>
                                            <span><img src="<?php echo base_url(); ?>images/BookCity_Logo_slide.png" alt="First slide"></span>
                                        </h2>
                                        <?php if(empty($_SESSION['user_id'])){ ?>
                                        <h3>
                                            <span>Join us now and start selling your books.</span>
                                        </h3>
                                        <div class="">
                                            <a class="color"  href="<?php echo base_url().'library/logout?login=1'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">Login</h3></a>
                                            <a class="color"  href="<?php echo base_url().'sign_up/index'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">Register</h3></a>
                                            
                                        </div>
                                        <?php }else{ ?>
                                        <h3>
                                            <span>Start selling your books.</span>
                                        </h3>
                                        <div class="">
                                            <a class="color"  href="<?php echo base_url().'bookshelf/add_book'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">Add Book</h3></a>
                                            
                                            
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div><!-- /header-text -->
			    </div>
			    <div class="item">
                                <img src="<?php echo base_url(); ?>images/slide2.jpg" alt="Second slide">
			    	<!-- Static Header -->
                                <div class="header-text hidden-xs">
                                    <div class="col-md-12 text-center">
                                        <h2>
                                            <span>Learn About Us</span>
                                        </h2>
                                        <br>
                                        <h3>
                                                <span>Do you have some questions?</span>
                                        </h3>
                                        <br>
                                        <div class="">
                                            <a class="color"  href="<?php echo base_url().'discover_us/dis'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">Discover Us</h3></a>
                                        </div>
                                    </div>
                                </div><!-- /header-text -->
			    </div>
			    <div class="item">
			    	<img src="<?php echo base_url(); ?>images/slide3.jpg" alt="Third slide">
			    	<!-- Static Header -->
                                <div class="header-text hidden-xs">
                                    <div class="col-md-12 text-center">
                                        <h2>
                                            <span>Books for a Cause</span>
                                        </h2>
                                        <br>
                                        <h3>
                                            <span>Got old books? Donate it and Be Awesome.</span>
                                        </h3>
                                        <br>
                                        <div class="">
                                            <a class="color"  href="<?php echo base_url().'donate/be_a_donor'; ?>"><h3 class="btn-theme btn-min-block center btn btn-lg border-button">Donate Now</h3></a>
                                        </div>
                                    </div>
                                </div><!-- /header-text -->
			    </div>
			</div>
			
		</div><!-- /carousel -->
	</div>
</div>
<?php }?>
<div <?php if(current_url()!= base_url().'library/home'){ echo "style='margin-top:75px'"; }?>  class="container top-buffer">
    
            <div class="row">
                <div class="col-md-2">
                    
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4>Library</h4>
                    <ul class="nav">
                        <?php 

                            foreach($genres as $genre)
                            { 
                                echo '<li><a href="'.base_url().'library/genre/'.$genre->genre.'">'.$genre->genre.'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
                
                
                
                <div style="padding-bottom:50px" class="col-md-10 color-white padding-white-box panel panel-default">
                    
                    