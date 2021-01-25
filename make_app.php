<?php
    session_start();
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dname = $_POST['dname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];
    $comment = $_POST['comment'];
    $conn = new mysqli('localhost','id15578246_abc','RU}B^tu#5-ijiv^j','id15578246_website');
    if($conn->connect_error)
    {
        die("Connection falied : ".$conn->connect_error);
    }
    else
    {
        $stmt = $conn->prepare("Insert into appointment(fname,lname,email,dname,date,time,subject,comment)values(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss",$fname,$lname,$email,$dname,$date,$time,$subject,$comment);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        echo'<div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> You have sucessfully Fixed Appointment.
            </div>';
        include 'homepage.php';
    }

?>
