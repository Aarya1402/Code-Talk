<?php
$showError = "false";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "_dbconnect.php";
    // if (isset($_POST['loginEmail']) && !empty($_POST['loginEmail']) && isset($_POST['loginpass']) && !empty($_POST['loginpass'])) {
        $email = $_POST['loginEmail'];
        $email = filter_input(INPUT_POST, $email, FILTER_SANITIZE_STRING);
        $pass = $_POST['loginPass'];

        $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($pass, $row['user_pass'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['useremail'] = $email;


            }
            header("Location: /PHP project/index.php");
        }
    
    header("Location: /PHP project/index.php");

}


?>