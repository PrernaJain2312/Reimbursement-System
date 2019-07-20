<?php 
include 'mysqli_connect.php';
include('auth.php');

$allData = "SELECT * FROM bills WHERE status='Pending' ORDER BY bill_startDate";
$billTypeQuery = "SELECT DISTINCT bill_type FROM bills";
$billUsernameQuery = "SELECT DISTINCT username FROM bills";
$allDataResult = mysqli_query($dbc, $allData);
$billTypeResult = mysqli_query($dbc, $billTypeQuery);
$billUsernameResult = mysqli_query($dbc, $billUsernameQuery);
?>

<div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19); width: 1000px; margin-left: -4%" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 35px">
        Approve Bills
    </div>
    <div class="table-responsive">
    <table id="bill_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>
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
       <th>
           <select name="billtype" id="billtype" class="form-control" style="padding-left: 2px; width: 105px"> 
         <option value >Bill Type</option>
         <?php 
         while($row = mysqli_fetch_array($billTypeResult))
         {
          echo '<option value="'.$row["bill_type"].'">'.$row["bill_type"].'</option>';
         }
         ?>
        </select>
       </th>
       <th>Start Date</th>
       <th>End Date</th>
       <th>Bill Amount</th>
       <th>Attached Bill</th>
       <th>Status</th>
       
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
            <td><a href="approvePreview.php?id=<?php echo $row1["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#myModal">Approve/ Reject</a></td>
        </tr>
        <?php
        }
        ?>
    <div id="myModal" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content" style=" margin: auto; width: 800px; height: 600px">
                    <!-- Content will be loaded here from "remote.php" file -->
                </div>
            </div>
        </div>
    </tbody>
    </table>
   </div>
</div>

<script>
$('#billtype,#billusername').change(function () {
    var billType = $('#billtype').val();
    var billUsername= $('#billusername').val();
    $.ajax({
        type: "POST",
        url: "approveFilter.php",
        data: {billType: billType,
               billUsername: billUsername
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
<script>
$('.openBtn').on('click',function(){
    $('.modal-body').load('approvePreview.php',function(){
        $('#myModal').modal({show:true});
    });
});
</script>