<?php
    session_start();
    $user = $_POST['Username'];
    $pass = $_POST['Password'];
    $conn = new mysqli('localhost','id15578246_abc','RU}B^tu#5-ijiv^j','id15578246_website');
    if($conn->connect_error)
    {
        die("Connection falied : ".$conn->connect_error);
    }
    else
    {
        $result = "";
        $result = mysqli_query($conn,"select * from rest where username = '$user'");
        $row = mysqli_fetch_array($result);
        if($row != "")
        {
            $verify = password_verify($pass, $row['pass']);
            if($row['username'] == $user && $verify)
            {
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['user'] = $row['username'];
                $_SESSION['dob'] = $row['dob'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['mobile'] = $row['mobile'];
                echo'<div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> You have sucessfully Logged In.
                </div>';
                include 'homepage.php';
                $conn->close();
            }
            else
            {
                echo'<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> Wrong Username or Password.
                </div>';
                include 'loginpage.html';
            }
        }
        else
        {
            echo'<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> Wrong Username or Password.
              </div>';
            include 'loginpage.html';
        }
    }

?>