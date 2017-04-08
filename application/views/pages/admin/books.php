<?php 

function load_books(){
    $connect = mysqli_connect('localhost','root','','bookcity');
    $output='';
    $sql="SELECT * FROM books ORDER BY date_posted DESC";
    $result=mysqli_query($connect,$sql);
    while ($row= mysqli_fetch_array($result)){
        if($row['inactive']){$status='Inactive';}else{$status="Active";}
        $output .= "<tr>"
                . "<td class='col-md-3'>".$row['title']."</td>"
                . "<td class='col-md-2'>".$row['author']."</td>"
                . "<td class='col-md-1'>".$row['b_condition']."</td>"
                . "<td class='col-md-1'>".$row['method']."</td>"
                . "<td class='col-md-1'>".$row['date_posted']."</td>"
                . "<td class='col-md-1'>".$status."</td>"
                . "<td class='col-md-1'>"
                . "<a data-toggle='tooltip' title='View' class='btn btn-primary' href='". base_url().'admin/book/'.$row['book_id']."'><span class='glyphicon glyphicon-open-file'></a>"
                
                . "</td>"
                . "</tr>";
    }
    return $output;
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

<div style="margin-left: 10px;" id="page-content-wrapper">
    
    <br>
    <div class="row">
        <div class="col-md-12">
            <h1>Books</h1>
            <div class="form-group">
                <div class="col-md-4">
                    <select id="filter" onchange="getId(this.value)" name="filter" class="form-control">
                        <option value="1">All Books</option>
                        <option value="2">Active Books On Sale</option>
                        <option value="3">Active Books On Auction</option>
                        <option value="4">Inactive Books</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group stylish-input-group">
                        <input id="search" type="text" class="form-control" name='search'  placeholder="Search book title, author, genre, keywords." >
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
                    <td class='col-md-3'><b>Title</b></td>
                    <td class='col-md-2'><b>Author</b></td>
                    <td class='col-md-1'><b>Condition</b></td>
                    <td class='col-md-1'><b>Method</b></td>
                    <td class='col-md-1'><b>Date Posted</b></td>
                    <td class='col-md-1'><b>Status</b></td>
                    <td class='col-md-1'><b>Action</b></td>

                </tr>
            </table>
            <table id="books" class="table table-hover">
                <?php echo load_books(); ?>
            </table>
        </div>
        
    </div>
</div>
</div>


<script>
function getId(val){
    $.ajax({
        type:"POST",
        url:'<?php echo base_url(); ?>fetch_books.php',
        data: {
            id: val,
            base: '<?php echo base_url(); ?>'
        },
        success: function(response){
           $("#books").html(response);
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
   url:'<?php echo base_url(); ?>search_books.php',
   method:"POST",
   data:{search:query,base: '<?php echo base_url(); ?>'},
   success:function(data)
   {
    $('#books').html(data);
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

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>