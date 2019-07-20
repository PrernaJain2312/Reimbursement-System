<?php
// Range.php
include 'mysqli_connect.php';
include('auth.php');

if(isset($_POST["From"], $_POST["to"]))
{
	$query = "SELECT * FROM bills WHERE (status='Completed' && bill_startDate>= '".$_POST["From"]."' && bill_endDate<='".$_POST["to"]."') order by bill_startDate desc";
	$sql = mysqli_query($dbc, $query);
	
	if(mysqli_num_rows($sql) > 0)
	{   $sum=0;
            while($row1 = mysqli_fetch_array($sql)){
                $imageURL = "uploads/".$row1["bill_proof"];
                echo "<tr>";
                echo "<td>" . $row1["username"]. "</td>";
                echo "<td>" . $row1["bill_type"]. "</td>";
                echo "<td>" . $row1["bill_startDate"]. "</td>";  
                echo "<td>" . $row1["bill_endDate"]. "</td>";     
                echo "<td>" . $row1["bill_amount"]. "</td>";      
                echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
                echo "<td>" . $row1["status"]. "</td>";
                echo "</tr>";
                $sum += $row1["bill_amount"];
            }
            echo "<tr>";
            echo "<td colspan = '7'>" . '<b>Total Bill Amount = </b>'.$sum. "</td>";
            echo "</tr>";
	}else
	{
            echo "<tr>";
            echo "<td colspan='7' style='color:red; text-align:center'>"."No Bill to show"."</td>";
            echo "</tr>";
	}
}
?>