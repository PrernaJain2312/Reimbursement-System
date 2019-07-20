<?php
include 'mysqli_connect.php';
include('auth.php');

$id=$_REQUEST['id'];
$query = "SELECT * from login where id='".$id."'"; 
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
                    <ul class="navbar navbar-default nav" style="height:600px; margin-top: -25px; padding-top: 20px; text-align: left" id="panel">
                        <li class="panelItems" id="panelItems"><a href="#" data-target="addUser"> Add Users</a></li>
                        <li class="panelItems"><a href="#" data-target="manageUser"> Manage Users</a></li>
                        <li class="panelItems"><a href="#" data-target="approveBill"> Approve Bills</a></li>
                        <li class="panelItems"><a href="#" data-target="viewBillAdmin"> View Bills</a></li>
                        <li class="panelItems"><a href="#" data-target="viewExpenditure"> View Expenditure</a></li>
                    </ul>
                </div>
                <div class="col" id="content" style="width: 900px; margin-left: 30%">
                    <div class="form">
                        <?php
                        $status = "";
                        if(isset($_POST['submit']))
                        {
                        $id=$_REQUEST['id'];
                        $username =$_REQUEST['username'];
                        $email =$_REQUEST['email'];
                        $designation =$_REQUEST['designation'];
                        $level =$_REQUEST['level'];

                        $update="update login set username='".$username."',
                        email='".$email."', designation='".$designation."',
                        level='".$level."' where id='".$id."'";
                        mysqli_query($dbc, $update) or die(mysqli_error());
                        echo "<script type='text/javascript'>alert('User Updated!');
                                    window.location='index.php';
                                </script>";
                        }else {
                        ?>
                        <div>
                        <form name="form" method="post" action=""> 
                            <div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19)" >
                            <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
                                Edit User
                            </div>
                            <div class="card-body" style="margin-top: 15px"><br>
                                <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                                <p align="center" >
                                    <span style=" font-size: 20px; font-weight: bolder">Username</span>
                                    <input type="text" name="username" class="form-control form-control-lg" style="width: 400px; margin: auto" required value="<?php echo $row['username'];?>">
                                </p>
                                <p align="center">
                                    <span style=" font-size: 20px; font-weight: bolder">Email</span>
                                    <input type="text" name="email" class="form-control form-control-lg" style="width: 400px; margin: auto" required value="<?php echo $row['email'];?>">
                                </p>
                                <p align="center">
                                    <span style=" font-size: 20px; font-weight: bolder">Designation</span>
                                    <select required  name="designation" class="form-control form-control-lg" style="width: 400px">
                                        <option selected value="<?php echo $row['designation'];?>"><?php echo $row['designation'];?></option>
                                        <option value="Scientist">Scientist</option>
                                        <option value="Technical Officer">Technical Officer</option>
                                    </select>
                                </p>
                                <p align="center">
                                    <span style=" font-size: 20px; font-weight: bolder">Level</span>
                                    <select required  name="level" class="form-control form-control-lg" style="width: 400px" >
                                        <option selected value="<?php echo $row['level'];?>"><?php echo $row['level'];?></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                    </select>
                                </p>
                                <p style="width: 400px; margin: auto; padding-bottom: 25px; padding-top: 25px">
                                    <button type="submit" class="btn btn-primary btn-block" name="submit" value="Update">Submit</button>
                                </p><br><br>
                            </div>
                        </form>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

</body>
</html>