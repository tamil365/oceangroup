<?php


include '../common/SqlConnection.php';

$BusinessUnit = $_POST['BusinessUnit'];
$AccountGroup = $_POST['AccountGroup'];

if ($AccountGroup=="ALL"){
  $sql = "SELECT distinct AssignedSalesExecCode FROM oceangroup.mappingtable where BusinessUnit ='" . $BusinessUnit . "'";
}
else{
$sql = "SELECT distinct AssignedSalesExecCode FROM oceangroup.mappingtable WHERE BusinessUnit ='" . $BusinessUnit . "'and AccountGroup ='" . $AccountGroup . "'";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
  $storeSExec = Array();
    while($row = $result->fetch_array()) {
     
      $storeSExec[] .= $row['AssignedSalesExecCode'];
     
    }
    echo  json_encode(utf8ize($storeSExec));
     
} else {
    echo "No data"; //no row 
}

 
$conn->close();
function utf8ize($d) {
  if (is_array($d)) {
      foreach ($d as $k => $v) {
          $d[$k] = utf8ize($v);
      }
  } else if (is_string ($d)) {
      return utf8_encode($d);
  }
  return $d;
}




?>