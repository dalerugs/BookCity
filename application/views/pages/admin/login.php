<style>
    .center{
        text-align: center;
    }
    .top-buffer{
        margin-top: 20px
    }
</style>

<form id="admin_login" method="POST">
<div class="row" style="margin-top: 150px">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <p style="font-size: 70px;margin-bottom: 0px" class="center">Book<span style="color: #F29E20">City</span></p>
        <p style="font-size: 20px;" class="center">ADMIN LOGIN</p>
        <?php if(isset($_GET['invalid'])){ ?>
        <div class="form-group top-buffer">
            <div class="col-md-8 col-md-offset-2">
                <p class="alert alert-danger">Incorrect username or password</p>
            </div>
        </div>    
        <?php } ?>

        <div class="form-group top-buffer">
            <div class="col-md-8 col-md-offset-2">
                <input class="form-control" type="text" name="username" placeholder="Username">
            </div>
        </div><br>
        <div class="form-group top-buffer">
            <div class="col-md-8 col-md-offset-2">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
        </div><br>
        <div class="form-group top-buffer">
            <div class="col-md-8 col-md-offset-2">
                <button class=" btn btn-block btn-warning" type="submit" name="login">Login</button>
            </div>
            
        </div>
    </div>
</div>
</form>

<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#admin_login").bootstrapValidator({
                fields :{
                    username :{
                        validators :{
                            notEmpty: {
                                message: "Please enter username"
                            }
                            
                        }
                    },
                    password :{
                        validators :{
                            notEmpty: {
                                message: "Please enter password"
                            }
                            
                        }
                    }
                }
            });
        } );
    
    </script>
    