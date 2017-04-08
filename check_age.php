<?php
$getbdate=$_POST['bdate'];
$bdate = date("d/m/Y", strtotime($getbdate));

  $birthDate = explode("/", $bdate);
  
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));

  if($age<18){
      $valid = false;
  }
  else{
      $valid = true;
  }
  
  echo json_encode(array(
    'valid' => $valid,
));

?>
