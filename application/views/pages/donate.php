<div style="margin-top:75px" class="container top-buffer">
    
    <div class="row">
        <div class="col-md-2">
            <div style="position: fixed;">
                <h4>Donate Book</h4>
                <ul class="nav">
                    <li><a href="#books_for_a_cause">Books for a Cause</a></li>
                    <li><a href="#be_a_donor">Be A Donor</a></li>
                    <li><a href="#message_us">Message Us</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 color-white panel panel-default">
            <div id="books_for_a_cause" class="row">
                <div class="col-md-12">
                    <br><br>
                    <h3 class="center"><strong>Books for a Cause</strong></h3>
                    <p style="font-size: 18">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Books For A Cause is a BookCity project that aims to provide precious knowledge 
                        to every Filipino and increase literacy through continuous learning, especially young kids without capabilities to buy a book.
                        By donating books to Book City you can share your knowledge 
                        and experience. By this, you can help others by giving them a break to improve their own lives.
                    </p>
                </div>
            </div>
            <div id="be_a_donor" class="row">
                <div class="col-md-12">
                    <br><br>
                    <h3 class="center"><strong>Be A Donor</strong></h3>
                    <p style="font-size: 18">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Old and unused books? Why don't you make a favor to those in need and to your self 
                        as well? Donate them to BookCity! It could help most of the children and out of school
                        youth who can't afford to buy books and to schools who don't have enough supply of sources.
                        Let's make a move for the future of our next generation, just contact us by filling up the 
                        form below.
                    </p>
                </div>
            </div>
            <div id="message_us" class="row">
                <div class="col-md-12">
                    <br><br>
                    <h3 class=""><strong>Message us</strong></h3>
                    <br>
                    <form id="message_form" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="name">Name:</label>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" name="name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="email">Email:</label>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" name="email" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="con_no">Contact No:</label>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control" name="con_no" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="message">Message:</label>
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control" rows="10" name="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-5">
                                <input type="submit" name="send" value="Send" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>



<div id="success" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text text-success center">Your message was successfully sent</h3><br>
                </div>
                <div class="modal-body">
                    <p style="font-size: 18" class="center">
                        Thank you for your interest in our project "Books for A Cause".
                    </p><br>
                       
                    
                </div>
                <div class="modal-footer center">
                    <button class="btn btn-link" data-dismiss="modal">Close</button>
                </div>    
        </div>
    </div>
</div>

<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#message_form").bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields :{
                    name :{
                        validators :{
                             notEmpty :{
                                 message :"Please enter your name"
                             }
                        }
                    },
                    email :{
                        validators :{
                             notEmpty :{
                                 message :"Please enter your email"
                             }
                        }
                    },
                    con_no :{
                        validators :{
                            notEmpty :{
                                 message :"Please enter your contact no"
                             }
                        }
                    },
                    message :{
                        validators :{
                            notEmpty: {
                                message: "Please enter your message"
                            }
                        }
                    }
                    
                }
                
                
            });
            
    
    
    
    
    } );  
    </script>
    
    <?php 
    if($success){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#success').modal('show');
        });
        </script>";
    }
?>