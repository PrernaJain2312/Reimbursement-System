<?php
include('auth.php');
?>

<form action="useradd.php" method="post" >
    <div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19);width: 750px; margin-left: 10%" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
        Add User
    </div>
    <div class="card-body" style="margin-top: 15px">
        <br>
        <p align="center">
            <span style=" font-size: 20px; font-weight: bolder">Username</span>
            <input type="text" name="username" placeholder="Username" class="form-control form-control-lg" style="width: 400px; margin: auto" required>
        </p>
        <p align="center">
            <span style=" font-size: 20px; font-weight: bolder">Email</span>
            <input type="text" name="email" placeholder="Email Adrress" class="form-control form-control-lg" style="width: 400px; margin: auto" required>
        </p>
        <p align="center">
            <span style=" font-size: 20px; font-weight: bolder">Designation</span>
            <select required name="designation" class="form-control form-control-lg" style="width: 400px">
                <option selected value="">Select Designation</option>
                <option value="Scientist">Scientist</option>
                <option value="Technical Officer">Technical Officer</option>
            </select>
            </p>
        <p align="center">
            <span style=" font-size: 20px; font-weight: bolder">Level</span>
            <select required name="level" class="form-control form-control-lg" style="width: 400px" >
                <option selected value="">Select Level</option>
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
            <button type="submit" class="btn btn-primary btn-block" name="submit" value="submit">Submit</button>
        </p><br><br>
    </div>
</form>