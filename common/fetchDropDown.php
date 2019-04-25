<?php


include 'SqlConnection.php';
if($selectOption =="BusinessUnit")
{
    $sql = "SELECT  ID,OptionValue from mastertable where OptionType = '" . $selectOption . "'";
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $str =  " ";
        while($row = $result->fetch_assoc()) {
          $str .=  "<option>" . $row['OptionValue'] . "</option>\n";
          }
         echo $str;
    }
    else {
      echo "No data"; //no row 
    }
}
else if($selectOption =="SalesExecutiveCode" )
{
    $sql = "SELECT distinct SalesExecCode FROM mas_salesexecutivedetails";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       $str =  " ";
        while($row = $result->fetch_assoc()) {
          $str .=  "<option>" . $row['SalesExecCode'] . "</option>\n";
        }
        echo $str;
    }
    else {
      echo "No data"; //no row 
    }
}

else if($selectOption =="AccountGroup")
{
  $sql = "SELECT  OptionValue from mastertable where OptionType = '" . $selectOption . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       $str =  " ";
        while($row = $result->fetch_assoc()) {
          $str .=  "<option>" . $row['OptionValue'] . "</option>\n";
        }
        echo $str;
    }
    else {
      echo "No data"; //no row 
    }
}

else if($selectOption =="Dealers")
{
  $sql = "SELECT  OptionValue from mastertable where OptionType = '" . $selectOption . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       $str =  " ";
        while($row = $result->fetch_assoc()) {
          $str .=  "<option>" . $row['OptionValue'] . "</option>\n";
        }
        echo $str;
    }
    else {
      echo "No data"; //no row 
    }
}



$conn->close();



?>