<?php


//$inputVal = file_get_contents('php://input');
//$results = json_decode($inputVal, true);

include '../common/SqlConnection.php';

$sql ="UPDATE mappingtable SET AssignedSalesExecCode ='".$_POST["NewAssignedSalesExecCode"]."' WHERE Businessunit = '".$_POST["BusinessUnit"]."' && AccountGroup ='".$_POST["AccountGroup"]."' && Dealers ='".$_POST["Dealers"]."' && AssignedSalesExecCode='".$_POST["OldAssignedSalesExecCode"]."' ";
$result = $conn->query($sql);
if ($result === TRUE) {
     echo "Updated";
} else {
    echo "Not Updated"; //no row 
}
$conn->close();

  
?>