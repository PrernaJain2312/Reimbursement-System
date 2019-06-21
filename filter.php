<?php 
include 'mysqli_connect.php';

if(empty($_POST['billType'])){
    echo "empty type";
    unset($_POST['billType']);
}

if(empty($_POST['billStatus'])){
    echo "empty type";
    unset($_POST['billStatus']);
}

if (isset($_POST['billType']) && isset($_POST['billStatus']) ) {
    $q1 = $_POST['billType']; // $_POST['selectData'] is the selected value
    $q2 = $_POST['billStatus']; 
    $allData = "SELECT * FROM bills WHERE (bill_type='".$q1."' && status='".$q2."') ORDER BY bill_date DESC";
    $allDataResult = mysqli_query($dbc, $allData);
    
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_date"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        echo "</tr>";
    }
    
    if($allDataResult->num_rows === 0)
    {
        echo "<tr>";
        echo "<td colspan='5' style='color:red; text-align:center'>"."No Bill to show"."</td>";
        echo "</tr>";
    }
   
} elseif (isset($_POST['billType'])){
    $q = $_POST['billType']; // $_POST['selectData'] is the selected value
    $allData = "SELECT * FROM bills WHERE bill_type='".$q."' ORDER BY bill_date DESC";
    $allDataResult = mysqli_query($dbc, $allData);
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_date"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        echo "</tr>";
    }
} elseif (isset($_POST['billStatus'])) {
    $q = $_POST['billStatus']; // $_POST['selectData'] is the selected value
    $allData = "SELECT * FROM bills WHERE status ='".$q."' ORDER BY bill_date DESC";
    $allDataResult = mysqli_query($dbc, $allData);
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_date"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        echo "</tr>";
    }
} 