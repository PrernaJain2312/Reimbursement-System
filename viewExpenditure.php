<?php 
include 'mysqli_connect.php';
include('auth.php');

$query = "SELECT * FROM bills where status='Completed' ORDER BY bill_startDate";
$sql = mysqli_query($dbc, $query);
?>


<div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19)" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 35px">
        View Total Expenditure
    </div>
    <div class="card-body" style="margin-top: 25px; margin-bottom: 5%">
        <div class="col-md-2" style="margin-left: 20%; padding-left: 3px;width: 180px">
        <input type="date" name="From" id="From" class="form-control" placeholder="From Date"/>
        </div>
        <div class="col-md-2" style="padding-left: 3px;width: 180px">
        <input type="date" name="to" id="to" class="form-control" placeholder="To Date"/>
        </div>
        <div class="col-md-8" style="width: 200px">
        <input type="button" name="range" id="range" value="Range" class="btn btn-primary btn-block"/>
        </div>
    </div>
    <br><br>
    <div class="table-responsive">
        <table id="bill_data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="10%">Username</th>
                    <th width="10%">Bill Type</th>
                    <th width="15%">Bill Start Date</th>
                    <th width="15%">Bill End Date</th>
                    <th width="10%">Amount</th>
                    <th width="30%">Attachment</th>
                    <th width="10%">Status</th>
                </tr>
            <tbody id="table_body">
            <?php 
            $sum=0;
            while($row1 = mysqli_fetch_array($sql)){
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
            <?php $sum += $row1["bill_amount"];
            }
            ?>
            <tr>
            <td colspan = '7'><b>Total Bill Amount = </b><?php echo $sum; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<!-- Script -->
<script>
$(document).ready(function(){
	$('#range').click(function(){
		var From = $('#From').val();
		var to = $('#to').val();
                console.log(From)
		if(From != '' && to != '')
		{
			$.ajax({
				url:"range.php",
				method:"POST",
				data:{From:From, to:to},
				success:function(data)
				{
					$('#table_body').html(data);
				}
			});
		}
		else
		{
			alert("Please Select the Date");
		}
	});
});
</script>
</body>
</html>