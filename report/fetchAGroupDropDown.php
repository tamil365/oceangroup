<?php


include '../common/SqlConnection.php';

$BusinessUnit = $_POST['BusinessUnit'];

  $sql = "SELECT distinct AccountGroup FROM oceangroup.mappingtable where BusinessUnit ='" . $BusinessUnit . "'";
//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
  $storeArray = Array();
    while($row = $result->fetch_array()) {
     
      $storeArray[] .= $row['AccountGroup'];
     
    }
    echo  json_encode(utf8ize($storeArray));
     
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