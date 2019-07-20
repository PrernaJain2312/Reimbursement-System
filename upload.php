<?php
// Include the database configuration file
include 'mysqli_connect.php';
include 'session.php';

$statusMsg = '';
// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    
    $allowTypes = array('pdf','PDF');
    
    $data_missing = array();
    
    if(empty($_POST['type'])){

        // Adds name to array
        $data_missing[] = 'Bill Type';

    } else {

        // Trim white space from the name and store the name
        $billType = trim($_POST['type']);

    }

    if(empty($_POST['startDate'])){

        // Adds name to array
        $data_missing[] = 'Start Date';

    } else{

        // Trim white space from the name and store the name
        $billStartDate = trim($_POST['startDate']);

    }
    
    if(empty($_POST['endDate'])){

        // Adds name to array
        $data_missing[] = 'End Date';

    } else{

        // Trim white space from the name and store the name
        $billEndDate = trim($_POST['endDate']);

    }

    if(empty($_POST['amount'])){

        // Adds name to array
        $data_missing[] = 'Bill Amount';

    } else {

        // Trim white space from the name and store the name
        $billAmount = trim($_POST['amount']);

    }
    
    
    if(in_array($fileType, $allowTypes)){
      
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            
            if(empty($data_missing)){
                
                $insert =  $dbc->query("INSERT INTO bills (username, bill_type, bill_startDate, bill_endDate, bill_amount, bill_proof, date_entered, bill_id) VALUES ('".$login_session."', '".$billType."', '".$billStartDate."', '".$billEndDate."', '".$billAmount."', '".$fileName."', NOW(), NULL)");

                if(insert){

                    echo "<script type='text/javascript'>alert('Bill Added Successfully!');
                    window.location='index.php';
                    </script>";

                    mysqli_close($dbc);

                } else {

                    echo 'Error Occurred<br />';
                    echo mysqli_error();

                    mysqli_close($dbc);

                }

            } else {

                echo 'You need to enter the following data<br />';

                foreach($data_missing as $missing){

                    echo "$missing<br />";

                }
            }
            
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

echo "$statusMsg<br />";
