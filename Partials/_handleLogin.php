<?php
$showError = "false";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "_dbconnect.php";
    if (isset($_POST['loginEmail']) && !empty($_POST['loginEmail']) && isset($_POST['loginPass']) && !empty($_POST['loginPass'])) {
        $email = $_POST['loginEmail'];
        $pass = $_POST['loginPass'];
        $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 0) {
            $showError = "Username does not exist.";
        } else {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['user_pass'])) {

                echo "pass";
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['useremail'] = $email;
                header("Location: //index.php?loginsuccess=true");
                exit();

            } else {
                $showError = "Incorrect Password.";
            }

        }

    } else {
        $showError = "Please enter the details.";
    }
    header("Location: /Code-Talk/index.php?loginsuccess=false&error=$showError");
}


?>