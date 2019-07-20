<?php 
include 'mysqli_connect.php';
session_start(); 

$allData = "SELECT * FROM bills where username= '".$_SESSION['login_user']."' && status='Rejected' ORDER BY bill_startDate desc ";
$allDataResult = mysqli_query($dbc, $allData);
?>
<div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19)" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 35px">
        Re Upload Rejected Bills
    </div>
    <div class="table-responsive">
    <table id="bill_data" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Bill Type</th>
                <th>Bill Start Date</th>
                <th>Bill End Date</th>
                <th>Bill Amount</th>
                <th>Attachment</th>
                <th>Status</th>
            </tr>
        </thead>
    <tbody id="table_body">
       <?php
        while($row1 = mysqli_fetch_array($allDataResult)){
            $imageURL = "uploads/".$row1["bill_proof"];
            ?>
        <tr>
            <td><?php echo $row1["bill_type"]?></td>
            <td><?php echo $row1["bill_startDate"]?></td>
            <td><?php echo $row1["bill_endDate"]?></td>
            <td><?php echo $row1["bill_amount"]?></td>
            <td><?php echo "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" ?></td>
            <td><?php echo $row1["status"]?>
            <td><a href="reUpload.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm">Re Upload</a></td>
        </tr>
        <?php
        }
        ?>
   </tbody>
   </table>
  </div>
</div>