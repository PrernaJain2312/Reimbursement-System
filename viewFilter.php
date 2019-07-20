<?php
include 'mysqli_connect.php';

if(empty($_POST['username'])){
    unset($_POST['username']);
}

if(empty($_POST['bill_type'])){
    unset($_POST['bill_type']);
}

if(empty($_POST['bill_startDate'])){
    unset($_POST['bill_startDate']);
}
if(empty($_POST['bill_endDate'])){
    unset($_POST['bill_endDate']);
}

if(empty($_POST['status'])){
    unset($_POST['status']);
}

$query = " SELECT * FROM bills WHERE bill_amount IS NOT NULL ";
if(isset($_POST["username"]))
 {
  $username = $_POST["username"];
  $query .= "
   AND username = '".$username."'
  ";
 }
 if(isset($_POST["bill_type"]))
 {
  $bill_type = $_POST["bill_type"];
  $query .= "
   AND bill_type = '".$bill_type."'
  ";
 }
 if(isset($_POST["bill_startDate"], $_POST["bill_endDate"]) && !empty($_POST["bill_startDate"]) && !empty($_POST["bill_endDate"]))
 {
  $query .= "
   AND bill_startDate>= '".$_POST["bill_startDate"]."' AND bill_endDate<='".$_POST["bill_endDate"]."'
  ";
 }
 if(isset($_POST["status"]))
 {
  $status = $_POST["status"];
  $query .= "
   AND status = '".$status."'
  ";
 }


$result = mysqli_query($dbc, $query);

while($row1 = mysqli_fetch_array($result)){
    
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_startDate"]. "</td>";      
        echo "<td>" . $row1["bill_endDate"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        echo "</tr>";
    }
    if($result->num_rows === 0)
    {
        echo "<tr>";
        echo "<td colspan='7' style='color:red; text-align:center'>"."No Bill to show"."</td>";
        echo "</tr>";
    }
?>