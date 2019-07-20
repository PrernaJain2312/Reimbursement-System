<?php 
include 'mysqli_connect.php';
include('auth.php');

$allData = "SELECT * FROM bills ORDER BY bill_startDate DESC";
$billTypeQuery = "SELECT DISTINCT bill_type FROM bills";
$billStatusQuery = "SELECT DISTINCT status FROM bills";
$billUsernameQuery = "SELECT DISTINCT username FROM bills";
$allDataResult = mysqli_query($dbc, $allData);
$billTypeResult = mysqli_query($dbc, $billTypeQuery);
$billStatusResult = mysqli_query($dbc, $billStatusQuery);
$billUsernameResult = mysqli_query($dbc, $billUsernameQuery);
?>

<div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19); width: 1000px; margin-left: -4%" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 35px">
        View Bills
    </div>
    <div class="table-responsive">
    <table id="bill_data" class="table table-bordered table-striped">
     <thead id="billHead">
      <tr>
        <th width="5%">
           <select name="billusername" id="billusername" class="form-control" style="padding-left: 2px;width: 105px"> 
         <option value >Username</option>
         <?php 
         while($row = mysqli_fetch_array($billUsernameResult))
         {
          echo '<option value="'.$row["username"].'">'.$row["username"].'</option>';
         }
         ?>
        </select>
       </th>
       <th width="5%">
           <select name="billtype" id="billtype" class="form-control" style="width: 105px"> 
         <option value >Bill Type</option>
         <?php 
         while($row = mysqli_fetch_array($billTypeResult))
         {
          echo '<option value="'.$row["bill_type"].'">'.$row["bill_type"].'</option>';
         }
         ?>
        </select>
       </th>
       <th width="5%">
           <span style="margin-left: 15px">Start Date</span>
           <input id="startDate" type="date" name="startDate" class="form-control" style="padding-left: 2px; width: 140px; font-size: 1vw" >
       </th>
       <th width="5%">
           <span style="margin-left: 15px">End Date</span>
           <input id="endDate" type="date" name="endDate" class="form-control" style="padding-left: 2px; width: 140px; font-size: 1vw" >
       </th>
       <th width="5%">Bill Amount</th>
       <th width="5%">Attached Bill</th>
       <th width="10%"><select name="billstatus" id="billstatus" class="form-control" >
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
            <td><?php echo $row1["username"]?></td>
            <td><?php echo $row1["bill_type"]?></td>
            <td><?php echo $row1["bill_startDate"]?></td>
            <td><?php echo $row1["bill_endDate"]?></td>
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
$('#billHead').change(function() {
    var username = $('#billusername').val();
    var bill_type = $('#billtype').val();
    var bill_startDate = $('#startDate').val();
    var bill_endDate = $('#endDate').val();
    var status = $('#billstatus').val();
    
    $.ajax({
        type: "POST",
        url: "filter.php",
        data: {username: username,
               bill_type: bill_type,
               bill_startDate: bill_startDate,
               bill_endDate: bill_endDate,
               status: status
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
    <div class="card-body" style="margin-top: 15px">