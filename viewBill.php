<?php 
include 'mysqli_connect.php';
include 'session.php';

$allData = "SELECT * FROM bills WHERE username='$login_session' ORDER BY bill_date DESC";
$billTypeQuery = "SELECT DISTINCT bill_type FROM bills";
$billStatusQuery = "SELECT DISTINCT status FROM bills";
$allDataResult = mysqli_query($dbc, $allData);
$billTypeResult = mysqli_query($dbc, $billTypeQuery);
$billStatusResult = mysqli_query($dbc, $billStatusQuery);
?>

<div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19)" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
        View Bills
    </div>
    <div class="table-responsive">
    <table id="bill_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>
           <select name="billtype" id="billtype" class="form-control"> 
         <option value >Bill Type</option>
         <?php 
         while($row = mysqli_fetch_array($billTypeResult))
         {
          echo '<option value="'.$row["bill_type"].'">'.$row["bill_type"].'</option>';
         }
         ?>
        </select>
       </th>
       <th>Bill Date</th>
       <th>Bill Amount</th>
       <th>Attached Bill</th>
       <th>
        <select name="billstatus" id="billstatus" class="form-control" >
         <option value >Status</option>
         <?php 
         while($row = mysqli_fetch_array($billStatusResult))
         {
          echo '<option value="'.$row["status"].'">'.$row["status"].'</option>';
         }
         ?>
        </select>
       </th>
      </tr>
     </thead>
    <tbody id="table_body">
        <?php
        while($row1 = mysqli_fetch_array($allDataResult)){
            $imageURL = "uploads/".$row1["bill_proof"];
            ?>
        <tr>
            <td><?php echo $row1["bill_type"]?></td>
            <td><?php echo $row1["bill_date"]?></td>
            <td><?php echo $row1["bill_amount"]?></td>
            <td><?php echo "<a href='$imageURL' download>".$row1["bill_proof"]."</a>" ?></td>
            <td><?php echo $row1["status"]?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
   </div>
</div>

<script>
    
$('#billtype,#billstatus').change(function () {
    var billType = $('#billtype').val();
    var billStatus= $('#billstatus').val();

    $.ajax({
        type: "POST",
        url: "filter.php",
        data: {billType: billType,
               billStatus: billStatus
        },
        success: function (data) {     
           $("#table_body").html(data);
        },
        error: function (xhr) {
           //Do Something to handle error
           alert("some error found");
        } 
    });
});
</script>