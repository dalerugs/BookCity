<?php
$get_end_date=strtotime($_POST['end_date']);
//$get_end_date='02/8/2017';
$end_date = date("d/m/Y", strtotime($get_end_date));

 
  

  if($get_end_date<=strtotime(date('Y-m-d'))){
      $valid = false;
  }
  else{
      $valid = true;
  }
  
  echo json_encode(array(
    'valid' => $valid,
));

?>
