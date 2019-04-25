<?php



include '../common/SqlConnection.php';

$sql = "SELECT distinct SalesExecCode FROM mas_salesexecutivedetails";
$result = $conn->query($sql);
$str =  Array();
$sales_str =  Array();
if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
      $str[] .= $row['SalesExecCode'];
    }
    $sales_str = $str;
    echo json_encode($str);
}
else {
  echo "No data"; //no row 
}


$conn->close();

  
?>
