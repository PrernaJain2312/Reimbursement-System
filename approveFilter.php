<?php 
include 'mysqli_connect.php';
include('auth.php');

if(empty($_POST['billUsername'])){
    unset($_POST['billUsername']);
}

if(empty($_POST['billType'])){
    unset($_POST['billType']);
}

if (isset($_POST['billUsername']) && isset($_POST['billType']) ) {
    $q1 = $_POST['billUsername']; // $_POST['selectData'] is the selected value
    $q2 = $_POST['billType']; 
    $allData = "SELECT * FROM bills WHERE (username='".$q1."' && bill_type='".$q2."' && status='Pending') ORDER BY bill_startDate";
    $allDataResult = mysqli_query($dbc, $allData);
    
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["username"]. "</td>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_startDate"]. "</td>";      
        echo "<td>" . $row1["bill_endDate"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        ?>
        <td><a href="approve.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Approve</a></td>
        <td><a href="decline.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Reject</a></td>
        <?php
        echo "</tr>";
    }
    
    if($allDataResult->num_rows === 0)
    {
        echo "<tr>";
        echo "<td colspan='7' style='color:red; text-align:center'>"."No Bill to show"."</td>";
        echo "</tr>";
    }
}elseif (isset($_POST['billUsername'])){
    $q = $_POST['billUsername']; // $_POST['selectData'] is the selected value
    $allData = "SELECT * FROM bills WHERE (username='".$q."' && status='Pending') ORDER BY bill_startDate";
    $allDataResult = mysqli_query($dbc, $allData);
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["username"]. "</td>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_startDate"]. "</td>";      
        echo "<td>" . $row1["bill_endDate"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        ?>
        <td><a href="approve.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Approve</a></td>
        <td><a href="decline.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Reject</a></td>
        <?php
        echo "</tr>";
    }
    if($allDataResult->num_rows === 0)
    {
        echo "<tr>";
        echo "<td colspan='7' style='color:red; text-align:center'>"."No Bill to show"."</td>";
        echo "</tr>";
    }
} elseif (isset($_POST['billType'])){
    $q = $_POST['billType']; // $_POST['selectData'] is the selected value
    $allData = "SELECT * FROM bills WHERE (bill_type='".$q."' && status='Pending') ORDER BY bill_startDate";
    $allDataResult = mysqli_query($dbc, $allData);
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["username"]. "</td>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_startDate"]. "</td>";      
        echo "<td>" . $row1["bill_endDate"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        ?>
        <td><a href="approve.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Approve</a></td>
        <td><a href="decline.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Reject</a></td>
        <?php
        echo "</tr>";
    }
    if($allDataResult->num_rows === 0)
    {
        echo "<tr>";
        echo "<td colspan='7' style='color:red; text-align:center'>"."No Bill to show"."</td>";
        echo "</tr>";
    }
} else{
    $allData = "SELECT * FROM bills WHERE status='Pending' ORDER BY bill_startDate";
    $allDataResult = mysqli_query($dbc, $allData);
    while($row1 = mysqli_fetch_array($allDataResult)){
        $imageURL = "uploads/".$row1["bill_proof"];
        echo "<tr>";
        echo "<td>" . $row1["username"]. "</td>";
        echo "<td>" . $row1["bill_type"]. "</td>";
        echo "<td>" . $row1["bill_startDate"]. "</td>";      
        echo "<td>" . $row1["bill_endDate"]. "</td>";      
        echo "<td>" . $row1["bill_amount"]. "</td>";      
        echo "<td>" . "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" . "</td>";       
        echo "<td>" . $row1["status"]. "</td>";
        ?>
        <td><a href="approve.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Approve</a></td>
        <td><a href="decline.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Reject</a></td>
        <?php
        echo "</tr>";
    }
}