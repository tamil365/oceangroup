<?php


include '../common/SqlConnection.php';

$BusinessUnit=$_POST['BusinessUnit'];
$AccountGroup=$_POST['AccountGroup'];
$Dealers= $_POST['Dealers'];
$day = $_POST['day'];
$onDate= $_POST['onDate'];

if ($day == "30")
{
  $sql= "SELECT d.BusinessUnit,l.AccountGroup,d.Particulars,d.VoucherDate,d.VoucherType,VoucherNumber,d.DebitAmount,DATEDIFF('" . $onDate . "', d.VoucherDate) AS days FROM oceangroup.daybookstaging d join oceangroup.ledgerstaging l where d.BusinessUnit ='" . $BusinessUnit . "' and d.Particulars='" . $Dealers . "' and d.VoucherType='Cheque Return' and l.PartyName=d.particulars and DATEDIFF('" . $onDate . "', d.VoucherDate)<=30";
}
elseif ($day == "90"){
  $sql = "SELECT d.BusinessUnit,l.AccountGroup,d.Particulars,d.VoucherDate,d.VoucherType,VoucherNumber,d.DebitAmount,DATEDIFF('" . $onDate . "', d.VoucherDate) AS days FROM oceangroup.daybookstaging d join oceangroup.ledgerstaging l where d.BusinessUnit ='" . $BusinessUnit . "' and d.Particulars='" . $Dealers. "'  and d.VoucherType='Cheque Return' and l.PartyName=d.particulars and DATEDIFF('" . $onDate . "', d.VoucherDate) Between 31 and 90 ";
}
elseif ($day == "120"){
    $sql = "SELECT d.BusinessUnit,l.AccountGroup,d.Particulars,d.VoucherDate,d.VoucherType,VoucherNumber,d.DebitAmount,DATEDIFF('" . $onDate . "', d.VoucherDate) AS days FROM oceangroup.daybookstaging d join oceangroup.ledgerstaging l where d.BusinessUnit ='" . $BusinessUnit . "' and d.Particulars='" . $Dealers . "' and d.VoucherType='Cheque Return' and l.PartyName=d.particulars and DATEDIFF('" . $onDate . "', d.VoucherDate) Between 91 and 120 ";
  }
elseif ($day == "365"){
    $sql = "SELECT d.BusinessUnit,l.AccountGroup,d.Particulars,d.VoucherDate,d.VoucherType,VoucherNumber,d.DebitAmount,DATEDIFF('" . $onDate . "', d.VoucherDate) AS days FROM oceangroup.daybookstaging d join oceangroup.ledgerstaging l where d.BusinessUnit ='" . $BusinessUnit . "' and d.Particulars='" . $Dealers . "' and d.VoucherType='Cheque Return' and l.PartyName=d.particulars and DATEDIFF('" . $onDate . "', d.VoucherDate) Between 121 and 366 ";
  }
//echo $sql;
$result = $conn->query($sql);

$records = [];
if ($result->num_rows > 0) {
     while($row = mysqli_fetch_assoc($result)){
        array_push( $records, $row );
        }

    echo json_encode($records);
}  else {
    echo "No data"; //no row 
}




$conn->close();


?>