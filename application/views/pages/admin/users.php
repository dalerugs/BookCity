<?php 

function load_users(){
    $connect = mysqli_connect('localhost','root','','bookcity');
    $output='';
    $sql="SELECT * FROM users ORDER BY last_name asc";
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        if($row['inactive']){$status='Inactive'; 
            $link="<a data-toggle='tooltip' title='Activate' class='btn btn-success' href='". "?ac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-plus'></a>";
        }else{$status="Active";
            $link="<a data-toggle='tooltip' title='Deactivate' class='btn btn-danger' href='". "?deac=1&id=".$row['user_id']."'><span class='glyphicon glyphicon-minus'></a>";
        }
        $output .= "<tr>"
                . "<td class='col-md-3'>".$row['last_name'].', '.$row['first_name']."</td>"
                . "<td class='col-md-2'>".$row['username']."</td>"
                . "<td class='col-md-2'>".$row['email_address']."</td>"
                . "<td class='col-md-2'>".$row['contact_number']."</td>"
                . "<td class='col-md-2'>".$status."</td>"
                . "<td class='col-md-1'>"
                . $link
                . "</td>"
                . "</tr>";
    }
    return $output;
}

?>


<br><br>

<div class="row">
    <div class="col-md-12">
        <h1>Users</h1>
        <div class="form-group">
            <div class="col-md-4">
                <select id="filter" onchange="getId(this.value)" name="filter" class="form-control">
                    <option value="1">All Users</option>
                    <option value="2">Active Users</option>
                    <option value="3">Inactive Users </option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group stylish-input-group">
                    <input id="search" type="text" class="form-control" name='search'  placeholder="Search..." >
                    <span class="input-group-addon">
                        <button name='submit' type="submit"><span class="glyphicon glyphicon-search"></span></button>  
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table style="margin-top: 15px" class="table">
            <tr>
                <td class='col-md-3'><b>Name</b></td>
                <td class='col-md-2'><b>Username</b></td>
                <td class='col-md-2'><b>Email</b></td>
                <td class='col-md-2'><b>Contact No.</b></td>
                <td class='col-md-2'><b>Status</b></td>
                <td class='col-md-1'><b>Action</b></td>

            </tr>
        </table>
        <table id="users" class="table table-hover">
            <?php echo load_users(); ?>
        </table>
    </div>
</div>




</div>
</div>

<div id="deac_account" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="text text-danger">Are you sure you want to deactivate this account?</h5></center><br>
            </div>
            <div class="modal-body">
                <div class="col-md-2 col-md-offset-4">
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/deac_user/".$_GET['id']; ?>'>YES</a>
                </div>
                <div class="col-md-2">
                    <button data-toggle='tooltip' title='NO' class='btn btn-danger btn-block' data-dismiss="modal">NO</button>
                </div>
                <br><br>
            </div>
            <div style="text-align: center" class="modal-footer">
            </div>    
        </div>
    </div>
</div>

<?php 
    if(isset($_GET['deac'])){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#deac_account').modal('show');
        });
        </script>";
    }
?>

<div id="ac_account" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="text text-danger">Are you sure you want to activate this account?</h5></center><br>
            </div>
            <div class="modal-body">
                <div class="col-md-2 col-md-offset-4">
                    <a data-toggle='tooltip' title='YES' class='btn btn-success btn-block' href='<?php echo base_url()."admin/ac_user/".$_GET['id']; ?>'>YES</a>
                </div>
                <div class="col-md-2">
                    <button data-toggle='tooltip' title='NO' class='btn btn-danger btn-block' data-dismiss="modal">NO</button>
                </div>
                <br><br>
            </div>
            <div style="text-align: center" class="modal-footer">
            </div>    
        </div>
    </div>
</div>

<?php 
    if(isset($_GET['ac'])){
    echo '<script type="text/javascript">'
        . " $(window).load(function(){
        $('#ac_account').modal('show');
        });
        </script>";
    }
?>

<style>
    .stylish-input-group .input-group-addon{
    background: white !important; 
}
.stylish-input-group .form-control{
	border-right:0; 
	box-shadow:0 0 0; 
	border-color:#ccc;
}
.stylish-input-group button{
    border:0;
    background:transparent;
}
</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<script>
function getId(val){
    $.ajax({
        type:"POST",
        url:'<?php echo base_url(); ?>fetch_users.php',
        data: {
            id: val,
            base: '<?php echo base_url(); ?>'
        },
        success: function(response){
           $("#users").html(response);
    }
    });
}
</script>

<script>
    $(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:'<?php echo base_url(); ?>search_users.php',
   method:"POST",
   data:{search:query,base: '<?php echo base_url(); ?>'},
   success:function(data)
   {
    $('#users').html(data);
   }
  });
 }
 $('#search').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data(search);
  }
 });
});
</script>