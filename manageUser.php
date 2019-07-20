<?php 
include 'mysqli_connect.php';
include('auth.php');

$allData = "SELECT * FROM login where not(id=1) ORDER BY username desc ";
$allDataResult = mysqli_query($dbc, $allData);
?>

<div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19)" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 35px">
        Manage Users
    </div>
    <div class="table-responsive">
    <table id="bill_data" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email Address</th>
                <th>Designation</th>
                <th>Level</th>
            </tr>
        </thead>
    <tbody id="table_body">
       <?php
       while($row1 = mysqli_fetch_array($allDataResult)){
           ?>
       <tr>
           <td><?php echo $row1["username"]?></td>
           <td><?php echo $row1["email"]?></td>
           <td><?php echo $row1["designation"]?></td>
           <td><?php echo $row1["level"]?></td>
           <td><a href="edit.php?id=<?php echo $row1["id"]; ?>" class="btn btn-primary btn-block">Edit</a></td>  
           <td><a href="delete.php?id=<?php echo $row1["id"]; ?>" class="btn btn-primary btn-block">Delete</a></td> 
       </tr>
       <?php
       }
       ?>
   </tbody>
   </table>
  </div>
</div>