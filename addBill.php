<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19)" >
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
        Add Bill
    </div>
    <div class="card-body" style="margin-top: 15px">
        <p><span style="margin-left: 3.5%">Select Type</span>
            <select name="type" class="form-control form-control-lg" style="width: 750px; margin: auto">
                <option selected>Select Bill Type</option>
                <option value="mobile">Mobile</option>
                <option value="landline">Landline</option>
            </select>
        </p><br>
        <p><span style="margin-left: 3.5%">Date</span>
            <input type="date" name="date" class="form-control form-control-lg" style="width: 750px; margin: auto">
        </p>
        <p><span style="margin-left: 3.5%">Amount</span>
            <input type="text" name="amount" class="form-control form-control-lg" style="width: 750px; margin: auto">
        </p>
        <p><span style="margin-left: 3.5%">Attached Proof</span>
            <input type="file" name="file" style="width: 750px; margin: auto">
        </p>
        <p style="width: 750px; margin: auto; padding-bottom: 25px; padding-top: 10px">
            <button type="submit" class="btn btn-primary btn-block" name="submit" value="Upload">Submit</button>
        </p>
    </div>
</div>
    
</form>



