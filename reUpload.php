<?php
include 'mysqli_connect.php';
session_start();

$id=$_REQUEST['id'];
$query = "SELECT * from bills where bill_id='".$id."' && username='".$_SESSION['login_user']."'"; 
$result = mysqli_query($dbc, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SSPL Bill Reimbursement System</title>

        <link rel="stylesheet" href="StyleSheet.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                // Set trigger and container variables
                var trigger = $('#panel li a'),
                    container = $('#content');

                // Fire on click
                trigger.on('click', function(){
                  // Set $this for re-use. Set target from data attribute
                  var $this = $(this),
                    target = $this.data('target');       

                  // Load target page into container
                  container.load(target + '.php');

                  // Stop normal link behavior
                  return false;
                });
            });
        </script>
        
        
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container" style="margin-left: 10px">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="navbar navbar-default nav" style="height:600px; margin-top: -25px; padding-top: 20px" id="panel">
                        <li class="panelItems"><a href="#" data-target="addBill"> Add Bills</a></li>
                        <li class="panelItems"><a href="#" data-target="viewBill"> View Bills</a></li>
                        <li class="panelItems"><a href="#" data-target="rejectedBill"> Manage Rejected Bills</a></li>
                    </ul>
                </div>
                <div class="col" id="content" style="width: 900px; margin-left: 30%; padding-top: 2%">
                    <div class="form">
                        <?php
                        if(isset($_POST['submit']))
                        {
                            if(empty($_REQUEST['file'])){
                                unset($_REQUEST['file']);
                            }
                            if(isset($_REQUEST['file'])){
                                $id = $_REQUEST['id'];
                                $bill_type = $_REQUEST['type'];
                                $bill_startDate = $_REQUEST['startDate'];
                                $bill_endDate = $_REQUEST['endDate'];
                                $bill_amount =$_REQUEST['amount'];
                                $bill_proof =$_REQUEST['file'];

                                $update="update bills set bill_type='".$bill_type."', bill_startDate='".$bill_startDate."',
                                bill_endDate='".$bill_endDate."', bill_amount='".$bill_amount."',
                                bill_proof='".$bill_proof."', status='Pending' where bill_id='".$id."'";
                                mysqli_query($dbc, $update) or die(mysqli_error());
                                echo "<script type='text/javascript'>alert('Bill Updated!');
                                            window.location='index.php';
                                    </script>";
                            } else {
                                echo "<script type='text/javascript'>alert('Please select the pdf!');
                                        window.location='reUpload.php?id=$id';
                                    </script>";
                            }
                        }else {
                        ?>
                        <div>
                        <form name="form" method="post" action=""> 
                            <div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19); width: 800px; margin-left: 7%" >
                            <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
                                Edit Bill Details
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
                                    <?php $imageURL = "uploads/".$row["bill_proof"]; echo "<a href='$imageURL' download>".$row["bill_proof"]."</a>" ?>
                                    <input type="file" name="file" style="width: 750px; margin-left: 25px" value="<?php echo $row['bill_proof'];?>">
                                </p>
                                <p style="width: 750px; margin: auto; padding-bottom: 25px; padding-top: 25px">
                                    <button type="submit" class="btn btn-primary btn-block" name="submit" value="Upload">Submit</button>
                                </p>
                            </div>
                        </form>
                        <?php } ?>
                        </div>
                    </div>
                        <p style="color: red; margin-left: 7%">* Upload the bill again</p>
                </div>
            </div>
        </div>
    </body>
</html>

