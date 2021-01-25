<?php
    session_start();
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $dob = $_POST['dob'];
    $gender = $_POST['gen'];
    $mob = $_POST['mobile'];

    $conn = new mysqli('localhost','id15578246_abc','RU}B^tu#5-ijiv^j','id15578246_website');
    if($conn->connect_error)
    {
        die("Connection falied : ".$conn->connect_error);
    }
    else
    {
        if($pass == $cpass)
        {
            $result = mysqli_query($conn,"select * from rest where username = '$user'");
            $row = mysqli_fetch_array($result);
            if($row == "")
            {
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;
                $_SESSION['user'] = $user;
                $_SESSION['dob'] = $dob;
                $_SESSION['gender'] = $gender;
                $_SESSION['mobile'] = $mob;
                $hash = password_hash($pass,PASSWORD_DEFAULT);
                $hash1 = password_hash($cpass,PASSWORD_DEFAULT);
                $stmt = $conn->prepare("Insert into rest(fname,lname,email,username,pass,cpass,dob,gender,mobile)values(?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("ssssssssi",$fname,$lname,$email,$user,$hash,$hash1,$dob,$gender,$mob);
                $stmt->execute();
                echo'<div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> You have sucessfully Logged In.
                </div>';
                include 'homepage.php';
                $stmt->close();
                $conn->close();  
            }
            else
            {
                echo'<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Username already Exist!</strong> Try a new username.
                </div>';
                include 'signuppage.html';
            }
        }
	    else
        {
            echo'<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> Password Do Not Match.
                </div>';
            include 'signuppage.html';
        }
        
    }

?>  