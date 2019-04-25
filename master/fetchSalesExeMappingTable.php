<?php


//$inputVal = file_get_contents('php://input');
//$results = json_decode($inputVal, true);
 
include 'fetchSalesExeCodeDrop.php';
$result2 = $str; // list of sales executives 
include '../common/SqlConnection.php';
$sql = "SELECT * from oceangroup.mappingtable";
$result = $conn->query($sql);
$records = [];
if ($result->num_rows > 0) {
     while($row = mysqli_fetch_assoc($result)){
        array_push( $records, $row );
        }
    echo json_encode(utf8ize($records));
  } 
else {
    // echo "nothing"; //no row 
    array_push( $records, 'No data' );
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