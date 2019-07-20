<?php
session_start();
include('session.php'); 
if( (!isset($_SESSION['login_user'])) || ($_SESSION['login_user']== "Admin")){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SSPL Bill Reimbursement System</title>

        <link rel="stylesheet" href="StyleSheet.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/css/tableexport.min.css" rel="stylesheet">
        <script>
            $(document).ready(function() {
                // Set trigger and container variables
                $('#content').load('addBill.php');
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
                    
                </div>
            </div>
        </div>
      
    </body>
</html>
