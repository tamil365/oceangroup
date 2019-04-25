<?php


//$inputVal = file_get_contents('php://input');
//$results = json_decode($inputVal, true);

include '../common/SqlConnection.php';

//$sql ="INSERT INTO mappingtable (Businessunit, AccountGroup,Dealers,AssignedSalesExecCode) VALUES ('".$_POST["BusinessUnit"]."','".$_POST["AccountGroup"]."','".$_POST["Dealers"]."','".$_POST["AssignedSalesExecCode"]."')";
$result = $conn->query($sql);
$records = [];
if ($result->num_rows > 0) {
     while($row = mysqli_fetch_assoc($result)){
        array_push( $records, $row );
        }

    echo json_encode(utf8ize($records));
} else {
    echo "nothing"; //no row 
}
$conn->close();

  
?>