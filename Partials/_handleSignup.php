<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    //check whether this email exists.
    $existsql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result=mysqli_query($conn,$existsql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email is already registered";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `timestamp`) VALUES (NULL, '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = true;
                header("Location: /PHP project/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Passwords do not match";
            
        }
    }
    header("Location: /PHP project/index.php?signupsuccess=false&error=$showError");
}

?>