<?php
include 'mysqli_connect.php';
session_start();

$id=$_REQUEST['id'];
$query = "SELECT * from bills where bill_id='".$id."'"; 
$result = mysqli_query($dbc, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<form name="form" method="post" action=""> 
    <div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19); width: 800px" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
        Approve Bill
    </div>
    <div class="card-body" style="margin-top: 15px">
        <input name="id" type="hidden" value="<?php echo $row['bill_id'];?>" />
        <p><span style="margin-left: 3.5%">Select Type</span>
            <select name="type" class="form-control form-control-lg" style="width: 750px; margin-left: 25px">
                <option selected value="<?php echo $row['bill_type'];?>"><?php echo $row['bill_type'];?></option>
                <option value="mobile">Mobile</option>
                <option value="landline">Landline</option>
            </select>
        </p><br>
        <div style="margin-bottom: 10%">
            <div class="col-sm-6">
                <span style="margin-left: 3.5%">Start Date</span>
                <input type="date" name="startDate" class="form-control form-control-lg" style="width: 350px; margin-left: 10px" value="<?php echo $row['bill_startDate'];?>">
            </div>
            <div class="col-sm-6">
                <span style="margin-left: 4%">End Date</span>
                <input type="date" name="endDate" class="form-control form-control-lg" style="width: 350px; margin-left: 3%" value="<?php echo $row['bill_endDate'];?>">
            </div>
        </div>
        <p><span style="margin-left: 3.5%">Amount</span>
            <input type="text" name="amount" class="form-control form-control-lg" style="width: 750px; margin-left: 25px" value="<?php echo $row['bill_amount'];?>">
        </p>
        <p><span style="margin-left: 3.5%">Attached Proof</span>
            <?php $imageURL = "uploads/".$row["bill_proof"]; echo "<embed src='$imageURL' frameborder='0' width='99%' height='200px'>"?>
        </p>
        <div style="margin-top: 5%">
            <div class="col-sm-6"><a href="approve.php?id=<?php echo $row["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm ">Approve</a></div>
            <div class="col-sm-6"><a href="decline.php?id=<?php echo $row["bill_id"]; ?>" class="btn btn-primary btn-block btn-sm ">Reject</a></div>
        </div>
    </div>
</form>