
<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="card" style="box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 8px 24px 0 rgba(0, 0, 0, 0.19); width: 800px; margin-left: 7%">
    <div class="card-header" style="background-color: #337ab7; height: 50px; color: white; text-align: center; font-weight: bolder; font-size: 40px">
        Add Bill
    </div>
    <div class="card-body" style="margin-top: 15px">
        <p><span style="margin-left: 3.5%">Select Type</span>
            <select name="type" class="form-control form-control-lg" style="width: 750px; margin-left: 25px">
                <option selected>Select Bill Type</option>
                <option value="mobile">Mobile</option>
                <option value="landline">Landline</option>
            </select>
        </p><br>
        <div style="margin-bottom: 10%">
            <div class="col-sm-6">
                <span style="margin-left: 3.5%">Start Date</span>
                <input type="date" name="startDate" class="form-control form-control-lg" style="width: 350px; margin-left: 10px">
            </div>
            <div class="col-sm-6">
                <span style="margin-left: 4%">End Date</span>
                <input type="date" name="endDate" class="form-control form-control-lg" style="width: 350px; margin-left: 3%">
            </div>
        </div>
        <p><span style="margin-left: 3.5%">Amount</span>
            <input type="text" name="amount" class="form-control form-control-lg" style="width: 750px; margin-left: 25px">
        </p>
        <p><span style="margin-left: 3.5%">Attached Proof</span>
            <input type="file" name="file" style="width: 750px; margin-left: 25px">
        </p>
        <p style="width: 750px; margin: auto; padding-bottom: 25px; padding-top: 25px">
            <button type="submit" class="btn btn-primary btn-block" name="submit" value="Upload">Submit</button>
        </p>
    </div>
</div>
    
</form>
