<?php


//$inputVal = file_get_contents('php://input');
//$results = json_decode($inputVal, true);

include '../common/SqlConnection.php';
$BusinessUnit=$_POST['BusinessUnit'];
$AccountGroup = $_POST['AccountGroup'];
$AssignedSalesExecCode= $_POST['AssignedSalesExecCode'];
$AsOnDate=$_POST['AsOnDate'];

if (($AccountGroup != "ALL") && ($AssignedSalesExecCode == "ALL")){ 
        $sql = "SELECT d.BusinessUnit, m.AccountGroup, d.Particulars, m.AssignedSalesExecCode,
        SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,DebitAmount,0)) AS Amt30, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,1,NULL)) AS Dy30,
        SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,DebitAmount,0)) AS Amt90, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,1,NULL)) AS Dy90,
        SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,DebitAmount,0)) AS Amt120, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,1,NULL)) AS Dy120,
        SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,DebitAmount,0)) AS Amt365, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,1,NULL)) AS Dy365
    FROM oceangroup.daybookstaging d JOIN oceangroup.mappingtable m on  m.Dealers = d.particulars WHERE d.VoucherType = 'Cheque Return' GROUP BY Particulars ,d.BusinessUnit,m.AccountGroup, m.AssignedSalesExecCode HAVING d.BusinessUnit = '" . $BusinessUnit . "' and  m.AccountGroup= '" . $AccountGroup . "'";
      }
else if (($AccountGroup != "ALL") && ($AssignedSalesExecCode != "ALL")){ 
    $sql = "SELECT d.BusinessUnit, m.AccountGroup, d.Particulars, m.AssignedSalesExecCode,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,DebitAmount,0)) AS Amt30, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,1,NULL)) AS Dy30,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,DebitAmount,0)) AS Amt90, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,1,NULL)) AS Dy90,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,DebitAmount,0)) AS Amt120, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,1,NULL)) AS Dy120,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,DebitAmount,0)) AS Amt365, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,1,NULL)) AS Dy365
    FROM oceangroup.daybookstaging d JOIN oceangroup.mappingtable m on  m.Dealers = d.particulars WHERE d.VoucherType = 'Cheque Return' GROUP BY Particulars ,d.BusinessUnit,m.AccountGroup,m.AssignedSalesExecCode HAVING d.BusinessUnit = '" . $BusinessUnit . "' and  m.AssignedSalesExecCode = '" . $AssignedSalesExecCode . "' and  m.AccountGroup= '" . $AccountGroup . "'";
  }
else if (($AccountGroup =="ALL") && ($AssignedSalesExecCode != "ALL")){ 
    $sql = "SELECT d.BusinessUnit, m.AccountGroup, d.Particulars, m.AssignedSalesExecCode,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,DebitAmount,0)) AS Amt30, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,1,NULL)) AS Dy30,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,DebitAmount,0)) AS Amt90, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,1,NULL)) AS Dy90,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,DebitAmount,0)) AS Amt120, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,1,NULL)) AS Dy120,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,DebitAmount,0)) AS Amt365, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,1,NULL)) AS Dy365
    FROM oceangroup.daybookstaging d JOIN oceangroup.mappingtable m on  m.Dealers = d.particulars WHERE d.VoucherType = 'Cheque Return' GROUP BY Particulars ,d.BusinessUnit,m.AccountGroup,m.AssignedSalesExecCode HAVING d.BusinessUnit = '" . $BusinessUnit . "' and  m.AssignedSalesExecCode = '" . $AssignedSalesExecCode . "'";
  }

  else if (($AccountGroup =="ALL") && ($AssignedSalesExecCode == "ALL")){ 
    $sql = "SELECT d.BusinessUnit, m.AccountGroup, d.Particulars, m.AssignedSalesExecCode,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,DebitAmount,0)) AS Amt30, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 0 AND 30,1,NULL)) AS Dy30,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,DebitAmount,0)) AS Amt90, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 31 AND 90,1,NULL)) AS Dy90,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,DebitAmount,0)) AS Amt120, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 91 AND 120,1,NULL)) AS Dy120,
    SUM(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,DebitAmount,0)) AS Amt365, COUNT(IF(DATEDIFF('" . $AsOnDate . "', d.VoucherDate) BETWEEN 121 AND 366,1,NULL)) AS Dy365
    FROM oceangroup.daybookstaging d JOIN oceangroup.mappingtable m on  m.Dealers = d.particulars WHERE d.VoucherType = 'Cheque Return' GROUP BY Particulars ,d.BusinessUnit,m.AccountGroup,m.AssignedSalesExecCode HAVING d.BusinessUnit = '" . $BusinessUnit . "'";
  }
$result = $conn->query($sql);
$records = [];
if ($result->num_rows > 0) {
     while($row = mysqli_fetch_assoc($result)){
        array_push( $records, $row );
        }

    echo json_encode($records);
} else {
    echo "No Data"; //no row 
}
$conn->close();


?>